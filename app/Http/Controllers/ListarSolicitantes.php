<?php

namespace App\Http\Controllers;

use App\Solicitud;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Solicitante;
use App\Solicitanteinst;
use App\Solicitantenocne;
use App\Municipio;
use App\Parroquia;
use App\Centro;
use Illuminate\Support\Facades\DB;


class ListarSolicitantes extends Controller
{
   public function index(){
       return view('ayudas.buscar');
   }

   public function filtro(){
       $municipios = Municipio::all();
       $parroquias = Parroquia::all();
       $centros = Centro::all();
       $solicitudes = Solicitud::all();
       return response()->json(['centros'=>$centros,'municipios'=>$municipios,'parroquias'=>$parroquias,'solicitud' => $solicitudes]);
   }

   public function buscarPorCedula(Request $request){

       $solicitante = DB::table('solicitantes')
           ->join('municipios','solicitantes.id_municipio','=','municipios.id')
           ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
           ->where('solicitantes.cedula','=',$request->cedula,'and','solicitantes.nac','=',$request->nac)
           ->select(DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),
               DB::raw('CONCAT(solicitantes.nombres, " ",solicitantes.apellidos ) AS nombres'),
               'solicitantes.id as id',
               'municipios.nombre as municipio','parroquias.nombre as parroquia')
           ->get();

       if(count($solicitante) > 0) {
           return redirect()->route('listar-solicitantes')
               ->with('data', ['solicit_por_cedula' => $solicitante,'ruta'=>'solicitantes-detalle'])
               ->with('resultados', 'BUSQUEDA POR CEDULA');
       }

