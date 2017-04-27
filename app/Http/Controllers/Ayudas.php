<?php

namespace App\Http\Controllers;

use App\Solicitante;
use App\Solicitud;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Solicitud as TS;
use App\Evento;
use App\SolicitanteSolicitud;
use App\SolicitanteinstSolicitud;
use App\SolicitantenocneSolicitud;


class Ayudas extends Controller
{
    public function buscarAyuda(Request $request)
    {
        if ($request->tipo_sol == 'siCne') {
            $ayuda = DB::table('solicitante_solicitud')
                ->join('eventos', 'solicitante_solicitud.id_evento', '=', 'eventos.id')
                ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
                ->join('solicitantes', 'solicitantes.id', '=', 'solicitante_solicitud.solicitante_id')
                ->where('solicitante_solicitud.id', '=', $request->numero)
                ->select('solicitudes.nombre as tipo',
                    'solicitante_solicitud.id as id',
                    'solicitante_solicitud.fecha as fecha',
                    'solicitante_solicitud.estatus as estatus',
                    'solicitante_solicitud.fecha_pro as procesada',
                    DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante',
                        'solicitantes.id as solicitante_id'),
                    'eventos.nombre as evento')
                ->get();

            if (count($ayuda) > 0) {
                return redirect()->route('listar-solicitantes')
                    ->with('data', ['solicitantes-ayudas' => $ayuda, 'ruta' => 'ver-ayuda', 'b_a' => ''])
                    ->with('resultados', 'BUSQUEDA POR ID');
            }
        }

        if ($request->tipo_sol == 'noCne') {
            $ayuda = DB::table('solicitantenocne_solicitud')
                ->join('eventos', 'solicitantenocne_solicitud.id_evento', '=', 'eventos.id')
                ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
                ->join('solicitantes_no_cne', 'solicitantes_no_cne.id', '=', 'solicitantenocne_solicitud.solicitantenocne_id')
                ->where('solicitantenocne_solicitud.id', '=', $request->numero)
                ->select('solicitudes.nombre as tipo',
                    'solicitantenocne_solicitud.id as id',
                    'solicitantenocne_solicitud.fecha as fecha',
                    'solicitantenocne_solicitud.estatus as estatus',
                    'solicitantenocne_solicitud.fecha_pro as procesada',
                    DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante',
                        'solicitantes_no_cne.id as solicitante_id'),
                    'eventos.nombre as evento')
                ->get();

