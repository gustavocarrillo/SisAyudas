<div class="x_panel">
    @include('admin.partials.error')
    @if(session('firma'))
        <div class="alert alert-danger" role="alert"><h5>FIRMA ENCONTRADA</h5></div>
    @endif

    <div class="x_title">
        <h2>Datos Personales</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br>
        <form data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <input type="hidden" value="nocne" id="tipo">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cedula:
                </label>

                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select name="nac" id="nac" class="form-control">
                        <option value="V" selected>V</option>
                        <option value="E">E</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="cedula" name="cedula" value="" class="form-control col-md-7 col-xs-12" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombres:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nombres" name="nombres" value=""class="form-control col-md-7 col-xs-12"  required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Apellidos:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="apellidos" name="apellidos" value="" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Genero:</label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 7px">
                    M
                    <input type="radio" class="flat" name="genero" id="genero_m" value="M" checked="" required /> F
                    <input type="radio" class="flat" name="genero" id="genero_f" value="F" />
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
                    <input type="text" id="direccion" name="direccion" value="" class="form-control col-md-7 col-xs-12"  required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_group form-control" name="municipio" id="municipio">
                        @foreach(session('municipios') as $m)
                            <option value="{{ $m->id }}">{{ strtoupper($m->nombre) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parroquia: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_group form-control" name="parroquia" id="parroquia">
                        @foreach(session('parroquias') as $p)
                            <option value="{{ $p->id }}">{{ strtoupper($p->nombre) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="x_title">
                <h2>Datos de Discapacidad</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Discapacidad: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="discapacidad" class="form-control col-md-7 col-xs-12" name="discapacidad">
                            <option value="">Seleccione...</option>
                            @foreach(session('discapacidades') as $disc)
                                <option value="{{ $disc->id }}">{{ strtoupper($disc->discapacidad) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Detalle: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="discap_detalle" value="" class="form-control col-md-7 col-xs-12" type="text" name="discap_detalle">
                    </div>
                </div>
            </div>

            <div class="x_title">
                <h2>Nueva Ayuda</h2>
                <div class="clearfix"></div>
            </div>
            <div class="alert alert-danger" role="alert" style="display: none" id="div_errores">
                <ul id="errores">
                </ul>
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Evento:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="evento" class="select2_group form-control" name="evento">
                            <option value="">Seleccione...</option>
                            @foreach(session('eventos') as $evn)
                                <option value="{{ $evn->id }}">{{ strtoupper($evn->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" id="fecha_cont" style="display: none">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de recepción:
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-4">
                        <input type="text" id="fecha" name="fecha" value="" class="form-control col-md-5 col-xs-12" placeholder="Click Aqui" required="required" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitudes:</label>
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
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Necesidad: </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="necesidad" name="necesidad" class="form-control" rows="6"></textarea>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a class="btn btn-success" id="guardar">Guardar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
