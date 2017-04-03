@extends('admin.plantilla.plantilla')

@section('contenido')
    <div class="x_title">
        <h2>Nueva Clave de Desbloqueo</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br>
        @include('flash::message')
        @include('admin.partials.error')
        <form action="{{ route('guardar-clave') }}" method="POST" class="form-horizontal form-label-left">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <input type="hidden" value="cne" id="tipo">
            <input type="hidden" name="registro" value="{{ session('existe') }}" id="registro">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nueva Clave:
                </label>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="password" id="clave" name="clave" value="" class="form-control col-md-7 col-xs-12" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirme Clave:
                </label>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="password" id="clave_confirmation" name="clave_confirmation" value="" class="form-control col-md-7 col-xs-12" required="required">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-2 col-xs-12 col-md-offset-3">
                    <input type="submit" value="Crear" class="btn btn-success col-md-3" id="guardar">
                </div>
            </div>
        </form>
    </div>
@endsection
