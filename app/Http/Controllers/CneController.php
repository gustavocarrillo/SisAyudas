<?php

namespace App\Http\Controllers;

use App\Solicitanteinst;
use Illuminate\Http\Request;
use App\Solicitud as TS;
use App\Municipio as Municipio;
use App\Parroquia as Parroquia;
use App\Centro as Centro;
use App\Firmante as Firmante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Solicitante;
use App\Evento;

use Validator;

class CneController extends Controller
{
    public function buscar_ayudas(){
        return view('ayudas.buscar');
    }

    public function buscar_cne(Request $request)
    {
        // Nacionalidad de la persona a consultar
        $nac = $request->nac;
        // Cedula de la persona a consultar
        $ci = $request->cne_ci;//10510076; //10510076
        // Ruta a la cual nos vamos a conectar con un website del CNE
        $url = "http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=$nac&cedula=$ci";
        // Compruebo si existe el modulo de curl
        if (!in_array('curl', get_loaded_extensions())) {
            die('Disculpe, es necesario la instalaci&oacute; del modulo de curl para su funcionamiento, debe ejecutar el siguiente comando: <br/>   apt-get install php5-curl');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // almacene en una variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
        // Para informar todo lo relacionado al header de la conexion
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $xxx1 = curl_exec($ch);
        curl_close($ch);
        // Quitamos todas las etiquetas html existente dentro del retornado
        $page = strip_tags($xxx1);
        // Dividimos el resultado en arreglos donde encuentre :
        $info = explode(":", $page);

        // Dividimos este un resultado de la cedula en dos para sacar nac y cedula
        $cn = explode('-', substr(trim($info[1]), 0, -6));

        $solicitante = Solicitante::where('cedula',$request->cne_ci)->first();
        $existe = ($solicitante) ? 'true' : 'false';
        $firmante = Firmante::where('cedula',$ci)->first();
        $visibilidad='';
        if($firmante){
            $visibilidad = 'display: none';
        }
        if(count($info) <= 2){
            $ts = TS::all();
            $eventos = Evento::all();
            $municipios = Municipio::all();
            $parroquias = Parroquia::all();
            flash('NO REGISTRADO EN EL CNE','warning');
            return redirect()->route('ayudas-naturales')
                ->with('data',array('datos' =>$info))
                ->with('ts',$ts)
                ->with('municipios',$municipios)
                ->with('parroquias',$parroquias)
                ->with('eventos',$eventos)
                ->with('firma',$firmante)
                ->with('existe',$existe)
                ->with('hide',$visibilidad);
        }

        $persona = explode(' ', trim($info[2]));
        $centro = explode(' ', trim($info[6]));

        //recupera el munucipio
        $x_municipio = trim($info[4]);
        $xx_municipio = trim(str_replace('Parroquia','',$x_municipio));
        $municipio = trim(str_replace('CE.','',$xx_municipio));

        //recupera la parroquia
        $x_parroquia = trim($info[5]);
        $xx_parroquia = trim(str_replace('Centro','',$x_parroquia));
        $parroquia = trim(str_replace('PQ.','',$xx_parroquia));

        $_centro = '';
        $x_centro = count($centro);


        for ($i = 0; $i < $x_centro; $i++) {
            if ($i != $x_centro - 1) {
                $_centro .= $centro[$i] . ' ';
            } else {
                $_borrar = "\n\t\t\n\t\t\n\t\t\tDirección";
                $str = str_replace($_borrar, '', $centro[$i]);
                $_centro .= $str;
            }

        }

        for ($i = 0; $i < $x_municipio; $i++) {
            if ($i != $x_municipio - 1) {
                $_centro .= $centro[$i] . ' ';
            } else {
                $_borrar = "\n\t\t\n\t\t\n\t\t\tDirección";
                $str = str_replace($_borrar, '', $centro[$i]);
                $_centro .= $str;
            }

        }

        $rows = count($persona);
        $rows2 = count($info);

        // Procedimiento cuando devuelve un nombre completo ejemplo
        //Array ( [0] => ADRIANA [1] => DEL [2] => CARMEN [3] => VAAMONDE [4] => MUÃ‘OZ Estado ) 5

        if ($rows == 5) {
            $nombre1 = $persona[0];
            $nombre2 = $persona[1] . ' ' . $persona[2];
            $apellido1 = $persona[3];
            $apellido2 = $persona[4];
            // Procedimiento cuando devuelve los nombre completo de forma normal
        } elseif ($rows == 4) {
            $nombre1 = $persona[0];
            $nombre2 = $persona[1];
            $apellido1 = $persona[2];
            $apellido2 = $persona[3];
        } else {
            // Procedimiento cuando solo no esta registrado en el CNE que devuelve arreglos diferente a los demás
            // sobreescribo la variable $info debido que el comportamiento es diferente
            $info = explode(' ', $page);
            $rows2 = count($info);
            $ced = substr($cn[1], 0, -6);
            $nombre1 = substr($info[9], 0, -7);
            $nombre2 = substr($info[11], 0, -7);
            $apellido1 = substr($info[13], 0, -7);
            $apellido2 = substr($info[15], 0, -7);
        }

        $ts = TS::all();
        $eventos = Evento::all();

        // Flujo Normal cuando solo esta registrado en el CNE y no es Miembro de Mesa
        if ($rows2 > 0 AND $rows2 <= 10) {
            $datos['nacionalidad'] = $cn[0];
            $datos['cedula'] = trim($cn[1]);
            $datos['nombre1'] = $nombre1;
            $datos['nombre2'] = $nombre2;
            $datos['apellido1'] = $apellido1;
            $datos['apellido2'] =trim(substr($apellido2, 0, -6));
            $datos['municipio'] = $municipio;
            $datos['parroquia'] = $parroquia;
            $datos['centro'] = $_centro;

            return redirect()->route('ayudas-naturales')
                ->with('data',array('datos' =>$datos))
                ->with('ts',$ts)
                ->with('eventos',$eventos)
                ->with('firma',$firmante)
                ->with('existe',$existe)
                ->with('visibilidad',$visibilidad);

            // Flujo Alto cuando esta registrado en el CNE y es Miembro de Mesa
        } elseif ($rows2 > 10 AND $rows2 < 24) {
            $datos['nacionalidad'] = $cn[0];
            $datos['cedula'] = trim($cn[1]);
            $datos['nombre1'] = $nombre1;
            $datos['nombre2'] = $nombre2;
            $datos['apellido1'] = $apellido1;
            $datos['apellido2'] = substr($apellido2, 0, -6);
            $datos['municipio'] = $municipio;
            $datos['parroquia'] = $parroquia;
            $datos['centro'] = $_centro;
           // dd($datos);
            return redirect()->route('ayudas-naturales')
                ->with('data',array('datos' =>$datos))
                ->with('ts',$ts)
                ->with('eventos',$eventos)
                ->with('firma',$firmante)
                ->with('existe',$existe)
                ->with('visibilidad',$visibilidad);

            // Flujo Alternativo cuando no es ninguna de las anteriores pero esta registrado
        } else {
            $datos['nacionalidad'] = $cn[0];
            $datos['cedula'] = trim($ced);
            $datos['nombre1'] = $nombre1;
            $datos['nombre2'] = $nombre2;
            $datos['apellido1'] = $apellido1;
            $datos['apellido2'] = trim($apellido2);
            $datos['municipio'] = $municipio;
            $datos['parroquia'] = $parroquia;
            $datos['centro'] = $_centro;
           // dd($datos);
            return redirect()->route('ayudas-naturales')
                ->with('data',array('datos' =>$datos))
                ->with('ts',$ts)
                ->with('eventos',$eventos)
                ->with('firma',$firmante)
                ->with('existe',$existe)
                ->with('visibilidad',$visibilidad);
        }
    }
}