            if (count($ayuda) > 0) {
                return redirect()->route('listar-solicitantes')
                    ->with('data', ['solicitantesnocne-ayudas' => $ayuda, 'ruta' => 'ver-ayuda-nocne', 'b_a' => ''])
                    ->with('resultados', 'BUSQUEDA POR ID');
            }
        }
        if ($request->tipo_sol == 'inst') {
            $ayuda = DB::table('solicitanteinst_solicitud')
                ->join('eventos', 'solicitanteinst_solicitud.id_evento', '=', 'eventos.id')
                ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
                ->join('solicitanteinst', 'solicitanteinst.id', '=', 'solicitanteinst_solicitud.solicitanteinst_id')
                ->where('solicitanteinst_solicitud.id', '=', $request->numero)
                ->select('solicitudes.nombre as tipo',
                    'solicitanteinst_solicitud.id as id',
                    'solicitanteinst_solicitud.fecha as fecha',
                    'solicitanteinst_solicitud.estatus as estatus',
                    'solicitanteinst_solicitud.fecha_pro as procesada',
                    'solicitanteinst.nombre as solicitante',
                    'solicitanteinst.id as solicitante_id',
                    'eventos.nombre as evento')
                ->get();

            if (count($ayuda) > 0) {
                return redirect()->route('listar-solicitantes')
                    ->with('data', ['instituciones-ayudas' => $ayuda, 'ruta' => 'ver-ayuda-inst', 'b_a' => ''])
                    ->with('resultados', 'BUSQUEDA POR ID');
            }
        }

        return redirect()->route('listar-solicitantes')->with('error', 'Ayuda no encontrada')->with('resultados', 'BUSQUEDA POR Nº');
    }

    public function todasAyudas()
    {
        $ayudas = DB::table('solicitante_solicitud')
            ->join('eventos', 'solicitante_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes', 'solicitantes.id', '=', 'solicitante_solicitud.solicitante_id')
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante',
                    'solicitantes.id as solicitante_id'),
                'eventos.nombre as evento')
            ->get();

        $ayudasNoCne = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitantenocne_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitantes_no_cne', 'solicitantes_no_cne.id', '=', 'solicitantenocne_solicitud.solicitantenocne_id')
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante',
                    'solicitantes_no_cne.id as solicitante_id'),
                'eventos.nombre as evento')
            ->get();

        $ayudasInst = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitanteinst_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitanteinst', 'solicitanteinst.id', '=', 'solicitanteinst_solicitud.solicitanteinst_id')
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada',
                DB::raw('solicitanteinst.nombre as solicitante',
                    'solicitanteinst.id as solicitante_id'),
                'eventos.nombre as evento')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data', ['solicitantes-ayudas' => $ayudas, 'solicitantesnocne-ayudas' => $ayudasNoCne, 'instituciones-ayudas' => $ayudasInst, 'b_a' => ''])->with('resultados', 'BUSQUEDA POR TODOS');

    }

    public function verAyuda($id)
    {
        $ayuda = DB::table('solicitante_solicitud')
            ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes', 'solicitante_solicitud.solicitante_id', '=', 'solicitantes.id')
            ->where('solicitante_solicitud.id', '=', $id)
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                'solicitante_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante'))
            ->get();

        return view('ayudas.detalleAyuda', ['datos' => $ayuda]);
    }

    public function verAyudaNoCne($id)
    {

        $ayuda = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes_no_cne', 'solicitantenocne_solicitud.solicitantenocne_id', '=', 'solicitantes_no_cne.id')
            ->where('solicitantenocne_solicitud.id', '=', $id)
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                'solicitantenocne_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante'))
            ->get();

        return view('ayudas.detalleAyuda', ['datos' => $ayuda]);
    }

    public function verAyudaInst($id)
    {
        $ayuda = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitanteinst', 'solicitanteinst_solicitud.solicitanteinst_id', '=', 'solicitanteinst.id')
            ->where('solicitanteinst_solicitud.id', '=', $id)
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada',
                'solicitanteinst_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('solicitanteinst.nombre as solicitante'))
            ->get();

        return view('ayudas.detalleAyuda', ['datos' => $ayuda]);
    }

    public function buscarPorTipoSolicitud(Request $request)
    {
        $ayudas = DB::table('solicitante_solicitud')
            ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitante_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitantes', 'solicitante_solicitud.solicitante_id', '=', 'solicitantes.id')
            ->where('solicitante_solicitud.solicitud_id', '=', $request->a_solicitud)
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                'solicitante_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante'),
                'eventos.nombre as evento')
            ->get();

        $ayudasNoCne = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitantenocne_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitantes_no_cne', 'solicitantenocne_solicitud.solicitantenocne_id', '=', 'solicitantes_no_cne.id')
            ->where('solicitantenocne_solicitud.solicitud_id', '=', $request->a_solicitud)
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                'solicitantenocne_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante'),
                'eventos.nombre as evento')
            ->get();

        $ayudasInst = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitanteinst_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitanteinst', 'solicitanteinst_solicitud.solicitanteinst_id', '=', 'solicitanteinst.id')
            ->where('solicitanteinst_solicitud.solicitud_id', '=', $request->a_solicitud)
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada',
                'solicitanteinst_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('solicitanteinst.nombre as solicitante'),
                'eventos.nombre as evento')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data', ['solicitantes-ayudas' => $ayudas, 'solicitantesnocne-ayudas' => $ayudasNoCne, 'instituciones-ayudas' => $ayudasInst, 'b_a' => ''])->with('resultados', 'BUSQUEDA POR TIPO DE SOLICITUD');
    }

    public function editar($id,$tipo = null)
    {
        $metodo = "getDatosSolicitante".studly_case(camel_case($tipo));

        $ayuda = $this->$metodo($id);

        $ts = TS::all();

        $eventos = Evento::all();

        $estatus = ['PENDIENTE','APROBADA','NEGADA','ENTREGADA'];

        return view('ayudas.editar')
            ->with('ayuda',$ayuda)
            ->with('estatus',$estatus)
            ->with('ts',$ts)
            ->with('eventos',$eventos)
            ->with('tipo',$tipo);
    }

    protected function getDatosSolicitante($id)
    {
        $ayuda = DB::table('solicitante_solicitud')
            ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitante_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitantes', 'solicitante_solicitud.solicitante_id', '=', 'solicitantes.id')
            ->where('solicitante_solicitud.id', '=', $id)
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                'solicitante_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante'),
                'solicitantes.id as solicitante_id',
                'eventos.nombre as evento')
            ->get();

        return $ayuda;
    }

    protected function getDatosSolicitanteNoCne($id)
    {
        $ayuda = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitantenocne_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitantes_no_cne', 'solicitantenocne_solicitud.solicitantenocne_id', '=', 'solicitantes_no_cne.id')
            ->where('solicitantenocne_solicitud.id', '=', $id)
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                'solicitantenocne_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante'),
                'solicitantes_no_cne.id as solicitante_id',
                'eventos.nombre as evento')
            ->get();

        return $ayuda;
    }

    protected function getDatosSolicitanteInst($id)
    {
        $ayuda = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitanteinst_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitanteinst', 'solicitanteinst_solicitud.solicitanteinst_id', '=', 'solicitanteinst.id')
            ->where('solicitanteinst_solicitud.id', '=', $id)
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada',
                'solicitanteinst_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                'solicitanteinst.nombre as solicitante',
                'solicitanteinst.id as solicitante_id',
                'eventos.nombre as evento')
            ->get();

        return $ayuda;
    }

    public function buscarAyudasPorGenero(Request $request)
    {
        $ayudas = DB::table('solicitante_solicitud')
            ->join('eventos', 'solicitante_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes', 'solicitantes.id', '=', 'solicitante_solicitud.solicitante_id')
            ->where('solicitantes.genero','=',$request->genero_a)
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante',
                    'solicitantes.id as solicitante_id'),
                'eventos.nombre as evento')
            ->get();

        $ayudasNoCne = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('eventos', 'solicitantenocne_solicitud.id_evento', '=', 'eventos.id')
            ->join('solicitantes_no_cne', 'solicitantes_no_cne.id', '=', 'solicitantenocne_solicitud.solicitantenocne_id')
            ->where('solicitantes_no_cne.genero','=',$request->genero_a)
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante',
                    'solicitantes_no_cne.id as solicitante_id'),
                'eventos.nombre as evento')
            ->get();

        return redirect()->route('listar-solicitantes')->with('data', ['solicitantes-ayudas' => $ayudas, 'solicitantesnocne-ayudas' => $ayudasNoCne, 'b_a' => ''])->with('resultados', 'BUSQUEDA AYUDAS POR GENERO');
    }

    public function editado(Request $request)
    {
        $ss = 'App\Solicitante'.strtolower(camel_case($request->tipo)).'Solicitud';

        $ss = $ss::find($request->id);

        $ss->id_evento = $request->evento;

        $ss->fecha = date('Y-m-d',strtotime($request->fecha));

        $ss->solicitud_id = $request->solicitudes;

        $ss->detalle = $request->necesidad;

        $ss->estatus = $request->estatus;

        $ss->save();

        return $this->getControllerMethod($request->tipo,$request->id_solicitante);
    }

    protected function getControllerMethod($tipo,$id)
    {
        $controller = new SolicitanteInscrito();

        if ($tipo == 'no cne') {
            $controller = new SolicitanteNoInscrito();
        }

        if ($tipo == 'inst') {
            $controller = new SolicitanteInstitucion();
        }

        flash('Ayuda Modificada Exitosamente','success');

        return $controller->solicitanteDetalle($id);
    }

}
