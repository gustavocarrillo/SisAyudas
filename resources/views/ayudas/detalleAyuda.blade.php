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
        <div class="x_title">
            {{-- dd($datos) --}}
            @foreach($datos as $dato)
            <h2>Detalle de Ayuda - Solicitada por: {{ $dato->solicitante }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3"><strong>Nº: </strong></div>
                            <div class="col-md-10"><span class="fa fa-flag"></span>{{ $dato->id }}</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><strong>Fecha de Recepción: </strong></div>
                            <div class="col-md-10">{{ $dato->fecha }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5"><strong>Tipo de Solicitud: </strong></div>
                            <div class="col-md-10">{{ strtoupper($dato->solicitud) }}</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3"><strong>Estatus: </strong></div>
                            @if($dato->estatus == 'PENDIENTE')
                                <div class="col-md-10"><span class="btn btn-sm btn-warning">{{ strtoupper($dato->estatus) }}</span></div>
                            @elseif($dato->estatus == 'NEGADA')
                                <div class="col-md-10"><span class="btn btn-sm btn-danger">{{ strtoupper($dato->estatus) }}</span></>
                            @else
                                <div class="col-md-10"><span class="btn btn-sm btn-success">{{ strtoupper($dato->estatus) }}</span></div>
                            @endif
                        </div>
                    </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3"><strong>Procesada: </strong></div>
                        <div class="col-md-10">{{ $dato->procesada }}</div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"><strong>Detalle: </strong></div>
                        <div class="col-md-11">{{ $dato->detalle }}</div>
                    </div>
                </div>
            </div>
            @endforeach
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