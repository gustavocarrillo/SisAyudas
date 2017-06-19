    @include('admin.partials.error')
    @if(session('firma'))
        <div class="alert alert-info" role="alert"><h3>FIRMO A FAVOR DEL REVOCATORIO</h3></div>
    @endif

    <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos Personales</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Datos de Discapacidad</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Ayuda a Solicitar</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <form action="" class="form-horizontal">
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
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-1 col-sm-2 col-xs-12 col-md-offset-3">
                                            <a class="btn btn-success" id="guardar">Guardar</a>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-3">
                                            <a href="{{ route('ayudas-naturales') }}" class="btn btn-danger">Finalizar Registro</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                <form action="" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Discapacidad: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="discapacidad" class="form-control col-md-7 col-xs-12" name="discapacidad">
                                                <option value="">Seleccione...</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Detalle: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="discap_detalle" value="" class="form-control col-md-7 col-xs-12" type="text" name="discap_detalle">
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
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <form action="" class="form-horizontal">
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
                                            <select id="evento" name="evento" class="select2_group form-control">
                                                <option value="">Seleccione...</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="fecha_cont" style="display: none">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de recepción:
                                        </label>
                                        <div class="col-md-2 col-sm-2 col-xs-4">
                                            <input type="text" id="fecha" name="fecha" value="" class="form-control col-md-5 col-xs-12" required="required" placeholder="Click Aqui"  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitudes:</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="solicitud" class="select2_group form-control" name="solicitudes">
                                                <option value="">Seleccione...</option>

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
                                        <div class="col-md-1 col-sm-2 col-xs-12 col-md-offset-3">
                                            <a class="btn btn-success" id="guardar">Guardar</a>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-3">
                                            <a href="{{ route('ayudas-naturales') }}" class="btn btn-danger">Finalizar Registro</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
