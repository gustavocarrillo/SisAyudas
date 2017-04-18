<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Solicitud as TS;


class Ayudas extends Controller
{
    public function buscarAyuda(Request $request)
    {
        if ($request->tipo_sol == 'siCne') {
            $ayuda = DB::table('solicitante_solicitud')
                ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
                ->join('solicitantes', 'solicitantes.id', '=', 'solicitante_solicitud.solicitante_id')
                ->where('solicitante_solicitud.id', '=', $request->numero)
                ->select('solicitudes.nombre as tipo',
                    'solicitante_solicitud.id as id',
                    'solicitante_solicitud.fecha as fecha',
                    'solicitante_solicitud.estatus as estatus',
                    'solicitante_solicitud.fecha_pro as procesada',
                    DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante',
                        'solicitantes.id as solicitante_id'))
                ->get();

            if (count($ayuda) > 0) {
                return redirect()->route('listar-solicitantes')
                    ->with('data', ['solicitantes-ayudas' => $ayuda, 'ruta' => 'ver-ayuda', 'b_a' => ''])
                    ->with('resultados', 'BUSQUEDA POR ID');
            }
        }

        if ($request->tipo_sol == 'noCne') {
            $ayuda = DB::table('solicitantenocne_solicitud')
                ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
                ->join('solicitantes_no_cne', 'solicitantes_no_cne.id', '=', 'solicitantenocne_solicitud.solicitantenocne_id')
                ->where('solicitantenocne_solicitud.id', '=', $request->numero)
                ->select('solicitudes.nombre as tipo',
                    'solicitantenocne_solicitud.id as id',
                    'solicitantenocne_solicitud.fecha as fecha',
                    'solicitantenocne_solicitud.estatus as estatus',
                    'solicitantenocne_solicitud.fecha_pro as procesada',
                    DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante',
                        'solicitantes_no_cne.id as solicitante_id'))
                ->get();

            if (count($ayuda) > 0) {
                return redirect()->route('listar-solicitantes')
                    ->with('data', ['solicitantesnocne-ayudas' => $ayuda, 'ruta' => 'ver-ayuda-nocne', 'b_a' => ''])
                    ->with('resultados', 'BUSQUEDA POR ID');
            }
        }
        if ($request->tipo_sol == 'inst') {
            $ayuda = DB::table('solicitanteinst_solicitud')
                ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
                ->join('solicitanteinst', 'solicitanteinst.id', '=', 'solicitanteinst_solicitud.solicitanteinst_id')
                ->where('solicitanteinst_solicitud.id', '=', $request->numero)
                ->select('solicitudes.nombre as tipo',
                    'solicitanteinst_solicitud.id as id',
                    'solicitanteinst_solicitud.fecha as fecha',
                    'solicitanteinst_solicitud.estatus as estatus',
                    'solicitanteinst_solicitud.fecha_pro as procesada',
                    'solicitanteinst.nombre as solicitante',
                    'solicitanteinst.id as solicitante_id')
                ->get();

            if (count($ayuda) > 0) {
                return redirect()->route('listar-solicitantes')
                    ->with('data', ['instituciones_ayudas' => $ayuda, 'ruta' => 'ver-ayuda-inst', 'b_a' => ''])
                    ->with('resultados', 'BUSQUEDA POR ID');
            }
        }

        return redirect()->route('listar-solicitantes')->with('error', 'Ayuda no encontrada')->with('resultados', 'BUSQUEDA POR Nº');
    }

    public function todasAyudas()
    {
        $ayudas = DB::table('solicitante_solicitud')
            ->join('solicitudes', 'solicitante_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes', 'solicitantes.id', '=', 'solicitante_solicitud.solicitante_id')
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante',
                    'solicitantes.id as solicitante_id'))
            ->get();

        $ayudasNoCne = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes_no_cne', 'solicitantes_no_cne.id', '=', 'solicitantenocne_solicitud.solicitantenocne_id')
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante',
                    'solicitantes_no_cne.id as solicitante_id'))
            ->get();

        $ayudasInst = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitanteinst', 'solicitanteinst.id', '=', 'solicitanteinst_solicitud.solicitanteinst_id')
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada',
                DB::raw('solicitanteinst.nombre as solicitante',
                    'solicitanteinst.id as solicitante_id'))
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
            ->join('solicitantes', 'solicitante_solicitud.solicitante_id', '=', 'solicitantes.id')
            ->where('solicitante_solicitud.solicitud_id', '=', $request->a_solicitud)
            ->select('solicitudes.nombre as tipo',
                'solicitante_solicitud.id as id',
                'solicitante_solicitud.fecha as fecha',
                'solicitante_solicitud.estatus as estatus',
                'solicitante_solicitud.fecha_pro as procesada',
                'solicitante_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes.nombres," ",solicitantes.apellidos) as solicitante'))
            ->get();

        $ayudasNoCne = DB::table('solicitantenocne_solicitud')
            ->join('solicitudes', 'solicitantenocne_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitantes_no_cne', 'solicitantenocne_solicitud.solicitantenocne_id', '=', 'solicitantes_no_cne.id')
            ->where('solicitantenocne_solicitud.solicitud_id', '=', $request->a_solicitud)
            ->select('solicitudes.nombre as tipo',
                'solicitantenocne_solicitud.id as id',
                'solicitantenocne_solicitud.fecha as fecha',
                'solicitantenocne_solicitud.estatus as estatus',
                'solicitantenocne_solicitud.fecha_pro as procesada',
                'solicitantenocne_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('CONCAT(solicitantes_no_cne.nombres," ",solicitantes_no_cne.apellidos) as solicitante'))
            ->get();

        $ayudasInst = DB::table('solicitanteinst_solicitud')
            ->join('solicitudes', 'solicitanteinst_solicitud.solicitud_id', '=', 'solicitudes.id')
            ->join('solicitanteinst', 'solicitanteinst_solicitud.solicitanteinst_id', '=', 'solicitanteinst.id')
            ->where('solicitanteinst_solicitud.solicitud_id', '=', $request->a_solicitud)
            ->select('solicitudes.nombre as tipo',
                'solicitanteinst_solicitud.id as id',
                'solicitanteinst_solicitud.fecha as fecha',
                'solicitanteinst_solicitud.estatus as estatus',
                'solicitanteinst_solicitud.fecha_pro as procesada',
                'solicitanteinst_solicitud.detalle as detalle',
                'solicitudes.nombre as solicitud',
                DB::raw('solicitanteinst.nombre as solicitante'))
            ->get();

        return redirect()->route('listar-solicitantes')->with('data', ['solicitantes-ayudas' => $ayudas, 'solicitantesnocne-ayudas' => $ayudasNoCne, 'instituciones-ayudas' => $ayudasInst, 'b_a' => ''])->with('resultados', 'BUSQUEDA POR TIPO DE SOLICITUD');
    }

    public function editar($id){
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

        $ts = TS::all();

        return view('ayudas.editar')
            ->with('ayuda',$ayuda)
            ->with('ts',$ts);
    }

    public function editado(){



        return view('ayudas.editar')
            ->with('ayuda',$ayuda)
            ->with('ts',$ts);
    }
}
