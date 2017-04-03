<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Solicitud;

class TiposSolicitud extends Controller
{
    function index(){
        $solicitudes = Solicitud::all();
        return view('solicitudes.index')->with('solicitudes',$solicitudes);
    }
}
