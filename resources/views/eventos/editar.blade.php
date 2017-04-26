@extends('admin.plantilla.plantilla')

@section('head')
    <link href="{{ asset('jquery-ui-custom/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('contenido')
    <div class="x_panel">
    <div class="x_title">
        <h2>Modificar Evento</h2>
        <div class="clearfix"></div>
    </div>
        <div class="x_content">
            <br>
            @include('flash::message')
            @include('admin.partials.error')
            <form action="{{ route('editado-eventos') }}" method="POST" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="id" value="{{ $evento->id }}">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del Evento:
                    </label>
                    </label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" id="nombre" name="nombre" value="{{ $evento->nombre }}" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha:
                    </label>
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <input type="text" id="fecha" name="fecha" value="{{ date('d-m-Y',strtotime($evento->fecha)) }}" class="form-control col-md-5 col-xs-12" required="required" placeholder="Click Aqui"  readonly>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-2 col-xs-12 col-md-offset-3">
                        <input type="submit" value="Modificar" class="btn btn-success col-md-3" id="guardar">
                        <a href="{{ route('listar-eventos') }}"class="btn btn-danger col-md-3" id="guardar">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src={{ asset("jquery-ui-custom/jquery-ui.js") }}></script>
    <script src={{ asset("js/personalizado.js") }}></script>
@endsection
