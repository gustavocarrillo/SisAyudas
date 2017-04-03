@extends('admin.plantilla.plantilla')
@section('head')
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-ui-custom/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="x_panel">
        @include('admin.partials.error')
        @include('flash::message')
        <div class="x_title">
            <h2>Busqueda de Electores</h2>
                <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form action="{{ route('cne-buscar') }}" method="post" id="busqueda" data-parsley-validate="" class="form-horizontal form-label-left">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cedula: <span class="required">*</span>
                    </label>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <select name="nac" id="" class="form-control">
                            <option value="V" selected>V</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4">
                        <input type="text" name="cne_ci" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    @if(session('data'))
        @if (array_has(session('data'),'datos.cedula'))
            @include('ayudas.natural-si-cne')
        @else
            @include('ayudas.natural-no-cne')
        @endif
    @endif
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h3 class="modal-title" id="myModalLabel2">Atención</h3>
                </div>
                <div class="modal-body">
                    <p>El solicitante ya existe en la Base de Datos</p>
                    <p>¿Desea actualizar los datos?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <a type="button" id="modal_guardar" class="btn btn-success" data-dismiss="modal">Si</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src={{ asset("vendors/select2/dist/js/select2.full.min.js") }}></script>
    <script src={{ asset("jquery-ui-custom/jquery-ui.js") }}></script>
    <script src={{ asset("js/personalizado.js") }}></script>
@endsection