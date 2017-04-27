<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Parroquia;
use App\Municipio;
use Illuminate\Support\Facades\DB;

class Parroquias extends Controller
{
    public function index()
    {
        $parroquias = DB::table('parroquias')
            ->join('municipios','municipios.id','=','parroquias.id_municipio')
            ->select('parroquias.nombre as nombre','municipios.nombre as municipio','parroquias.id as id')
            ->get();

        return view('parroquias.index')->with('parroquias',$parroquias);
    }

    public function nueva()
    {
        $municipios = Municipio::all();

        return view('parroquias.nuevo')->with('municipios',$municipios);
    }

    public function guardar(Request $request)
    {
        $parroquia = new Parroquia();

        $this->validar($request);

        $parroquia->nombre = strtoupper($request->nombre);

        $parroquia->id_municipio = $request->municipio;

        $parroquia->save();

        flash('Parroquia creada exitosamente','success');

        return redirect()->route('nueva-parroquia');
    }

    public function editar($id)
    {
        $parroquia = Parroquia::find($id);

        $municipios = Municipio::all();

        return view('parroquias.editar')
            ->with('parroquia',$parroquia)
            ->with('municipios',$municipios);
    }

    public function editado(Request $request)
    {
        $parroquia = Parroquia::find($request->id);

        $this->validar($request);

        $parroquia->nombre = strtoupper($request->nombre);

        $parroquia->id_municipio = $request->municipio;

        $parroquia->save();

        flash('Parroquia modificada exitosamente','success');

        return redirect()->route('listar-parroquias');
    }

    public function eliminar($id)
    {
        $parroquia = Parroquia::find($id);

        $parroquia->delete();

        flash('Parroquia ha sido eliminada','success');

        return redirect()->route('listar-parroquias');
    }

    private function validar(Request $request)
    {
        $this->validate($request,[
            "nombre" => "required|unique:parroquias,nombre",
        ]);
    }
}
