@extends('admin.plantilla.plantilla')
@section('head')
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="x_panel">
    {{--@include('admin.partials.error')--}}
    {{--@include('flash::message')--}}
    <div class="x_title">
        <h2>Busqueda de Solicitantes Registrados</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br>
        <form action="buscarTodos" id="buscar_por" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" >
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="cedula">Busqueda Por: <span class="required">*</span>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-4">
                    <select name="buscar_selec" id="buscar_selec" class="form-control">
                        <option value="solicitante" selected>Solicitante</option>
                        <option value="ayuda" >Ayuda</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                    <div class="" id="buscar_solicitante">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="opciones">Filtrar Por: <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <select name="opciones_s" id="opciones_s" class="form-control">
                                <option value="todos" selected>Todos</option>
                                <option value="cedula" >Cedula</option>
                                <option value="codigo_rif" >Codigo o Rif</option>
                                <option value="municipio" >Municipio</option>
                                <option value="parroquia" >Parroquia</option>
                                <option value="tipoSolicitante" >Tipo de Solicitante</option>
                                <option value="tipoSolicitud" >Tipo de Solicitud</option>
                                <option value="centro" >Centro</option>
                            </select>
                        </div>
                    </div>
                    <div class="hidden" id="buscar_ayuda">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="opciones">Filtrar Por: <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <select name="opciones_a" id="opciones_a" class="form-control">
                                <option value="todas" selected>Todas</option>
                                <option value="id" >Nº</option>
                                <option value="tipoSolicitud">Tipo de Solicitud</option>
                            </select>
                        </div>
                    </div>

                <div id="filtros_s">
                    <div class="col-md-1 col-sm-2 col-xs-4 hidden" id="nac">
                        <select name="nac" class="form-control">
                            <option value="v" selected>V</option>
                            <option value="e" >E</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 hidden" id="cedula">
                        <input type="text" name="cedula" required="required" class="form-control col-md-7 col-xs-12" placeholder="escribe aqui">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 hidden" id="codigo_rif">
                        <input type="text" name="codigo_rif" required="required" class="form-control col-md-7 col-xs-12" placeholder="escribe aqui">
                    </div>
                    <div class="col-md-4 col-sm-2 col-xs-4 hidden" id="tipoSolicitante">
                        <select type="text" name="solicitante" required="required" class="form-control col-md-7 col-xs-12">
                            <option>Inscritos en CNE</option>
                            <option>No Inscritos en CNE</option>
                            <option>Instituciones / Consejos Comunales</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-2 col-xs-12 hidden" id="tipoSolicitud">
                        <select type="text" name="solicitud" required="required" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 hidden" id="municipio">
                        <select type="text" name="municipio" required="required" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-2 col-xs-4 hidden" id="parroquia">
                        <select type="text" name="parroquia" required="required" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-2 col-xs-4 hidden" id="centro">
                        <select type="text" name="centro" required="required" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                </div>
                <div id="filtros_a">
                    <div class="col-md-4 col-sm-2 col-xs-12 hidden" id="tipoSolicitud_a">
                        <select type="text" name="a_solicitud" required="required" class="form-control col-md-7 col-xs-12">
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 hidden" id="tipo_sol">
                        <select name="tipo_sol" required="required" class="form-control col-md-7 col-xs-12" placeholder="escribe aqui">
                            <option value="siCne">Inscrito en CNE</option>
                            <option value="noCne">No Inscrito en CNE</option>
                            <option value="inst">Institución</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 hidden" id="numero">
                        <input type="text" name="numero" required="required" class="form-control col-md-7 col-xs-12" placeholder="Numero aqui">
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button id="buscar" class="btn btn-success">Buscar</button>
                </div>
            </div>

        </form>
    </div>
    </div>
{{-- dd(session('data')) --}}
@if(session('data'))
    <div class="x_panel col-md-12 col-sm-12 col-xs-12" id="datos">
            <div class="x_title">
                <h2>Resultados de Busqueda<small><strong><span id="redulttados">@if(session('resultados')){{ session('resultados') }} @endif</span></strong></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                </p>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                    @if(array_has(session('data'),'b_a'))
                        <th>Nº</th>
                        <th>Solicitante</th>
                        <th>Evento</th>
                        <th>Tipo</th>
                        <th>Fecha de Recepción</th>
                        <th>Estatus</th>
                        <th>Procesada</th>
                        <th>Acción</th>
                    @else
                        <th>Cedula / Codigo / Rif</th>
                        <th>Nombres y Apellidos</th>
                        <th>Municipio</th>
                        <th>Parroquia</th>
                        @if(array_has(session('data'),'solicitud'))
                            <th>Tipo de Solicitud</th>
                        @endif
                        @if(array_has(session('data'),'centro'))
                            <th>Centro</th>
                        @endif
                    @endif
                        </tr>
                    </thead>
                    <tbody>
                    @if(array_has(session('data'),'solicit_por_cedula'))
                        @foreach(array_get(session('data'),'solicit_por_cedula') as $datos)
                            <tr>
                                <td>{{ $datos->cedula }}</td>
                                <td><a href="{{ route(array_get(session('data'),'ruta'),['ci' => $datos->id]) }}">{{ strtoupper($datos->nombres)}}</a></td>
                                <td>{{ strtoupper($datos->municipio) }}</td>
                                <td>{{ strtoupper($datos->parroquia) }}</td>
                                @if(isset($datos->solicitud))
                                    <td>{{ strtoupper($datos->solicitud) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    @if(array_has(session('data'),'solicitantes'))
                        {{-- dd(array_get(session('data'),'solicitantes')) --}}
                        @foreach(array_get(session('data'),'solicitantes') as $datos)
                            <tr>
                                <td>{{ $datos->cedula }}</td>
                                <td><a href="{{ route('solicitantes-detalle',['ci' => $datos->id]) }}">{{ strtoupper($datos->nombres)}}</a></td>
                                <td>{{ strtoupper($datos->municipio) }}</td>
                                <td>{{ strtoupper($datos->parroquia) }}</td>
                                @if(isset($datos->solicitud))
                                    <td>{{ strtoupper($datos->solicitud) }}</td>
                                @endif
                                @if(isset($datos->centro))
                                    <td>{{ strtoupper($datos->centro) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    @if(array_has(session('data'),'solicitantes-ayudas'))
                        @foreach(array_get(session('data'),'solicitantes-ayudas') as $datos)
                            <tr>
                                <td>{{ $datos->id }}</td>
                                <td><a href="{{ route('ver-ayuda',['id' => $datos->id]) }}">{{ strtoupper($datos->solicitante)}}</a></td>
                                <td>{{ strtoupper($datos->evento) }}</td>
                                <td>{{ strtoupper($datos->tipo) }}</td>
                                <td>{{ strtoupper($datos->fecha) }}</td>
                                <td>{{ strtoupper($datos->estatus) }}</td>
                                <td>{{ strtoupper($datos->procesada) }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('ver-ayuda', $datos->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                    <a href="{{ route('editar-ayuda', $datos->id) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                    <a href="{{ route('ver-ayuda', $datos->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if(array_has(session('data'),'solicitantesNoCne'))
                        @foreach(array_get(session('data'),'solicitantesNoCne') as $datos)
                            <tr>
                                <td>{{ $datos->cedula }}</td>
                                <td><a href="{{ route('solicitantesNoCne-detalle',['ci' => $datos->id]) }}">{{ strtoupper($datos->nombres)}}</a></td>
                                <td>{{ strtoupper($datos->municipio) }}</td>
                                <td>{{ strtoupper($datos->parroquia) }}</td>
                                @if(isset($datos->solicitud))
                                    <td>{{ strtoupper($datos->solicitud) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    @if(array_has(session('data'),'solicitantesnocne-ayudas'))
                        @foreach(array_get(session('data'),'solicitantesnocne-ayudas') as $datos)
                            <tr>
                                <td>{{ $datos->id }}</td>
                                <td><a href="{{ route('ver-ayuda-nocne',['id' => $datos->id]) }}">{{ strtoupper($datos->solicitante)}}</a></td>
                                <td>{{ strtoupper($datos->evento) }}</td>
                                <td>{{ strtoupper($datos->tipo) }}</td>
                                <td>{{ strtoupper($datos->fecha) }}</td>
                                <td>{{ strtoupper($datos->estatus) }}</td>
                                <td>{{ strtoupper($datos->procesada) }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('ver-ayuda-nocne', $datos->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                    <a href="{{ route('editar-ayuda', $datos->id) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                    <a href="{{ route('ver-ayuda-nocne', $datos->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if(array_has(session('data'),'instituciones'))
                        @foreach(array_get(session('data'),'instituciones') as $datos)
                            <tr>
                                <td>{{ $datos->cedula }}</td>
                                <td><a href="{{ route('solicitantesInst-detalle',['ci' => $datos->id]) }}">{{ strtoupper($datos->nombres)}}</a></td>
                                <td>{{ strtoupper($datos->municipio) }}</td>
                                <td>{{ strtoupper($datos->parroquia) }}</td>
                                @if(isset($datos->solicitud))
                                    <td>{{ strtoupper($datos->solicitud) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    @if(array_has(session('data'),'instituciones_ayudas'))
                        @foreach(array_get(session('data'),'instituciones_ayudas') as $datos)
                            <tr>
                                <td>{{ $datos->id }}</td>
                                <td><a href="{{ route('ver-ayuda-inst',['id' => $datos->id]) }}">{{ strtoupper($datos->solicitante)}}</a></td>
                                <td>{{ strtoupper($datos->evento) }}</td>
                                <td>{{ strtoupper($datos->tipo) }}</td>
                                <td>{{ strtoupper($datos->fecha) }}</td>
                                <td>{{ strtoupper($datos->estatus) }}</td>
                                <td>{{ strtoupper($datos->procesada) }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('ver-ayuda-inst', $datos->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                    <a href="{{ route('editar-ayuda', $datos->id) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                    <a href="{{ route('ver-ayuda-inst', $datos->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-warning" role="alert"><h3>{{ session('error') }}</h3></div>
@endif
@endsection

@section('js')
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-scroller/js/datatables.scroller.min.js')}}"></script>
    <script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script>
        $(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('.datatable-scroller').DataTable({
                //ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollX: true,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                    { orderable: false, targets: [0] }
                ]
            });
            $datatable.on('draw.dt', function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });


        /** Opciones campos de busqueda de solicitantes **/
        $(document).ready(function () {
            $.ajax({
                url: 'filtros',
                headers: {'X-CSRF-TOKEN': $('#token').val()},
                type: 'POST',
                dataType: 'JSON'
                ,
                success: function (resp) {
                    $.each(resp.municipios, function (k, v) {
                        $('#municipio select').append('<option value=' + v.id + '>' + v.nombre.toUpperCase() + '</option>')
                    })

                    $.each(resp.parroquias, function (k, v) {
                        $('#parroquia select').append('<option value=' + v.id + '>' + v.nombre.toUpperCase() + '</option>')
                    })

                    $.each(resp.centros, function (k, v) {
                        $('#centro select').append('<option value=' + v.id + '>' + v.nombre.toUpperCase() + '</option>')
                    })

                    $.each(resp.solicitud, function (k, v) {
                        $('#tipoSolicitud select').append('<option value=' + v.id + '>' + v.nombre.toUpperCase() + '</option>')
                    })

                    $.each(resp.solicitud, function (k, v) {
                        $('#tipoSolicitud_a select').append('<option value=' + v.id + '>' + v.nombre.toUpperCase() + '</option>')
                    })
                }
            })
        })
        $('#buscar_selec').change(function () {
            var selec = $(this).val();
            if(selec == 'solicitante'){
                $('#buscar_solicitante').removeClass('hidden');
                $('#buscar_ayuda').addClass('hidden');
                $('#filtros_a').children().addClass('hidden');
                $('#opciones_a').val('todas');
                $('#buscar_por').attr('action','buscarTodos');
            }else{
                $('#buscar_solicitante').addClass('hidden');
                $('#buscar_ayuda').removeClass('hidden');
                $('#filtros_s').children().addClass('hidden');
                $('#opciones_s').val('todos');
                $('#buscar_por').attr('action','buscarTodasAyudas');
            }
        });

        $('#opciones_s').change(function () {
            var filtro = $('#opciones_s').val();

            if(filtro == 'todos'){
                $('#buscar_por').attr('action','buscarTodos');
                $('#buscar_por').val('todos');
                $('#filtros_s').children().addClass('hidden');
            }
            if(filtro == 'cedula'){
                $('#buscar_por').attr('action','buscarPorCedula');
                $('#cedula').siblings().addClass('hidden');
                $('#nac').fadeIn().removeClass('hidden')
                $('#cedula').fadeIn().removeClass('hidden')
            }
            if(filtro == 'codigo_rif'){
                $('#buscar_por').attr('action','buscarPorCodigoRif');
                $('#codigo_rif').siblings().addClass('hidden');
                $('#codigo_rif').fadeIn().removeClass('hidden')
            }
            if(filtro == 'tipoSolicitante'){
                $('#buscar_por').attr('action','buscarPorTipoSolicitante');
                $('#tipoSolicitante').siblings().addClass('hidden');
                $('#tipoSolicitante').fadeIn().removeClass('hidden')
            }
            if(filtro == 'tipoSolicitud'){
                $('#buscar_por').attr('action','buscarPorTipoSolicitud');
                $('#tipoSolicitud').siblings().addClass('hidden');
                $('#tipoSolicitud').fadeIn().removeClass('hidden')
            }
            if(filtro == 'municipio'){
                $('#buscar_por').attr('action','buscarPorMunicipio');
                $('#municipio').siblings().addClass('hidden');
                $('#municipio').fadeIn().removeClass('hidden')
            }
            if(filtro == 'parroquia'){
                $('#buscar_por').attr('action','buscarPorParroquia');
                $('#parroquia').siblings().addClass('hidden');
                $('#parroquia').fadeIn().removeClass('hidden')
            }
            if(filtro == 'centro'){
                $('#buscar_por').attr('action','buscarPorCentro');
                $('#centro').siblings().addClass('hidden');
                $('#centro').fadeIn().removeClass('hidden')
            }
        })
        $('#opciones_a').change(function () {
            var filtro = $('#opciones_a').val();

            if(filtro == 'todas'){
                $('#buscar_por').attr('action','buscarTodasAyudas');
                $('#filtros_a').children().addClass('hidden');
            }
            if(filtro == 'id'){
                $('#buscar_por').attr('action','ayudaNumero');
                $('#numero').siblings().addClass('hidden');
                $('#numero').fadeIn().removeClass('hidden')
                $('#tipo_sol').fadeIn().removeClass('hidden')
            }
            if(filtro == 'tipoSolicitud'){
                $('#buscar_por').attr('action','porTipoSolicitud');
                $('#tipoSolicitud_a').siblings().addClass('hidden');
                $('#tipoSolicitud_a').fadeIn().removeClass('hidden')
            }
        })
        /** /Opciones campos de busqueda de solicitantes **/
    </script>
@endsection
