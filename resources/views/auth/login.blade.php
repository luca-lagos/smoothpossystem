<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema POS de abarrotes - Iniciar sesión</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
    <style>
        #img-login{
            height: 100%;
            width: 110%;
            padding: 20px;
            border-radius: 10px;
            object-fit: cover;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img id="img-login" src="https://tecsilogia.com/wp-content/uploads/2020/06/PoS-System-von-Elo-im-Einsatz.png" alt="example-login-image">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido a mi sistema!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Ingrese su email...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Ingrese su contraseña">
                                        </div>
                                        <!--<div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>-->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">INICIAR
                                            SESIÓN</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">¿Olvidaste tu contraseña?
                                            Recupérala desde aquí</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/scripts.js') }}"></script>

</body>

</html>
