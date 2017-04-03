<?php

namespace App\Http\Controllers;

use App\Solicitanteinst;
use App\Solicitud;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Solicitud as TS;
use App\Municipio as Municipio;
use App\Parroquia as Parroquia;
use App\Solicitante as Solicitante;
use App\Centro as Centro;
use App\Firmante;
use Illuminate\Support\Facades\DB;

class SolicitanteInscrito extends Controller
{
    public function buscar_solicitante(Request $request){
        $solicitnate = Solicitante::where('cedula',$request->cne_ci)->first();
        return redirect()->route('ayudas-naturales')
            ->with('data',array('datos' =>$solicitnate));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function guardar_ayuda(Request $request){

        $this->validate($request, [
            'cedula' => 'numeric|min:199999|max:39999999|required',
            'nombres' => 'min:3|max:50|required',
            'apellidos' => 'min:3|max:50|required',
            'telefono' => 'min:7|max:100',
            'municipio' => 'min:3|max:50|required',
            'parroquia' => 'min:3|max:50|required',
            'centro' => 'min:3|max:150|required',
            'solicitudes' => 'required',
            'necesidad' => 'required',
        ]);

        $municipio =  Municipio::where('nombre',$request->municipio)->value('id');
        $parroquia = Parroquia::where('nombre',$request->parroquia)->value('id');
        $centro = Centro::where('nombre',$request->centro)->value('id');
        $cedula_solic = Solicitante::where('cedula',$request->cedula)->value('cedula');

        $solicitud = $request->solicitudes;

        if(!$municipio){
            $_municipio = new Municipio();
            $_municipio->nombre = $request->municipio;
            $_municipio->save();
        }

        if(!$parroquia){
            $_parroquia = new Parroquia();
            $_parroquia->nombre = $request->parroquia;
            $_parroquia->id_municipio = Municipio::where('nombre',$request->municipio)->value('id');
            $_parroquia->save();
        }

        if(!$centro && $centro != 0){
            $_centro = new Centro();
            $_centro->nombre = $request->centro;
            $_centro->id_municipio = (!is_null($municipio)) ? $municipio : Municipio::where('nombre',$request->municipio)->value('id');
            $_centro->id_parroquia = (!is_null($parroquia)) ? $parroquia : Parroquia::where('nombre',$request->parroquia)->value('id');
            $_centro->save();
        }

        if(!$cedula_solic){
            $solicitante = new Solicitante();
            $solicitante->nacionalidad = $request->nac;
            $solicitante->cedula = $request->cedula;
            $solicitante->nombres = $request->nombres;
            $solicitante->apellidos = $request->apellidos;
            $solicitante->telefono = $request->telefonos;
            $solicitante->direccion = $request->direccion;
            $solicitante->id_municipio = (!is_null($municipio)) ? $municipio : Municipio::where('nombre',$request->municipio)->value('id');
            $solicitante->id_parroquia = (!is_null($parroquia)) ? $parroquia : Parroquia::where('nombre',$request->parroquia)->value('id');
            $solicitante->id_centro = (!is_null($centro)) ? $centro : Centro::where('nombre',$request->centro)->value('id');
            $solicitante->save();
        }

        $sol_id = Solicitante::where('cedula',$request->cedula)->value('id');
        $solicitante = Solicitante::find($sol_id);
        $intervalo = Solicitud::find($request->solicitudes);

        $fecha = ($request->fecha == '') ? 'DESCONOCIDA' : $request->fecha;

        //verificamos si existen ayudas pendientes del mismo tipo
        $solicitudes_pendientes = $solicitante->solicitudes()
            ->where(['solicitante_id'=>$sol_id,'estatus'=>'pendiente','solicitud_id' => $request->solicitudes])
            ->first();

        if($solicitudes_pendientes){

            return response()->json(['resp' => 'false','mensaje'=>'Ya existe una solicitud pendiente del mismo tipo, modifiquela y anexe el/los requerimiento(s) faltantes','id'=>$solicitudes_pendientes->id]);

        }else{
            //verificamos si existen ayudas procesadas del mismo tipo, y obtenemos la fecha de procesamiento
            $solicitudes_procesadas = $solicitante->solicitudes()
                ->where(['solicitante_id'=>$sol_id,'estatus'=>'procesada','solicitud_id' => $request->solicitudes])
                ->max('fecha_pro');

            if($solicitudes_procesadas){

                //se calcula la diferencia en dias basado en el intervalo del tipo de solicitud
                $diferencia = $this->diferencia_dias($intervalo->intervalo,$solicitudes_procesadas);

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

        $solicitante = DB::table('solicitantes')
            ->join('municipios','solicitantes.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
            ->join('centros','solicitantes.id_centro','=','centros.id')
            ->where('solicitantes.id','=',$id)
            ->select('solicitantes.nombres',
                'solicitantes.apellidos',
                DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),
                'solicitantes.telefono',
                'solicitantes.direccion',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia',
                'centros.nombre as centro')
            ->get();

        $ayudas = DB::table('solicitante_solicitud')
            ->join('solicitudes','solicitante_solicitud.solicitud_id','=','solicitudes.id')
            ->where('solicitante_solicitud.solicitante_id','=',$id)
            ->select('solicitudes.nombre as tipo','solicitante_solicitud.id as id','solicitante_solicitud.fecha as fecha','solicitante_solicitud.estatus as estatus','solicitante_solicitud.fecha_pro as procesada')
            ->get();

        return view('ayudas.detalleSolicitante',['datos' => $solicitante,'ayudas' => $ayudas,'tipo'=>'']);
    }

    public function diferencia_dias($intervalo,$fecha){

        //obtenemos la fecha de hoy
        $hoy = new \DateTime('now');
        //convertimos $fecha en un objeto Datetime
        $fecha = new \DateTime($fecha);
        //calculamos la diferencia de ambas fechas
        $diferencia = $hoy->diff($fecha);
        //obtemos la direncias en dias
        $diferencia = $diferencia->d;

        if ($diferencia < $intervalo){
            return false;
        }

        return true;
    }
}
