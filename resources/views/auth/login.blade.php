<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SangalTec</title>

    {{-- <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css"> --}}
    <link rel="stylesheet" href="template/css/app.css" />
</head>

<body class="login">
    <!-- END: Head -->

    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">

                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                            src="template/images/logo.png">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Unos clics más para
                            <br>
                            Iniciar sesión en su cuenta.
                        </div>

                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Inicar sesión
                        </h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="intro-x mt-8">
                                <div>
                                    <label for="inputEmail">{{ __('Correo Electrónico') }}</label>
                                    <input id="inputEmail" type="email"
                                        class="intro-x login__input input input--lg border border-gray-300 block @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-6">
                                    <label for="inputPassword"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                                    <input id="inputPassword" type="password"
                                        class="intro-x login__input input input--lg border border-gray-300 block @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">



                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-8 mb-0">
                                    <button type="submit"
                                        class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">
                                        {{ __('Iniciar Sesion') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="small btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste Tu Contraseña?') }}
                                        </a>
                                    @endif


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.login-box -->

        <script src="template/js/app.js"></script>
    </body>

</html>



{{-- ---------------------- --}}
