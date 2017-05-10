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
            <h2>Datos Personales</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                @foreach(session('datos') as $dato)
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12 col-sm-12"><strong>@if(isset($dato->codigo))RIF: @else Cedula: @endif</strong></div>
                        <div class="col-md-12 col-sm-12">@if(isset($dato->codigo)){{ $dato->codigo }}@else{{ $dato->cedula }} @endif</div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12 col-sm-12"><strong>@if(isset( $dato->apellidos )) Nombres y Apellidos: @else Razon Social: @endif</strong></div>
                        <div class="col-md-12 col-sm-12">@if(isset( $dato->apellidos )) {{ $dato->nombres.' '.$dato->apellidos }} @else {{ $dato->nombres }} @endif</div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12 col-sm-12"><strong>Telefono: </strong></div>
                        <div class="col-md-12 col-sm-12">{{ $dato->telefono }}</div>
                    </div>
            </div>
            <br>
        </div>
        @if(isset($dato->responsable))
            <div class="x_title">
                <h2>Datos del Responsable</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-4 col-sm-4">
                        <div class="col-md-12 col-sm-12"><strong>Nombre: </strong></div>
                        <div class="col-md-12 col-sm-12">{{ $dato->responsable }}</div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12 col-sm-12"><strong>Cedula: </strong></div>
                        <div class="col-md-12 col-sm-12">{{ $dato->re_cedula }}</div>
                    </div>
                </div>
                <br>
            </div>
        @endif
        <div class="x_title">
            {{-- dd($datos) --}}
            <h2>Datos de Ubicación</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="col-md-12 col-sm-12"><strong>Dirección: </strong></div>
                    <div class="col-md-12 col-sm-12">{{ $dato->direccion }}</div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="col-md-12 col-sm-12"><strong>Municipio: </strong></div>
                    <div class="col-md-12 col-sm-12">{{ $dato->municipio }}</div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="col-md-12 col-sm-12"><strong>Parroquia: </strong></div>
                    <div class="col-md-12 col-sm-12">{{ $dato->parroquia }}</div>
                </div>
            </div>
            <br>
        </div>

        @if(isset($dato->discapacidad))
            <div class="x_title">
                {{-- dd($datos) --}}
                <h2>Datos de Discapacidad</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12"><strong>Discapacidad: </strong></div>
                        <div class="col-md-11">{{ $dato->discapacidad }}</div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12"><strong>Detalle de Discapacidad: </strong></div>
                        <div class="col-md-11">{{ $dato->discap_detalle }}</div>
                    </div>
                </div>
                <br>
            </div>
        @endif


        @if(isset($dato->centro))
            <div class="x_title">
                {{-- dd($datos) --}}
                <h2>Datos Electorales</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12 col-sm-12"><strong>Centro de Votación: </strong></div>
                        <div class="col-md-12 col-sm-12">{{ $dato->centro }}</div>
                    </div>
                </div>
                <br>
            </div>
        @endif

    </div>

    <div class="x_panel">
        <div class="x_content">
            <div class="col-md-offset-4">
                <a href="@if( isset($dato->codigo) ) {{ route('solicitantesInst-editar',$dato->id) }} @elseif(! isset($dato->centro) ) {{ route('solicitantesNoCne-editar',$dato->id) }} @else {{ route('solicitantes-editar',$dato->id) }} @endif" class="btn btn-primary btn-lg">Modificar Datos de Solicitante</a>
            </div>
        </div>
    </div>
    @endforeach

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

                @foreach(session('ayudas') as $ayuda)
                    <tr>
                        <td>{{ date('d-m-Y',strtotime($ayuda->fecha)) }}</td>
                        <td>{{ strtoupper($ayuda->tipo) }}</td>
                        @if($ayuda->estatus == 'PENDIENTE')
                            <td><span class="btn btn-sm btn-warning">{{ strtoupper($ayuda->estatus) }}</span></td>
                        @elseif($ayuda->estatus == 'NEGADA')
                            <td><span class="btn btn-sm btn-danger">{{ strtoupper($ayuda->estatus) }}</span></td>
                        @else
                            <td><span class="btn btn-sm btn-success">{{ strtoupper($ayuda->estatus) }}</span></td>
                        @endif
                        <td>{{ strtoupper($ayuda->procesada) }}</td>
                        @if(session('tipo') == 'no cne')
                            <td style="text-align: center">
                                <a href="{{ route('ver-ayuda-nocne', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('editar-ayuda', [$ayuda->id,session('tipo')]) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
                                <a href="{{ route('ver-ayuda-nocne', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-remove"></span></a>
                            </td>
                        @elseif(session('tipo') == 'inst')
                            <td style="text-align: center">
                                <a href="{{ route('ver-ayuda-inst', $ayuda->id) }}" class="btn btn-default"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('editar-ayuda', [$ayuda->id,session('tipo')]) }}" class="btn btn-default"><span class="fa fa-edit"></span></a>
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