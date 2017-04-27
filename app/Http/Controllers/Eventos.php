<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Evento;

class Eventos extends Controller
{
    public function index()
    {
        $eventos = Evento::all();

        return view('eventos.index')->with('eventos',$eventos);
    }

    public function nuevo()
    {
        return view('eventos.nuevo');
    }

    public function guardar(Request $request)
    {
        $evento = new Evento();

        $this->validar($request);

        $evento->nombre = strtoupper($request->nombre);

        $evento->fecha = $request->fecha;

        $evento->save();

        flash('Evento creado exitosamente','success');

        return redirect()->route('nuevo-eventos');
    }

    public function editar($id)
    {
        $evento = Evento::find($id);

        return view('eventos.editar')->with('evento',$evento);
    }

    public function editado(Request $request)
    {
        $evento = Evento::find($request->id);

        $this->validar($request);

        $evento->nombre = strtoupper($request->nombre);

        $evento->fecha = date('Y-m-d',strtotime($request->fecha));

        $evento->save();

        flash('Evento modificado exitosamente','success');

        return redirect()->route('listar-eventos');
    }

    public function eliminar($id)
    {
        $evento = Evento::find($id);

        $evento->delete();

        flash('El evento ha sido eliminado','success');

        return redirect()->route('listar-eventos');
    }

    private function validar(Request $request)
    {
        $this->validate($request,[
            "nombre" => "required"
        ]);
    }
}
