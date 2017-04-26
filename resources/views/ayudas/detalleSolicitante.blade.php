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
        @include('flash::message')
        @if((session()->has('flash_notification.message')))
            {{ Session::forget('flash_notification.message')}}
        @endif
        <div class="x_title">
            {{-- dd($datos) --}}
            <h2>Detos del Solicitante</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                    @foreach($datos as $dato)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3"><strong>@if(isset($dato->codigo))Codigo: @else Cedula: @endif</strong></div>
                                <div class="col-md-10">@if(isset($dato->codigo)){{ $dato->codigo }}@else{{ $dato->cedula }} @endif</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><strong>@if(isset( $dato->apellidos )) Nombres y Apellidos: @else Razon Social: @endif</strong></div>
                                <div class="col-md-10">@if(isset( $dato->apellidos )) {{ $dato->nombres.' '.$dato->apellidos }} @else {{ $dato->nombres }} @endif</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3"><strong>Telefono: </strong></div>
                                <div class="col-md-10">{{ $dato->telefono }}</div>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3"><strong>Dirección: </strong></div>
                                <div class="col-md-10">{{ $dato->direccion }}</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2"><strong>Municipio: </strong></div>
                                <div class="col-md-11">{{ $dato->municipio }}</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2"><strong>Parroquia: </strong></div>
                                <div class="col-md-11">{{ $dato->parroquia }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($dato->centro))
                                <div class="row">
                                    <div class="col-md-5"><strong>Centro de Votación: </strong></div>
                                    <div class="col-md-11">{{ $dato->centro }}</div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

        </div>
    </div>
    <div class="x_panel">
        {{--@include('admin.partials.error')--}}
        <div class="x_title">
            {{-- dd($datos) --}}
            <h2>Ayudas Solicitidas</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Estatus</th>
                    <th>Procesada</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ayudas as $ayuda)
                    <tr>
                        <td>{{ strtoupper($ayuda->fecha) }}</td>
                        <td>{{ strtoupper($ayuda->tipo) }}</td>
                        @if($ayuda->estatus == 'PENDIENTE')
                            <td><span class="btn btn-sm btn-warning">{{ strtoupper($ayuda->estatus) }}</span></td>
                        @elseif($ayuda->estatus == 'NEGADA')
                            <td><span class="btn btn-sm btn-danger">{{ strtoupper($ayuda->estatus) }}</span></td>
                        @else
                            <td><span class="btn btn-sm btn-success">{{ strtoupper($ayuda->estatus) }}</span></td>
                        @endif
                        <td>{{ strtoupper($ayuda->procesada) }}</td>
                        @if($tipo == 'no cne')
                            <td style="text-align: center">
                                <a href="{{ route('ver-ayuda-nocne', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('editar-ayuda', [$ayuda->id,$tipo]) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                <a href="{{ route('ver-ayuda-nocne', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                            </td>
                        @elseif($tipo == 'inst')
                            <td style="text-align: center">
                                <a href="{{ route('ver-ayuda-inst', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('editar-ayuda', [$ayuda->id,$tipo]) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                <a href="{{ route('ver-ayuda-inst', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                            </td>
                        @else
                            <td style="text-align: center">
                                <a href="{{ route('ver-ayuda', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('editar-ayuda', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                <a href="{{ route('ver-ayuda', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

    </script>
@endsection