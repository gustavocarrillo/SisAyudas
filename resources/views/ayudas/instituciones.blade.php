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
            <h2>Datos (Instituciones - Consejos Comunales)</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de recepción:
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-4">
                        <input type="text" id="fecha" name="fecha" value="" class="form-control col-md-5 col-xs-12" required="required" placeholder="Click Aqui"  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Codigo / Rif:
                    </label>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <select name="tipo_reg" id="tipo_reg" class="form-control">
                            <option value="J" selected>J</option>
                            <option value="C">C</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-10">
                        <input type="text" id="codigo_rif" name="codigo_rif" value="" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Razon Social:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="nombre" name="nombre" value=""class="form-control col-md-7 col-xs-12"  required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="direccion" name="direccion" value=""class="form-control col-md-7 col-xs-12"  required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Telefono(s):
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="telefonos" name="telefono" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_group form-control" name="municipio" id="municipio">
                            @foreach($municipios as $m)
                                <option value="{{ $m->id }}">{{ strtoupper($m->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parroquia: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_group form-control" name="parroquia" id="parroquia">
                            @foreach($parroquias as $p)
                                <option value="{{ $p->id }}">{{ strtoupper($p->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="x_title">
                    <h2>Nueva Ayuda</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-danger" role="alert" style="display: none" id="div_errores">
                        <ul id="errores">
                        </ul>
                    </div>
                    <div id="msj-success" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-success" role="alert" style="display: none"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitudes</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_group form-control" name="solicitudes" id="solicitud">
                            @foreach($ts as $t)
                                <option value="{{ $t->id }}">{{ strtoupper($t->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nescesidad: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="necesidad" id="necesidad" class="form-control" rows="6"></textarea>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a id="guardar_inst" type="submit" class="btn btn-success">Guardar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src={{ asset("vendors/select2/dist/js/select2.full.min.js") }}></script>
    <script src={{ asset("jquery-ui-custom/jquery-ui.js") }}></script>
    <script src={{ asset("js/personalizado.js") }}></script>
    <script>
        $(document).ready(function() {
            $(".select2_single").select2({
                placeholder: "Seleccione tipos",
                allowClear: true
            });
            $(".select2_group").select2({});
            $(".select2_multiple").select2({
                maximumSelectionLength: 8,
                placeholder: "Hasta un maximo de 8",
                allowClear: true
            });
        });

        $(function () {
            $.datepicker.setDefaults($.datepicker.regional["es"]);
            $("#fecha").datepicker({
                firstDay: 1
            });
        });
    </script>
@endsection