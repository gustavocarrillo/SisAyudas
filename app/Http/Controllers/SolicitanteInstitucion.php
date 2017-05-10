<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Solicitanteinst;
use App\Solicitud as TS;
use App\Municipio as Municipio;
use App\Parroquia as Parroquia;
use App\Http\Controllers\SolicitanteInscrito as SOLI;
use Illuminate\Support\Facades\DB;
use App\Evento;

class SolicitanteInstitucion extends Controller
{
    /**
     * @return $this
     */
    public function index()
    {
        $municipios = Municipio::all();

        $parroquias = Parroquia::all();

        $ts = TS::all();

        $eventos = Evento::all();

        return view('ayudas.instituciones')
            ->with('ts',$ts)
            ->with('eventos',$eventos)
            ->with('parroquias',$parroquias)
            ->with('municipios',$municipios);
    }

    public function guardar_ayuda(Request $request){

        $this->validate($request, [
            'tipo_reg' => 'required|in:C,J,G',
            'codigo_rif' => 'string|min:8|max:12',
            'nombre' => 'min:3|max:100|required',
            'telefonos' => 'min:7|max:100',
            'municipio' => 'required',
            'parroquia' => 'required',
            'solicitud' => 'required',
            'necesidad' => 'required|string',
        ]);

        $identif_institucion = Solicitanteinst::where('codigo_rif',$request->codigo_rif)->value('codigo_rif');

        if(!$identif_institucion){
            $solicitante = new Solicitanteinst();
            $solicitante->tipo_reg = $request->tipo_reg;
            $solicitante->codigo_rif = $request->codigo_rif;
            $solicitante->nombre = strtoupper($request->nombre);
            $solicitante->responsable = strtoupper($request->responsable);
            $solicitante->re_nac = strtoupper($request->re_nac);
            $solicitante->re_cedula = $request->re_cedula;
            $solicitante->telefono = $request->telefonos;
            $solicitante->direccion = strtoupper($request->direccion);
            $solicitante->id_municipio = $request->municipio;
            $solicitante->id_parroquia = $request->parroquia;
            $solicitante->save();
        }

        $sol_id = Solicitanteinst::where('codigo_rif',$request->codigo_rif)->value('id');
        $solicitante = Solicitanteinst::find($sol_id);
        $intervalo = TS::find($request->solicitud);

        //verificamos si existen ayudas pendientes del mismo tipo
        $solicitudes_pendientes = $solicitante->solicitudes()
            ->where(['solicitanteinst_id'=>$sol_id,'estatus'=>'pendiente','solicitud_id' => $request->solicitud])
            ->first();

        if($solicitudes_pendientes){

            return response()->json(['resp' => 'false','mensaje'=>'Ya existe una solicitud pendiente del mismo tipo, modifiquela y anexe el/los requerimiento(s) faltantes','id'=>$solicitudes_pendientes->id]);

        }else{
            //verificamos si existen ayudas procesadas del mismo tipo, y obtenemos la fecha de procesamiento
            $solicitudes_procesadas = $solicitante->solicitudes()
                ->where(['solicitanteinst_id'=>$sol_id,'estatus'=>'procesada','solicitud_id' => $request->solicitud])
                ->max('fecha_pro');

            if($solicitudes_procesadas){

                //se crea una instancia del Ctr SolicitanteInscrito, dueño del metodo diferencia_dias
                $sol_i = new SOLI();

                //se calcula la diferencia en dias basado en el intervalo del tipo de solicitud
                $diferencia = $sol_i->diferencia_dias($intervalo->intervalo,$solicitudes_procesadas);

                if ($diferencia == false){
                    return response()->json(['resp' => 'false','mensaje' => 'La solicitud no puede ser procesada por intervalo vigente']);
                }
            }

            $solicitante->solicitudes()->attach($request->solicitud,['id_evento' => $request->evento,'detalle' => $request->necesidad,'fecha' => $request->fecha]);

            if($request->ajax()){
                return response()->json(['resp' => 'true','mensaje' => 'Ayuda guardada exitosamente','']);
            }
        }

    }

    public function editar($id)
    {
        $solicitante = Solicitanteinst::find($id);
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();

        return view('ayudas.editarSolicitante')
            ->with('solicitante',$solicitante)
            ->with('municipios',$municipios)
            ->with('parroquias',$parroquias)
            ->with('tipo','Inst');
    }

    public function editado(Request $request)
    {
        $solicitante = Solicitanteinst::find($request->id);

        $solicitante->tipo_reg = $request->tipo_reg;
        $solicitante->codigo_rif = $request->codigo;
        $solicitante->nombre = strtoupper($request->razon_social);
        $solicitante->responsable = strtoupper($request->responsable);
        $solicitante->re_cedula = $request->re_cedula;
        $solicitante->telefono = $request->telefono;
        $solicitante->direccion = strtoupper($request->direccion);
        $solicitante->id_municipio = $request->municipio;
        $solicitante->id_parroquia = $request->parroquia;

        $solicitante->save();

        flash('Datos modificados','success');

        return $this->solicitanteDetalle($request->id);
    }

    public function solicitanteDetalle($id){

        return redirect()->route('verDetalles')
            ->with('datos',$this->getDatosSolicitante($id))
            ->with('ayudas',$this->getAyudas($id))
            ->with('tipo','inst');
    }

    public function getDatosSolicitante($id)
    {
        $solicitante = DB::table('solicitanteinst')
            ->join('municipios','solicitanteinst.id_municipio','=','municipios.id')
            ->join('parroquias','solicitanteinst.id_parroquia','=','parroquias.id')
            ->where('solicitanteinst.id','=',$id)
            ->select('solicitanteinst.id as id',
                     'solicitanteinst.nombre as nombres',
                DB::raw('CONCAT(solicitanteinst.tipo_reg,"",solicitanteinst.codigo_rif) as codigo'),
                'solicitanteinst.telefono',
                'solicitanteinst.direccion',
                'solicitanteinst.responsable',
                DB::raw('CONCAT(solicitanteinst.re_nac,"",solicitanteinst.re_cedula) as re_cedula'),
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia')
            ->get();

        return $solicitante;
    }

    public function getAyudas($id)
    {
        $ayudas = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes','solicitanteinst_solicitud.solicitud_id','=','solicitudes.id')
            ->where('solicitanteinst_solicitud.solicitanteinst_id','=',$id)
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada')
            ->get();

        return $ayudas;
    }
}
