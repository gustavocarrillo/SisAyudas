<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Solicitantenocne;
use App\Solicitud;
use App\Municipio as Municipio;
use App\Parroquia as Parroquia;
use App\Http\Controllers\SolicitanteInscrito as SOLI;
use Illuminate\Support\Facades\DB;

class SolicitanteNoInscrito extends Controller
{
    public function guardar_ayuda(Request $request){
        $this->validate($request, [
            'nac' => 'required',
            'cedula' => 'numeric|min:199999|max:39999999|required',
            'nombres' => 'min:3|max:50|required',
            'apellidos' => 'min:3|max:50|required',
            'telefono' => 'min:7|max:100',
            'municipio' => 'required',
            'parroquia' => 'required',
            'solicitudes' => 'required',
            'necesidad' => 'required',
        ]);

        $municipio =  Municipio::where('nombre',$request->municipio)->value('id');
        $parroquia = Parroquia::where('nombre',$request->parroquia)->value('id');
        $cedula_solic = Solicitantenocne::where('cedula',$request->cedula)->value('cedula');

        $solicitud = $request->solicitudes;

        if(!$cedula_solic){
            $solicitante = new Solicitantenocne();
            $solicitante->nacionalidad = $request->nac;
            $solicitante->cedula = $request->cedula;
            $solicitante->nombres = $request->nombres;
            $solicitante->apellidos = $request->apellidos;
            $solicitante->telefono = $request->telefonos;
            $solicitante->direccion = $request->direccion;
            $solicitante->id_municipio = $request->municipio;
            $solicitante->id_parroquia = $request->parroquia;
            $solicitante->save();
        }

        $sol_id = Solicitantenocne::where('cedula',$request->cedula)->value('id');
        $solicitante = Solicitantenocne::find($sol_id);
        $intervalo = Solicitud::find($request->solicitudes);

        $fecha = ($request->fecha == '') ? 'DESCONOCIDA' : $request->fecha;

        //verificamos si existen ayudas pendientes del mismo tipo
        $solicitudes_pendientes = $solicitante->solicitudes()
            ->where(['solicitantenocne_id'=>$sol_id,'estatus'=>'pendiente','solicitud_id' => $request->solicitudes])
            ->first();

        if($solicitudes_pendientes){

            return response()->json(['resp' => 'false','mensaje'=>'Ya existe una solicitud pendiente del mismo tipo, modifiquela y anexe el/los requerimiento(s) faltantes','id'=>$solicitudes_pendientes->id]);

        }else{
            //verificamos si existen ayudas procesadas del mismo tipo, y obtenemos la fecha de procesamiento
            $solicitudes_procesadas = $solicitante->solicitudes()
                ->where(['solicitantenocne_id'=>$sol_id,'estatus'=>'procesada','solicitud_id' => $request->solicitudes])
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

            $solicitante->solicitudes()->attach($solicitud,['detalle' => $request->necesidad,'fecha' => $fecha]);

            if($request->ajax()){
                return response()->json(['resp' => 'true','mensaje' => 'Ayuda guardada exitosamente','']);
            }
        }
    }

    public function solicitanteDetalle($id){

        $solicitante = DB::table('solicitantes_no_cne')
            ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
            ->where('solicitantes_no_cne.id','=',$id)
            ->select('solicitantes_no_cne.nombres',
                'solicitantes_no_cne.apellidos',
                DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),
                'solicitantes_no_cne.telefono',
                'solicitantes_no_cne.direccion',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia')
            ->get();

        $ayudas = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes','solicitantenocne_solicitud.solicitud_id','=','solicitudes.id')
            ->where('solicitantenocne_solicitud.solicitantenocne_id','=',$id)
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada')
            ->get();

        return view('ayudas.detalleSolicitante',['datos' => $solicitante,'ayudas' => $ayudas,'tipo'=>'nocne']);
    }

}
