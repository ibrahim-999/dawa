<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{$pageTitle}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin-panel-assets/v1/images/logo-dark.png')}}">

    <!-- App css -->
    <link href="{{asset('admin-panel-assets/v1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="{{asset('admin-panel-assets/v1/css/app.min.css')}}" rel="stylesheet" type="text/css"
          id="app-default-stylesheet"/>

    <link href="{{asset('admin-panel-assets/v1/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet" disabled/>
    <link href="{{asset('admin-panel-assets/v1/css/app-dark.min.css')}}" rel="stylesheet" type="text/css"
          id="app-dark-stylesheet" disabled/>

    <!-- icons -->
    <link href="{{asset('admin-panel-assets/v1/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{$baseUrl}}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{$logo}}"
                                                     alt="" height="150">
                                            </span>
                                </a>

                                <a href="{{$baseUrl}}l" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{$logo}}"
                                                     alt="" height="22">
                                            </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">{{$page_description}}</p>
                        </div>

                        <form action="{{$url}}" enctype="application/x-www-form-urlencoded" class="needs-validation was-validated" method="post">
                            @csrf
                            {{$inputs}}
                            {{$buttons}}
                        </form>

                        {{--                        <div class="text-center">--}}
                        {{--                            <h5 class="mt-3 text-muted">Sign in with</h5>--}}
                        {{--                            <ul class="social-list list-inline mt-3 mb-0">--}}
                        {{--                                <li class="list-inline-item">--}}
                        {{--                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="list-inline-item">--}}
                        {{--                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="list-inline-item">--}}
                        {{--                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="list-inline-item">--}}
                        {{--                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                {{--                <div class="row mt-3">--}}
                {{--                    <div class="col-12 text-center">--}}
                {{--                        <p> <a href="auth-recoverpw.html" class="text-white-50 ml-1">Forgot your password?</a></p>--}}
                {{--                        <p class="text-white-50">Don't have an account? <a href="auth-register.html" class="text-white ml-1"><b>Sign Up</b></a></p>--}}
                {{--                    </div> <!-- end col -->--}}
                {{--                </div>--}}
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    2015 -
    <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a>
</footer>

<!-- Vendor js -->
<script src="{{asset('admin-panel-assets/v1/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('admin-panel-assets/v1/js/app.min.js')}}"></script>

</body>
</html>
