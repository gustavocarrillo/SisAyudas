@extends('admin.plantilla.plantilla')
@section('head')
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-ui-custom/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('contenido')
<div class="x_panel">
    @foreach($ayuda as $datos)
    <div class="x_title">

        <h2>EDITAR AYUDA Nº:<strong> {{$datos->id}}</strong></h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content" style="display: block;">
        <br>
        <form action="{{ route('editado-ayuda') }}" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <input type="hidden" name="id" value="{{ $datos->id }}">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Solicitante:
                </label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <span class="form-control">{{ $datos->solicitante }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de recepción:
                </label>
                <div class="col-md-2 col-sm-2 col-xs-4">
                    <input type="text" id="fecha" name="fecha" value="{{ $datos->fecha }}" class="form-control col-md-5 col-xs-12" required="required" placeholder="Click Aqui" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitudes</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="solicitud" class="select2_group form-control" name="solicitudes">
                        <option value="">Seleccione...</option>
                        @foreach($ts as $t)
                            <option value="{{ $t->id }}" @if( $t->nombre == $datos->solicitud ) selected @endif>{{ ucfirst($t->nombre) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nescesidad: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="necesidad" name="necesidad" class="form-control" rows="6">{{ $datos->detalle }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus</label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select id="estatus" class="form-control" name="estatus">
                        <option value="" selected>Seleccione...</option>
                        <option value="">PENDIENTE</option>
                        <option value="">APROBADA</option>
                        <option value="">NEGADA</option>
                        <option value="">ENTREGADA</option>
                    </select>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Cancelar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection

@section('js')
    <script src={{ asset("vendors/select2/dist/js/select2.full.min.js") }}></script>
    <script src={{ asset("jquery-ui-custom/jquery-ui.js") }}></script>
    <script src={{ asset("js/personalizado.js") }}></script>
@endsection