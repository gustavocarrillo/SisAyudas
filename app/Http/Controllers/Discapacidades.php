<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Discapacidad;

class Discapacidades extends Controller
{
    public function index()
    {
        $municipios = Discapacidad::all();

        return view('discapacidad.index')->with('discapacidades',$municipios);
    }

    public function nueva()
    {
        return view('discapacidad.nuevo');
    }

    public function guardar(Request $request)
    {
        $discapacidad = new Discapacidad();

        $this->validar($request);

        $discapacidad->discapacidad = strtoupper($request->discapacidad);

        $discapacidad->save();

        flash('Discapacidad creada exitosamente','success');

        return redirect()->route('nueva-discapacidad');
    }

    public function editar($id)
    {
        $discapacidad = Discapacidad::find($id);

        return view('discapacidad.editar')->with('discapacidad',$discapacidad);
    }

    public function editado(Request $request)
    {
        $discapacidad = Discapacidad::find($request->id);

        $this->validar($request);

        $discapacidad->discapacidad = strtoupper($request->discapacidad);

        $discapacidad->save();

        flash('Discapacidad modificada exitosamente','success');

        return redirect()->route('listar-discapacidad');
    }

    public function eliminar($id)
    {
        $discapacidad = Discapacidad::find($id);

        $discapacidad->delete();

        flash('Discapacidad ha sido eliminada','success');

        return redirect()->route('listar-discapacidad');
    }

    private function validar(Request $request)
    {
        $this->validate($request,[
            "discapacidad" => "required|unique:discapacidades,discapacidad",
        ]);
    }
}
