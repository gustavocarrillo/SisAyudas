<div class="x_panel" id="xpanel">
    @include('admin.partials.error')
    @if(session('firma'))
        <div class="alert alert-info" role="alert"><h3>FIRMO A FAVOR DEL REVOCATORIO</h3></div>
    @endif
    <div class="x_title">
        <h2>Datos Personales</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br>
        <form data-parsley-validate="" class="form-horizontal form-label-left">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <input type="hidden" value="cne" id="tipo">
            <input type="hidden" name="registro" value="{{ session('existe') }}" id="registro">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de recepción:
                </label>
                <div class="col-md-2 col-sm-2 col-xs-4">
                    <input type="text" id="fecha" name="fecha" value="" class="form-control col-md-5 col-xs-12" required="required" placeholder="Click Aqui"  readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cedula:
                </label>
                <div class="col-md-1 col-sm-1 col-xs-2">
                    <input type="text" id="nac" name="nac" value="{{ array_get(session('data'),'datos.nacionalidad') }}" class="form-control col-md-7 col-xs-12" required="required" readonly>
                </div>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="cedula" name="cedula" value="{{ array_get(session('data'),'datos.cedula') }}" class="form-control col-md-7 col-xs-12" required="required" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombres:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @if(array_has(session('data'),'datos.nombre1'))
                        <input type="text" id="nombres" name="nombres" value="{{ array_get(session('data'),'datos.nombre1').' '.array_get(session('data'),'datos.nombre2') }}"class="form-control col-md-7 col-xs-12"  required="required" readonly>
                    @else
                        <input type="text" id="nombres" name="nombres" value="{{ array_get(session('data'),'datos.nombres').' '.array_get(session('data'),'datos.nombre2') }}"class="form-control col-md-7 col-xs-12"  required="required" readonly>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Apellidos:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @if(array_has(session('data'),'datos.apellido1'))
                        <input type="text" id="apellidos" name="apellidos" value="{{ array_get(session('data'),'datos.apellido1').' '.array_get(session('data'),'datos.apellido2') }}" required="required" class="form-control col-md-7 col-xs-12" readonly>
                    @else
                        <input type="text" id="apellidos" name="apellidos" value="{{ array_get(session('data'),'datos.apellidos').' '.array_get(session('data'),'datos.apellido2') }}" required="required" class="form-control col-md-7 col-xs-12" readonly>
                    @endif
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="direccion" name="direccion" value="{{ array_get(session('data'),'datos.direccion') }}"class="form-control col-md-7 col-xs-12"  required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="municipio" value="{{ array_get(session('data'),'datos.municipio') }}" class="form-control col-md-7 col-xs-12" type="text" name="municipio" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parroquia: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="parroquia" value="{{ array_get(session('data'),'datos.parroquia') }}" class="form-control col-md-7 col-xs-12" type="text" name="parroquia" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Centro: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="centro" value="{{ array_get(session('data'),'datos.centro') }}" class="form-control col-md-7 col-xs-12" type="text" name="centro" readonly>
                </div>
            </div>
        <div class="x_title">
            <h2>Nueva Ayuda</h2>
            <div class="clearfix"></div>
        </div>

        {{--SI FIRMA EXISTE, NO CARGARA CAMPOS DE AYUDA--}}
        @if(session('firma'))
            <div class="x_content" id="div_clave">
                <div class="form-group">
                    <div id="msj-clave" class="col-md-4 col-sm-4 col-xs-8 col-md-offset-3 alert alert-danger" role="alert" style="display: none"></div>
                </div>
                <div class="form-group">
                    <label for="clave" class="control-label col-md-3 col-sm-3 col-xs-12">Desbloquear campos:</label>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <input type="password" id="clave" name="clave" value="" class="form-control col-sm-2 col-xs-2" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1 col-sm-2 col-xs-12 col-md-offset-3">
                        <a class="btn btn-success" id="desbloq">Desbloquear</a>
                    </div>
                   {{--
                   <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-1">
                        <a href="{{ route('ayudas-naturales') }}" class="btn btn-danger">Finalizar Registro</a>
                    </div>
                    --}}
                </div>
            </div>
            @endif
            <div class="x_content" id="campos_ayuda" style="{{session('visibilidad')}}">
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
                        <select id="solicitud" class="select2_group form-control" name="solicitudes">
                            <option value="">Seleccione...</option>
                            @foreach(session('ts') as $t)
                                <option value="{{ $t->id }}">{{ ucfirst($t->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nescesidad: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="necesidad" name="necesidad" class="form-control" rows="6"></textarea>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-1 col-sm-2 col-xs-12 col-md-offset-3">
                        <a class="btn btn-success" id="guardar">Guardar</a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-3">
                        <a href="{{ route('ayudas-naturales') }}" class="btn btn-danger">Finalizar Registro</a>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>