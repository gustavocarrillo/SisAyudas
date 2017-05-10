@extends('admin.plantilla.plantilla')
@section('head')
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-ui-custom/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('contenido')
<div class="x_panel">
    <div class="x_title">

        <h2>Datos Personales:</h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content" style="display: block;">
        <form action="{{ route('solicitantes'.$tipo.'-editado') }}" method="post" class="form-horizontal form-label-left" novalidate="">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">@if( $tipo == 'Inst' ) RIF: @else Cedula: @endif</label>
                @if(! $tipo == 'Inst')
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <select name="nac" id="nac" class="form-control">
                            <option value="V" selected>V</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                @else
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <select name="tipo_reg" id=tipo_reg class="form-control">
                            <option value="J" selected>J</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                @endif
                <div class="col-md-4 col-sm-4 col-xs-4">
                    @if( $tipo == 'Inst')
                        <input type="text" id="codigo" name="codigo" value="{{ $solicitante->codigo_rif }}" class="form-control col-md-5 col-xs-12" required="required">
                    @else

                        <input type="text" id="cedula" name="cedula" value="{{ $solicitante->cedula }}" class="form-control col-md-5 col-xs-12" required="required">
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">@if( $tipo == 'Inst' )Razon Social: @else Nombres: @endif</label>
                <div class="col-md-6 col-sm-6 col-xs-4">
                @if( $tipo == 'Inst' )
                    <input type="text" id="razon_social" name="razon_social" value="{{ $solicitante->nombre }}" class="form-control col-md-5 col-xs-12" required="required">
                @else
                    <input type="text" id="nombres" name="nombres" value="{{ $solicitante->nombres }}" class="form-control col-md-5 col-xs-12" required="required">
                @endif
                </div>
            </div>

            @if( $tipo != 'Inst'  )
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellidos:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-4">
                        <input type="text" id="apellidos" name="apellidos" value="{{ $solicitante->apellidos }}" class="form-control col-md-5 col-xs-12" required="required">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Genero:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 7px">
                        M
                        <input type="radio" class="flat" name="genero" id="genero_m" value="M" @if($solicitante->genero == 'M') checked @endif required />
                        F
                        <input type="radio" class="flat" name="genero" id="genero_f" value="F" @if($solicitante->genero == 'F') checked @endif  />
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefono:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-4">
                    <input type="text" id="telefono" name="telefono" value="{{ $solicitante->telefono }}" class="form-control col-md-5 col-xs-12" required="required" >
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-4">
                    <input type="text" id="direccion" name="direccion" value="{{ $solicitante->direccion }}" class="form-control col-md-5 col-xs-12" required="required">
                </div>
            </div>

            @if( $tipo == 'Inst'  )
                <div class="x_title">

                    <h2>Datos del Responsable</h2>

                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-4">
                        <input type="text" id="responsable" name="responsable" value="{{ $solicitante->responsable }}" class="form-control col-md-5 col-xs-12" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cedula:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-4">
                        <input type="text" id="re_cedula" name="re_cedula" value="{{ $solicitante->re_cedula }}" class="form-control col-md-5 col-xs-12" required="required">
                    </div>
                </div>
            @endif

            <div class="x_title">

                <h2>@if( $tipo == 'Inst'  )Datos Geograficos: @else Datos Electorales: @endif</h2>

                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Municipio:</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="municipio" class="select2_group form-control" name="municipio">
                        <option value="">Seleccione...</option>
                        @foreach($municipios as $mun)
                            <option value="{{ $mun->id }}" @if($solicitante->id_municipio == $mun->id) selected @endif>{{ strtoupper($mun->nombre) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Parroquia:</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="parroquia" class="select2_group form-control" name="parroquia">
                        <option value="">Seleccione...</option>
                        @foreach($parroquias as $parr)
                            <option value="{{ $parr->id }}" @if($solicitante->id_parroquia == $parr->id) selected @endif>{{ strtoupper($parr->nombre) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if( $tipo == '' )
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Centro:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="centro" class="select2_group form-control" name="centro">
                            <option value="">Seleccione...</option>
                            @foreach($centros as $cntr)
                                <option value="{{ $cntr->id }}" @if($solicitante->id_centro == $cntr->id) selected @endif>{{ strtoupper($cntr->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if($tipo != 'Inst' )
                <div class="x_title">
                    <h2>Discapacidad:</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Discapacidad:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="id_discapacidad" class="select2_group form-control" name="id_discapacidad">
                            <option value="">Seleccione...</option>
                            @foreach($discapacidades as $discap)
                                <option value="{{ $discap->id }}" @if($solicitante->id_discapacidad == $discap->id) selected @endif>{{ strtoupper($discap->discapacidad) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Detalles de Discapacidad:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="discap_detalle" name="discap_detalle" value="{{ $solicitante->discap_detalle }}" class="form-control col-md-5 col-xs-12" required="required">
                    </div>
                </div>
            @endif

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                    <button type="submit" class="btn btn-primary">Cancelar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </div>

            <input type="hidden" name="id" value="{{ $solicitante->id }}">
            {{ csrf_field() }};

        </form>
    </div>
</div>
@endsection

@section('js')
    <script src={{ asset("vendors/select2/dist/js/select2.full.min.js") }}></script>
    <script src={{ asset("jquery-ui-custom/jquery-ui.js") }}></script>
    <script src={{ asset("js/personalizado.js") }}></script>
@endsection