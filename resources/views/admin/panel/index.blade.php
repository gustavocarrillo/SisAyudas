@extends('admin.plantilla.plantilla')

@section('contenido')
    @include('flash::message')
    <div class="page-title">
        <div class="title_left">
            <h3 id="titulo_panel"><strong>SISTEMA DE AYUDAS ECONOMICAS</strong></h3>
        </div>
    </div>
	<img id="imagen_fondo" src="{{ asset('img/logo_alc.png') }}" alt="">
@endsection
