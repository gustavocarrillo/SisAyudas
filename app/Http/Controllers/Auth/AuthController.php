<?php

namespace App\Http\Controllers\Auth;

use Gate;
use App\User;
use Faker\Provider\File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function autenticar(Request $request){

        $usuario = $request->usuario;
        $clave = $request->clave;

        if(Auth::attempt(['username' => $usuario, 'password' => $clave])){
            return redirect()->intended('admin/panel/index');
        }else{
            flash('Usuario o Contraseña incorrectos','danger');
            return redirect()->route('login');
        }
    }

    public function registroIndex(){
        return view('auth.registro');
    }

    public function registrar(Request $request){

        $this->validate($request,[
            'nombre' => 'required|min:10|max:50',
            'cedula' => 'required|min:6|max:9|unique:users,cedula',
            'usuario' => 'required|min:8|max:12|alpha_num|unique:users,username',
            'email' => 'required|min:8|max:40|email|unique:users,email',
            'clave' => 'required|min:8|max:10|confirmed',
            'tipo' => 'required|in:admin,instituto',
            'estatus' => 'required|in:activo,inactivo',
            'foto' => 'mimes:jpeg,jpg,png'
        ]);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->cedula = $request->cedula;
        $user->username = $request->usuario;
        $user->email = $request->email;
        $user->password = bcrypt($request->clave);
        $user->tipo = $request->tipo;
        $user->estatus = $request->estatus;

        //recupera mime type
        if($request->foto) {
            $_mimeType = $request->foto->getMimeType();
            //almacena extension segun mime type
            $_ext = ($_mimeType == 'image/jpeg') ? '.jpg' : '.png';


            //recibe foto y la guarda en el directorio especificado mediante ::disk
            //renombra la foto con cedula + ext
            Storage::disk('fotos')->put(
                $user->cedula . $_ext,
                //se utiliza el '\' antes de File para escapar al namespace global
                //ya que el codigo es llamado dentro del namespace Auth
                \File::get($request->foto)
            );
            $user->foto = $request->cedula.$_ext;
        }

        $user->save();
        //dd($request->user());

        if(Auth::attempt(['username' => $request->usuario, 'password' => $request->clave])){
            flash('Usuario registrado exitosamente','success');
            return redirect()->route('ayudas-naturales');
            //return redirect()->intended('admin/panel/index');
        }else{
            flash('Usuario o Contraseña incorrectos','danger');
            return redirect()->route('login');
        }
        /*flash('Usuario registrado exitosamente','success');
        return redirect()->route('ayudas-naturales');*/
    }

    public function salir(){
        Auth::logout();
        flash('Usted ha salido del sistema...','info');
        return redirect()->route('login');
    }
}
