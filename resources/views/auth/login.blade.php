<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f8f9fc;
        }
    </style>

</head>

<body class="bg-gradient-primary">
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5 w-50">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h5 class="mb-0"><strong>Login Page</strong></h5>
                        <p class="text-muted mt-2">Sign in to continue to Dashboard.</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="user">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control form-control-user" id="email" placeholder="Enter Email Address...">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    </form>
                    <hr>
                    {{-- <div class="text-center">
                        <a class="small" href="{{ route('forgot-password') }}">Forgot Password?</a>
                    </div> --}}
                    {{-- <div class="text-center">
                        <label class="small" for="">Don't have an account?</label>
                        <a class="small" href="{{ route('register') }}">Register!</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