       $solicitanteNoCne = DB::table('solicitantes_no_cne')
           ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
           ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
           ->where('solicitantes_no_cne.cedula','=',$request->cedula,'and','solicitantes_no_cne.nac','=',$request->nac)
           ->select(DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),
               DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) AS nombres'),
               'solicitantes_no_cne.id as id',
               'municipios.nombre as municipio','parroquias.nombre as parroquia')
           ->get();

       if(count($solicitanteNoCne) > 0) {
           return redirect()->route('listar-solicitantes')
               ->with('data', ['solicit_por_cedula' => $solicitanteNoCne,'ruta'=>'solicitantesNoCne-detalle'])
               ->with('resultados', 'BUSQUEDA POR CEDULA');
       }
       return redirect()->route('listar-solicitantes')->with('error','Solicitante no encontrado')->with('resultados','BUSQUEDA POR CEDULA');
   }

   public function buscarTodos(){
        $solicitantes = $solicitante = DB::table('solicitantes')
            ->join('municipios','solicitantes.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
            ->select('solicitantes.id as id',DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),DB::raw('CONCAT(solicitantes.nombres, " ",solicitantes.apellidos ) AS nombres'),'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $solicitantesNoCne = DB::table('solicitantes_no_cne')
            ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
            ->select('solicitantes_no_cne.id as id',DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) AS nombres'),'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $instituciones = DB::table('solicitanteinst')
            ->join('municipios','solicitanteinst.id_municipio','=','municipios.id')
            ->join('parroquias','solicitanteinst.id_parroquia','=','parroquias.id')
            ->select('solicitanteinst.id as id',DB::raw('CONCAT(solicitanteinst.tipo_reg,"",solicitanteinst.codigo_rif) as cedula'),'solicitanteinst.nombre as nombres','municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data',['solicitantes' => $solicitantes,'solicitantesNoCne' => $solicitantesNoCne,'instituciones' => $instituciones] )->with('resultados','BUSQUEDA POR TODOS');
    }

    public function buscarSolicitantesPorGenero(Request $request)
    {
        $solicitantes = $solicitante = DB::table('solicitantes')
            ->join('municipios','solicitantes.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
            ->where('solicitantes.genero','=',$request->genero_s)
            ->select('solicitantes.id as id',DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),DB::raw('CONCAT(solicitantes.nombres, " ",solicitantes.apellidos ) AS nombres'),'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $solicitantesNoCne = DB::table('solicitantes_no_cne')
            ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
            ->where('solicitantes_no_cne.genero','=',$request->genero_s)
            ->select('solicitantes_no_cne.id as id',DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) AS nombres'),'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data',['solicitantes' => $solicitantes,'solicitantesNoCne' => $solicitantesNoCne] )->with('resultados','BUSQUEDA DE SOLICITANTES POR GENERO');
    }

    public function buscarPorParroquia(Request $request){
        $solicitantes = $solicitante = DB::table('solicitantes')
            ->join('municipios','solicitantes.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
            ->where('solicitantes.id_parroquia','=',$request->parroquia)
            ->select(DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes.nombres, " ",solicitantes.apellidos ) AS nombres'),
                'solicitantes.id as id',
                'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $solicitantesNoCne = DB::table('solicitantes_no_cne')
            ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
            ->where('solicitantes_no_cne.id_parroquia','=',$request->parroquia)
            ->select(DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) AS nombres'),
                'solicitantes_no_cne.id as id',
                'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $instituciones = DB::table('solicitanteinst')
            ->join('municipios','solicitanteinst.id_municipio','=','municipios.id')
            ->join('parroquias','solicitanteinst.id_parroquia','=','parroquias.id')
            ->where('solicitanteinst.id_parroquia','=',$request->parroquia)
            ->select(DB::raw('CONCAT(solicitanteinst.tipo_reg,"",solicitanteinst.codigo_rif) as cedula'),
                'solicitanteinst.nombre as nombres',
                'solicitanteinst.id as id',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data',['solicitantes' => $solicitantes,'solicitantesNoCne' => $solicitantesNoCne,'instituciones' => $instituciones] )->with('resultados','BUSQUEDA POR PARROQUIA');
    }

    public function buscarPorMunicipio(Request $request){
        $solicitantes = $solicitante = DB::table('solicitantes')
            ->join('municipios','solicitantes.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
            ->where('solicitantes.id_municipio','=',$request->municipio)
            ->select(DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes.nombres, " ",solicitantes.apellidos ) AS nombres'),
                'solicitantes.id as id',
                'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $solicitantesNoCne = DB::table('solicitantes_no_cne')
            ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
            ->where('solicitantes_no_cne.id_municipio','=',$request->municipio)
            ->select(DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) AS nombres'),
                'solicitantes_no_cne.id as id',
                'municipios.nombre as municipio','parroquias.nombre as parroquia')
            ->get();

        $instituciones = DB::table('solicitanteinst')
            ->join('municipios','solicitanteinst.id_municipio','=','municipios.id')
            ->join('parroquias','solicitanteinst.id_parroquia','=','parroquias.id')
            ->where('solicitanteinst.id_municipio','=',$request->municipio)
            ->select(DB::raw('CONCAT(solicitanteinst.tipo_reg,"",solicitanteinst.codigo_rif) as cedula'),
                'solicitanteinst.nombre as nombres',
                'solicitanteinst.id as id',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data',['solicitantes' => $solicitantes,'solicitantesNoCne' => $solicitantesNoCne,'instituciones' => $instituciones] )->with('resultados','BUSQUEDA POR MUNICIPIO');
    }

    public function buscarPorTipoSolicitud(Request $request){

        $tipoSolicitud = Solicitud::find($request->solicitud);

        $solicitantes = DB::table('solicitantes')
            ->join('solicitante_solicitud','solicitantes.id','=','solicitante_solicitud.solicitante_id')
            ->join('solicitudes','solicitudes.id','=','solicitante_solicitud.solicitud_id')
            ->join('municipios','solicitantes.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes.id_parroquia','=','parroquias.id')
            ->where('solicitudes.id','=',$request->solicitud)
            ->select(DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) AS nombres'),
                'solicitantes.id as id',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia',
                'solicitudes.nombre as solicitud')
            ->get();

        $solicitantesNoCne = DB::table('solicitantes_no_cne')
            ->join('solicitantenocne_solicitud','solicitantes_no_cne.id','=','solicitantenocne_solicitud.solicitantenocne_id')
            ->join('solicitudes','solicitudes.id','=','solicitantenocne_solicitud.solicitud_id')
            ->join('municipios','solicitantes_no_cne.id_municipio','=','municipios.id')
            ->join('parroquias','solicitantes_no_cne.id_parroquia','=','parroquias.id')
            ->where('solicitudes.id','=',$request->solicitud)
            ->select(DB::raw('CONCAT(solicitantes_no_cne.nacionalidad,"",solicitantes_no_cne.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) AS nombres'),
                'solicitantes_no_cne.id as id',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia',
                'solicitudes.nombre as solicitud')
            ->get();

        $instituciones = DB::table('solicitanteinst')
            ->join('solicitanteinst_solicitud','solicitanteinst.id','=','solicitanteinst_solicitud.solicitanteinst_id')
            ->join('solicitudes','solicitudes.id','=','solicitanteinst_solicitud.solicitud_id')
            ->join('municipios','solicitanteinst.id_municipio','=','municipios.id')
            ->join('parroquias','solicitanteinst.id_parroquia','=','parroquias.id')
            ->where('solicitudes.id','=',$request->solicitud)
            ->select(DB::raw('CONCAT(solicitanteinst.tipo_reg,"",solicitanteinst.codigo_rif) as cedula'),
                'solicitanteinst.nombre AS nombres',
                'solicitanteinst.id as id',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia',
                'solicitudes.nombre as solicitud')
            ->get();

        $solicitud = '';
        return redirect()->route('listar-solicitantes')->with('data',['solicitantes' => $solicitantes,'solicitantesNoCne' => $solicitantesNoCne,'instituciones' => $instituciones,'solicitud' => $solicitud] )->with('resultados','BUSQUEDA POR '.strtoupper($tipoSolicitud->nombre));

    }

    public function buscarPorCentro(Request $request)
    {
        $solicitantes = DB::table('solicitantes')
            ->join('municipios', 'solicitantes.id_municipio', '=', 'municipios.id')
            ->join('parroquias', 'solicitantes.id_parroquia', '=', 'parroquias.id')
            ->join('centros', 'solicitantes.id_centro', '=', 'centros.id')
            ->where('centros.id', '=', $request->centro)
            ->select(DB::raw('CONCAT(solicitantes.nacionalidad,"",solicitantes.cedula) as cedula'),
                DB::raw('CONCAT(solicitantes.nombres, " ",solicitantes.apellidos ) AS nombres'),
                'solicitantes.id as id',
                'municipios.nombre as municipio',
                'parroquias.nombre as parroquia',
                'centros.nombre as centro')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data', ['solicitantes' => $solicitantes,'centro'=>''])->with('resultados', 'BUSQUEDA POR ' . strtoupper($request->centro));
    }
}
