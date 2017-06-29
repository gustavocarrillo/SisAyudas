<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Solicitante;
use Illuminate\Support\Facades\Auth;
use App\Municipio;
use App\Parroquia;
use App\Centro;
use App\Telefono;

class SolicitantesController extends Controller
{

    public function buscar(Request $request)
    {
        $solicitante = Solicitante::where(['nacionalidad' => $request->nac,'cedula' => $request->ci])->first();

        //dd($solicitante);

        return redirect()->route('ayudas-naturales');
    }

    public function guardar(Request $request)
    {

        $this->validated($request);

        $municipio = $this->getMunicipio($request->municipio);

        $parroquia = $this->getParroquia($request->parroquia,$municipio);

        $centro = $this->getCentro($request->centro,$parroquia,$municipio);

        $solicitante = Solicitante::create([
            'nacionalidad' => $request->nac,
            'cedula' => $request->cedula,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nac' => $request->fecha_nac,
            'genero' => $request->genero,
            'direccion' => $request->direccion,
            'edo_civil' => $request->edo_civil,
            'id_municipio' => $municipio,
            'id_parroquia' => $parroquia,
            'id_centro' => $centro,
            'id_usuario' => Auth::user()->id,
            ]);

        foreach ($request->telefonos as $telf) {

            $solicitante->telefonos()->create(['numero' => $telf]);
        }

        return response()->json([
            'resp' => 'true',
            'mensaje' => 'Los datos han sido guardados exitosamente',
            'solicitante_id' => $solicitante->id,
            'municipios' => Municipio::all(),
            'parroquias' => Parroquia::all()
        ]);

    }

    private function validated($request)
    {
        $msjs = [
            'nac.required' => 'El campo NACIONALIDAD es obligatorio',
            'cedula.unique' => 'La CEDULA que intenta registrar ya existe en sistema',
            'cedula.required' => 'El campo CEDULA es obligatorio',
            'cedula.min' => 'El campo CEDULA debe tener almenos 6 digitos',
            'cedula.max' => 'El campo CEDULA debe tener maximo 8 digitos',
            'cedula.integer' => 'El campo CEDULA debe ser tipo numerico',
            'nombres.required' => 'El campo NOMBRES es obligatorio',
            'nombres.min' => 'El campo NOMBRES debe tener almenos 3 caracteres',
            'apellidos.required' => 'El campo APELLIDOS es obligatorio',
            'apellidos.min' => 'El campo APELLIDOS debe tener almenos 3 caracteres',
            'fecha_nac.required' => 'El campo FECHA DE NACIMIENTO es obligatorio',
            'fecha_nac.date' => 'El campo FECHA DE NACIMIENTO debe tener un formato de fecha valido',
            'genero.required' => 'Debe elegir un GENERO',
            'telefonos.required' => 'Debe introducir almenos NUMERO TELEFONICO',
            'direccion.required' => 'El campo DIRECCION es obligatorio',
            'direccion.min' => 'El campo DIRECCION debe tener almenos 4 caracteres',
            'edo_civil.required' => 'El campo ESTADO CIVIL es obligatorio',
            'municipio.required' => 'El campo MUNICIPIO es obligatorio',
            'parroquia.required' => 'El campo PARROQUIA es obligatorio',
            'centro.required' => 'El campo CENTRO es obligatorio',
        ];

        $rules = [
            'nac' => 'required',
            'cedula' => 'integer|required|unique:solicitantes|min:999999|max:99999999',
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            'fecha_nac' => 'required|date',
            'genero' => 'required',
            'direccion' => 'required|min:4',
            'edo_civil' => 'required',
            'municipio' => 'required',
            'parroquia' => 'required',
        ];

        $this->validate($request,$rules,$msjs);
    }

    private function getMunicipio($nombre)
    {
        $municipio = Municipio::where('nombre',$nombre)->select('id')->first();

        if (count($municipio) == 0) {

            $municipio = Municipio::create(['nombre' => $nombre]);
        }

        return $municipio->id;
    }

    private function getParroquia($nombre,$municipio)
    {
        $parroquia = Parroquia::where('nombre',$nombre)->select('id')->first();

        if ( count($parroquia) == 0) {

            $parroquia = Parroquia::create(['nombre' => $nombre,'id_municipio' => $municipio]);
        }

        return $parroquia->id;
    }

    private function getCentro($nombre, $parroquia, $municipio)
    {
        $centro = Centro::where('nombre',$nombre)->select('id')->first();

        if ( count($centro) == 0) {

            $centro = Centro::create(['nombre' => $nombre,'id_parroquia' => $parroquia,'id_municipio' => $municipio]);
        }

        return $centro->id;
    }

}
