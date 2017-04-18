<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Solicitud;

class TiposSolicitud extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::all();

        return view('solicitudes.index')->with('solicitudes',$solicitudes);
    }

    public function nueva()
    {
        return view('solicitudes.nueva');
    }

    public function guardar(Request $request)
    {
        $solicitud = new Solicitud();

        $this->validar($request);

        $solicitud->nombre = strtoupper($request->nombre);

        $solicitud->intervalo = $request->intervalo;

        $solicitud->save();

        flash('Tipo de solicitud creado exitosamente','success');

        return redirect()->route('nueva-solicitudes');
    }

    public function editar($id)
    {
        $sol = Solicitud::find($id);

        return view('solicitudes.editar')->with('tsol',$sol);
    }

    public function editado(Request $request)
    {
        $solicitud = Solicitud::find($request->id);

        $this->validar($request);

        $solicitud->nombre = $request->nombre;

        $solicitud->intervalo = $request->intervalo;

        $solicitud->save();

        flash('Tipo de solicitud modificado exitosamente','success');

        return redirect()->route('listar-solicitudes');
    }

    public function eliminar($id)
    {
        $sol = Solicitud::find($id);

        $sol->delete();

        flash('Tipo de solicitud ha sido eliminada','success');

        return redirect()->route('listar-solicitudes');
    }

    private function validar(Request $request)
    {
        $this->validate($request,[
            "nombre" => "required|unique:solicitudes,nombre",
            "intervalo" => "required|numeric"
        ]);
    }
}
