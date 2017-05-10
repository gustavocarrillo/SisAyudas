@extends('admin.plantilla.plantilla')

@section('contenido')
    <div class="x_panel">
    <div class="x_title">
        <h2>Nuevo Tipo de Solicitud</h2>
        <div class="clearfix"></div>
    </div>
        <div class="x_content">
            <br>
            @include('flash::message')
            @include('admin.partials.error')
            <form action="{{ route('guardar-solicitudes') }}" method="POST" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Solicitud:
                    </label>
                    </label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" id="nombre" name="nombre" value="" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Intervalo:
                    </label>
                    </label>
                    <div class="col-md-2 col-sm-1 col-xs-1">
                        <input type="text" id="intervalo" name="intervalo" value="" class="form-control col-md-7 col-xs-12" maxlength="3" required="required">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-2 col-xs-12 col-md-offset-3">
                        <input type="submit" value="Crear" class="btn btn-success col-md-3" id="guardar">
                        <a href="{{ route('listar-solicitudes') }}"class="btn btn-danger col-md-3" id="guardar">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
