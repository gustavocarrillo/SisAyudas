<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Clavedesbloqueo as CD;
use Illuminate\Support\Facades\Hash;

class ClavesDesbloqueo extends Controller
{
    function nueva_clave(){
        return view('clavesDesbloqueo.nueva');
    }

    function guardar_clave(Request $request){
        $this->validate($request,[
            'clave' => 'confirmed|min:4|max:8|unique:claves_desbloqueo,clave'
        ]);

        $clave = new CD();
        $clave->clave = bcrypt($request->clave);
        $clave->save();

        flash('Clave creada exitosamente','success');
        return redirect()->route('nueva-clave-desb');
    }

    function obtener_clave(Request $request){

        $clave = CD::all();
        $cont = 0;

        foreach ($clave as $k) {
            if (Hash::check($request->clave, $k->clave)){
                $cont++;
            }
        }

        if($cont >0){
            return response()->json(['msj'=>'true']);
        }else{
            return response()->json(['msj'=>'false']);
        }
    }
}
