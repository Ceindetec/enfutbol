<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->


        @if(!Auth::guest())
        <div class="user-panel">
            @if( Auth::user()->rol =="admin")

                <div class="pull-left image">
                    @if(Auth::user()->rol=="admin")
                        <img src="{{URL::to('images/'.Auth::user()->avatar)}}" alt="..." class="img-circle" style="width: 40px;height: 40px;">
                    @else
                        <img src="{{URL::to('dist/img/'.Auth::user()->avatar)}}" alt="..." class="img-circle" style="width: 30px;height: 30px;">
                    @endif

                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->getSitio->nombre}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
                @else

                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Luis Carlos Pineda</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
                @endif


        </div>
        @endif
        <!-- search form -->
{{--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menu de Navegación</li>

            @if(Auth::guest())


                @else





            @if( Auth::user()->rol =="superAdmin")
                <li class="{{ (\Request::route()->getName() == 'superAdmin') ? 'active' : '' }}">
                    <a href="{{route('superAdmin')}}">
                        <i class="fa fa-home" aria-hidden="true"></i> <span>Principal</span>
                    </a>
                </li>
                <li class="{{ (\Request::route()->getName() == 'registrarSitio') ? 'active' : '' }}">
                    <a href="{{route('registrarSitio')}}">
                        <i class="fa fa-futbol-o" aria-hidden="true"></i> <span>Registrar Nuevo Sitio</span>
                    </a>
                </li>
                <li class="{{ (\Request::route()->getName() == 'sitiosRegistrados') ? 'active' : '' }}">
                    <a href="{{route('sitiosRegistrados')}}">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <span>Sitios Registrados</span>
                    </a>
                </li>
                    <li class="{{ (\Request::route()->getName() == 'superTorneos') ? 'active' : '' }}">
                        <a href="{{route('superTorneos')}}">
                            <i class="fa fa-users" aria-hidden="true"></i> <span>Torneos</span>
                        </a>
                    </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                        <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                    </ul>
                </li>

                <li>
                    <a href="pages/widgets.html">
                        <i class="fa fa-th"></i> <span>Widgets</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
                    </a>
                </li>
            @elseif( Auth::user()->rol =="admin")
                    <li class="{{ (\Request::route()->getName() == 'administrador') ? 'active' : '' }}">
                        <a href="{{route('administrador')}}">
                            <i class="fa fa-home" aria-hidden="true"></i> <span>Principal</span>
                        </a>
                    </li>
                    <li class="{{ (\Request::route()->getName() == 'adminTokens') ? 'active' : '' }}">
                        <a href="{{route('adminTokens')}}">
                            <i class="fa fa-key" aria-hidden="true"></i> <span>Administrar Tokens</span>
                        </a>
                    </li>
                    <li class="{{ (\Request::route()->getName() == 'adminCanchas') ? 'active' : '' }}">
                        <a href="{{route('adminCanchas')}}">
                            <i class="fa fa-usd" aria-hidden="true"></i> <span>Administrar Canchas</span>
                        </a>
                    </li>
                    <li class="{{ (\Request::route()->getName() == 'planilla') ? 'active' : '' }}">
                        <a href="{{route('planilla')}}">
                            <i class="fa fa-bullhorn" aria-hidden="true"></i><span>Disponibilidades</span>
                        </a>
                    </li>
                    <li class="{{ (\Request::route()->getName() == 'reservasysanciones') ? 'active' : '' }}">
                        <a href="{{route('reservasysanciones')}}">
                            <i class="fa fa-bullhorn" aria-hidden="true"></i><span>Reserevas y sanciones</span>
                        </a>
                    </li>
            @elseif(Auth::user()->rol =="jugador")
                    <li class="{{ (\Request::route()->getName() == 'canchasTipo') ? 'active' : '' }}">
                        <a href="{{route('canchasTipo')}}">
                            <i class="fa fa-bullhorn" aria-hidden="true"></i><span>Canchas por tipo</span>
                        </a>
                    </li>

            @endif

            @endif


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>