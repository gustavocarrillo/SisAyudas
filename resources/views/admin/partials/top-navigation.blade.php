<div class="top_nav">
    <div class="nav_menu">
        <nav>

            <div class="nav toggle  footer_a">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>


            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ url('img/fotos_user/'.Auth::user()->foto) }}" alt="">{{ Auth::user()->nombre }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{ route('registro') }}">Crear Usuario</a></li>
                        <li><a href="{{ route('nueva-clave-desb') }}">Crear Clave de Desbloqueo</a></li>
                        <li><a href="{{ route('salir') }}"><i class="fa fa-sign-out pull-right"></i>Cerrar Sesión</a></li>
                    </ul>
                 </li>

                 {{-- Mesnajes Recibidos --}}
                {{-- @include('admin.partials.mensajes') --}}
            </ul>
        </nav>
    </div>
</div>