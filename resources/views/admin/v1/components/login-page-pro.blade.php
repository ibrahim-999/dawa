<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{$pageTitle}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin-panel-assets/v1')}}/images/favicon.ico">

    <!-- App css -->
    <link href="{{asset('admin-panel-assets/v1')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('admin-panel-assets/v1')}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{asset('admin-panel-assets/v1')}}/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
    <link href="{{asset('admin-panel-assets/v1')}}/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

    <!-- icons -->
    <link href="{{asset('admin-panel-assets/v1')}}/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-left">
                    <div class="auth-logo">
                        <a href="{{$baseUrl}}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{$logo}}"
                                                     alt="" height="100">
                                            </span>
                        </a>
                    </div>
                </div>

                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Sign In as a Pharmacy</p>

                <!-- form -->
                <form action="{{$url}}" enctype="application/x-www-form-urlencoded" class="needs-validation was-validated" method="post">
                    @csrf
                    {{$inputs}}
                    {{$buttons}}
                </form>
                <!-- end form-->

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center" style="background-image: url({{asset('admin-panel-assets/v1')}}/images/pharmacy.jpg);">
{{--        <div class="auth-user-testimonial">--}}
{{--            <h2 class="mb-3 ">I love the color!</h2>--}}
{{--            <p class="lead"><i class="mdi mdi-format-quote-open">--}}

{{--                </i>--}}
{{--                I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need.--}}
{{--                <i class="mdi mdi-format-quote-close"></i>--}}
{{--            </p>--}}
{{--            <h5 class="text-white">--}}
{{--                - Fadlisaad (Ubold Admin User)--}}
{{--            </h5>--}}
{{--        </div> <!-- end auth-user-testimonial-->--}}
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- Vendor js -->
<script src="{{asset('admin-panel-assets/v1')}}/js/vendor.min.js"></script>

<!-- App js -->
<script src="{{asset('admin-panel-assets/v1')}}/js/app.min.js"></script>

</body>
</html>
