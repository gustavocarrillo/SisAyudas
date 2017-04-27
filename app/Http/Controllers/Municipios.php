<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Municipio;

class Municipios extends Controller
{
    public function index()
    {
        $municipios = Municipio::all();

        return view('municipios.index')->with('municipios',$municipios);
    }

    public function nueva()
    {
        return view('municipios.nuevo');
    }

    public function guardar(Request $request)
    {
        $municipio = new Municipio();

        $this->validar($request);

        $municipio->nombre = strtoupper($request->nombre);

        $municipio->save();

        flash('Municipio creado exitosamente','success');

        return redirect()->route('nuevo-municipio');
    }

    public function editar($id)
    {
        $municipio = Municipio::find($id);

        return view('municipios.editar')->with('municipio',$municipio);
    }

    public function editado(Request $request)
    {
        $municipio = Municipio::find($request->id);

        $this->validar($request);

        $municipio->nombre = strtoupper($request->nombre);

        $municipio->save();

        flash('Municipio modificado exitosamente','success');

        return redirect()->route('listar-municipios');
    }

    public function eliminar($id)
    {
        $municipio = Municipio::find($id);

        $municipio->delete();

        flash('Municipio ha sido eliminada','success');

        return redirect()->route('listar-municipios');
    }

    private function validar(Request $request)
    {
        $this->validate($request,[
            "nombre" => "required|unique:municipios,nombre",
        ]);
    }
}
