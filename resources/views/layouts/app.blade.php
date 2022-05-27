<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.2/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

    {{-- Plantilla --}}
    <link rel="stylesheet" href="/template/css/app.css" />
    <link rel="stylesheet" href="/css/main.css">


</head>

<body class="app">
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Midone Tailwind HTML Admin Template" class="w-20" src="/template/images/logo.png">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                <a href="" class="menu menu--active">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> Dashboard </div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="users"></i> </div>
                    <div class="menu__title"> Usuarios <i data-feather="chevron-down" class="menu__sub-icon"></i>
                    </div>
                </a>
                <ul class="">
                    @if (auth()->user()->rol_id == 1)
                        <li>
                            <a href="/rol" class="menu">
                                <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="menu__title"> Gestión de roles </div>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="/usuario" class="menu">
                            <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                            <div class="menu__title"> Gestión de usuarios</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="package"></i> </div>
                    <div class="menu__title"> Productos <i data-feather="chevron-down" class="menu__sub-icon"></i>
                    </div>
                </a>
                <ul class="">
                    <li>
                        <a href="/categoria" class="menu">
                            <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                            <div class="menu__title"> Gestión de categorías </div>
                        </a>
                    </li>
                    <li>
                        <a href="/producto" class="menu">
                            <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                            <div class="menu__title"> Gestión de productos</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="shopping-cart"></i> </div>
                    <div class="menu__title"> Compras <i data-feather="chevron-down" class="menu__sub-icon"></i>
                    </div>
                </a>
                <ul class="">
                    @if (auth()->user()->rol_id == 1)
                        <li>
                            <a href="/proveedor" class="menu">
                                <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="menu__title"> Gestión de proveedores </div>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="/compra" class="menu">
                            <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                            <div class="menu__title"> Gestión de compras</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                    <div class="menu__title"> Ventas <i data-feather="chevron-down" class="menu__sub-icon"></i>
                    </div>
                </a>
                <ul class="">
                    <li>
                        <a href="/clientes" class="menu">
                            <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                            <div class="menu__title"> Gestión de clientes </div>
                        </a>
                    </li>
                    <li>
                        <a href="/ventas" class="menu">
                            <div class="menu__icon"> <i data-feather="hexagon"></i> </div>
                            <div class="menu__title"> Gestión de ventas</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone Tailwind HTML Admin Template" class="w-30" src="/template/images/logo.png">
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="/dashboard" class="side-menu ">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>

                    <a href="javascript:;"
                        class="{{ Request::url() == route('rol.index') || Request::url() == route('rol.crear') || Request::url() == route('usuario.index') || Request::url() == route('usuario.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">

                        <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="side-menu__title"> Usuarios <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul
                        class="{{ Request::url() == route('rol.index') || Request::url() == route('rol.crear') || Request::url() == route('usuario.index') || Request::url() == route('usuario.crear') ? 'side-menu__sub-open' : '' }}">

                        @if (auth()->user()->rol_id == 1)
                            <li>
                                <a href="/rol"
                                    class="{{ Request::url() == route('rol.index') || Request::url() == route('rol.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                    <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                    <div class="side-menu__title"> Gestión de roles </div>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="/usuario"
                                class="{{ Request::url() == route('usuario.index') || Request::url() == route('usuario.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="side-menu__title"> Gestión de usuarios </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"
                        class="{{ Request::url() == route('categoria.index') || Request::url() == route('categoria.crear') || Request::url() == route('producto.index') || Request::url() == route('producto.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon"> <i data-feather="package"></i> </div>
                        <div class="side-menu__title"> Productos <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul
                        class="{{ Request::url() == route('categoria.index') || Request::url() == route('categoria.crear') || Request::url() == route('producto.index') || Request::url() == route('producto.crear') ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <a href="/categoria"
                                class="{{ Request::url() == route('categoria.index') || Request::url() == route('categoria.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="side-menu__title"> Gestión de categorías </div>
                            </a>
                        </li>
                        <li>
                            <a href="/producto"
                                class="{{ Request::url() == route('producto.index') || Request::url() == route('producto.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="side-menu__title"> Gestión de productos </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"
                        class="{{ Request::url() == route('proveedor.index') || Request::url() == route('proveedor.crear') || Request::url() == route('compra.index') || Request::url() == route('compra.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon"> <i data-feather="shopping-cart"></i> </div>
                        <div class="side-menu__title"> Compras <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul
                        class="{{ Request::url() == route('proveedor.index') || Request::url() == route('proveedor.crear') || Request::url() == route('compra.index') ? 'side-menu__sub-open' : '' }}">

                        @if (auth()->user()->rol_id == 1)
                            <li>
                                <a href="/proveedor"
                                    class="{{ Request::url() == route('proveedor.index') || Request::url() == route('proveedor.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                    <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                    <div class="side-menu__title"> Gestión de proveedor </div>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="/compra"
                                class="{{ Request::url() == route('compra.index') || Request::url() == route('compra.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="side-menu__title"> Gestión de compras </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"
                        class="{{ Request::url() == route('clientes.index') || Request::url() == route('clientes.crear') || Request::url() == route('ventas.index') || Request::url() == route('ventas.index') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon"> <i data-feather="dollar-sign"></i> </div>
                        <div class="side-menu__title"> Ventas <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul
                        class="{{ Request::url() == route('clientes.index') || Request::url() == route('clientes.crear') || Request::url() == route('ventas.index') ? 'side-menu__sub-open' : '' }}">

                        <li>
                            <a href="/clientes"
                                class="{{ Request::url() == route('clientes.index') || Request::url() == route('clientes.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="side-menu__title"> Gestión de Clientes </div>
                            </a>
                        </li>

                        <li>
                            <a href="/ventas"
                                class="{{ Request::url() == route('ventas.index') || Request::url() == route('ventas.crear') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon"> <i data-feather="hexagon"></i> </div>
                                <div class="side-menu__title"> Gestión de Ventas </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="content">
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex"></div>
                <!-- END: Breadcrumb -->
                <div class="intro-x dropdown w-8 h-8 relative">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img alt="Midone Tailwind HTML Admin Template" src="/template/images/profile-12.jpg">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 text-white">
                            <div class="p-4 border-b border-theme-40">
                                <div class="font-medium">
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link" data-toggle="dropdown">
                                                {{ Auth::user()->name }}
                                            </a>
                                        </li>
                                    @endguest
                                </div>


                            </div>

                            <div class="p-2 border-t border-theme-40">
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md" href="
                                        {{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                        <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y mt-5 p-5  col-span-12 lg:col-span-12">
                <div class=" ">
                    @yield('content')
                </div>
            </div>

        </div>


    </div>

    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>

    <!-- ./wrapper -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
    @include('sweetalert::alert')
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Jquery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"
        integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->


    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>>

    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    {{-- <script src="/dist/js/adminlte.js"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="/dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="/dist/js/pages/dashboard.js"></script> --}}
    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/template/js/app.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/messages_es.js"></script>




    @yield('script')

</body>

</html>
