<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin-panel-assets/v1')}}/images/favicon.png">

    <!-- plugin css -->
    <link href="{{asset('admin-panel-assets/v1')}}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css"/>

    <!-- App css -->
    <link href="{{asset('admin-panel-assets/v1')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="{{asset('admin-panel-assets/v1')}}/css/app.min.css" rel="stylesheet" type="text/css"
          id="app-default-stylesheet"/>

    <link href="{{asset('admin-panel-assets/v1')}}/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet" disabled/>
    <link href="{{asset('admin-panel-assets/v1')}}/css/app-dark.min.css" rel="stylesheet" type="text/css"
          id="app-dark-stylesheet" disabled/>

    <!-- icons -->
    <link href="{{asset('admin-panel-assets/v1')}}/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin-panel-assets/v1')}}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin-panel-assets/v1')}}/libs/nestable2/jquery.nestable.min.css" rel="stylesheet"/>
    <link href="{{asset('admin-panel-assets/v1')}}/css/tree.css" rel="stylesheet"/>
    <link href="{{asset('admin-panel-assets/v1')}}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin-panel-assets/v1')}}/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('admin-panel-assets/v1')}}/libs/chartist/chartist.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link href="{{asset('admin-panel-assets/v1')}}/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-panel-assets/v1')}}/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-panel-assets/v1')}}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-panel-assets/v1')}}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-panel-assets/v1')}}/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-panel-assets/v1')}}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

    {{-- <link href="{{asset('admin-panel-assets/v1')}}/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{asset('admin-panel-assets/v1')}}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{asset('admin-panel-assets/v1')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" /> --}}

</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    <x-admin.v1.layout.partials.top-bar userName="{{auth('web-admin')->user()?->name}}">

    </x-admin.v1.layout.partials.top-bar>
    <x-admin.v1.layout.partials.sidebar>

    </x-admin.v1.layout.partials.sidebar>


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @yield('content')
            </div> <!-- container -->

        </div> <!-- content -->


        <x-admin.v1.layout.partials.footer>

        </x-admin.v1.layout.partials.footer>
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link py-2" data-toggle="tab" href="#chat-tab" role="tab">
                    <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-2" data-toggle="tab" href="#tasks-tab" role="tab">
                    <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                    <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-0">
            <div class="tab-pane" id="chat-tab" role="tabpanel">

                <form class="search-bar p-3">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="mdi mdi-magnify"></span>
                    </div>
                </form>

                <h6 class="font-weight-medium px-3 mt-2 text-uppercase">Group Chats</h6>

                <div class="p-2">
                    <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                        <span class="mb-0 mt-1">App Development</span>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-warning"></i>
                        <span class="mb-0 mt-1">Office Work</span>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-danger"></i>
                        <span class="mb-0 mt-1">Personal Group</span>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item pl-3 d-block">
                        <i class="mdi mdi-checkbox-blank-circle-outline mr-1"></i>
                        <span class="mb-0 mt-1">Freelance</span>
                    </a>
                </div>

                <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Favourites <a href="javascript: void(0);"
                                                                                      class="font-18 text-danger"><i
                            class="float-right mdi mdi-plus-circle"></i></a></h6>

                <div class="p-2">
                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-10.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status online"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Andrew Mackie</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-1.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status away"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Rory Dalyell</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-9.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status busy"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Jaxon Dunhill</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Other Chats <a href="javascript: void(0);"
                                                                                       class="font-18 text-danger"><i
                            class="float-right mdi mdi-plus-circle"></i></a></h6>

                <div class="p-2 pb-4">
                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-2.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status online"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Jackson Therry</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-4.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status away"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Charles Deakin</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-5.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status online"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Ryan Salting</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">If several languages coalesce the grammar of the
                                        resulting.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-6.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status online"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Sean Howse</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-7.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status busy"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Dean Coward</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset notification-item">
                        <div class="media">
                            <div class="position-relative mr-2">
                                <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-8.jpg"
                                     class="rounded-circle avatar-sm" alt="user-pic">
                                <i class="mdi mdi-circle user-status away"></i>
                            </div>
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1 font-14">Hayley East</h6>
                                <div class="font-13 text-muted">
                                    <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="text-center mt-3">
                        <a href="javascript:void(0);" class="btn btn-sm btn-white">
                            <i class="mdi mdi-spin mdi-loading mr-2"></i>
                            Load more
                        </a>
                    </div>
                </div>

            </div>

            <div class="tab-pane" id="tasks-tab" role="tabpanel">
                <h6 class="font-weight-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                <div class="px-2">
                    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                        <p class="text-muted mb-0">App Development<span class="float-right">75%</span></p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                        <p class="text-muted mb-0">Database Repair<span class="float-right">37%</span></p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                        <p class="text-muted mb-0">Backup Create<span class="float-right">52%</span></p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 52%"
                                 aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>
                </div>

                <h6 class="font-weight-medium px-3 mb-0 mt-4 text-uppercase">Upcoming Tasks</h6>

                <div class="p-2">
                    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                        <p class="text-muted mb-0">Sales Reporting<span class="float-right">12%</span></p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                        <p class="text-muted mb-0">Redesign Website<span class="float-right">67%</span></p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 67%"
                                 aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                        <p class="text-muted mb-0">New Admin Design<span class="float-right">84%</span></p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 84%"
                                 aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>
                </div>

                <div class="p-3 mt-2">
                    <a href="javascript: void(0);" class="btn btn-success btn-block waves-effect waves-light">Create
                        Task</a>
                </div>

            </div>
            <div class="tab-pane active" id="settings-tab" role="tabpanel">
                <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                    <span class="d-block py-1">Theme Settings</span>
                </h6>

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                               id="light-mode-check" checked/>
                        <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                               id="dark-mode-check"/>
                        <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                    </div>

                    <!-- Width -->
                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check"
                               checked/>
                        <label class="custom-control-label" for="fluid-check">Fluid</label>
                    </div>
                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check"/>
                        <label class="custom-control-label" for="boxed-check">Boxed</label>
                    </div>

                    <!-- Menu positions -->
                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="menus-position" value="fixed"
                               id="fixed-check"
                               checked/>
                        <label class="custom-control-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="menus-position" value="scrollable"
                               id="scrollable-check"/>
                        <label class="custom-control-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <!-- Left Sidebar-->
                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light"
                               id="light-check" checked/>
                        <label class="custom-control-label" for="light-check">Light</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark"
                               id="dark-check"/>
                        <label class="custom-control-label" for="dark-check">Dark</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand"
                               id="brand-check"/>
                        <label class="custom-control-label" for="brand-check">Brand</label>
                    </div>

                    <div class="custom-control custom-switch mb-3">
                        <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient"
                               id="gradient-check"/>
                        <label class="custom-control-label" for="gradient-check">Gradient</label>
                    </div>

                    <!-- size -->
                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default"
                               id="default-size-check" checked/>
                        <label class="custom-control-label" for="default-size-check">Default</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed"
                               id="condensed-check"/>
                        <label class="custom-control-label" for="condensed-check">Condensed <small>(Extra Small
                                size)</small></label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
                               id="compact-check"/>
                        <label class="custom-control-label" for="compact-check">Compact <small>(Small
                                size)</small></label>
                    </div>

                    <!-- User info -->
                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                    <div class="custom-control custom-switch mb-1">
                        <input type="checkbox" class="custom-control-input" name="leftsidebar-user" value="fixed"
                               id="sidebaruser-check"/>
                        <label class="custom-control-label" for="sidebaruser-check">Enable</label>
                    </div>


                    <!-- Topbar -->
                    <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="topbar-color" value="dark"
                               id="darktopbar-check"
                               checked/>
                        <label class="custom-control-label" for="darktopbar-check">Dark</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="topbar-color" value="light"
                               id="lighttopbar-check"/>
                        <label class="custom-control-label" for="lighttopbar-check">Light</label>
                    </div>


                    <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                    <a href="https://1.envato.market/uboldadmin"
                       class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i>
                        Purchase Now</a>

                </div>

            </div>
        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="{{asset('admin-panel-assets/v1')}}/js/vendor.min.js"></script>

<!-- Plugins js-->
<script src="{{asset('admin-panel-assets/v1')}}/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<script
    src="{{asset('admin-panel-assets/v1')}}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script
    src="{{asset('admin-panel-assets/v1')}}/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- Dashboard 2 init -->
<script src="{{asset('admin-panel-assets/v1')}}/js/pages/dashboard-2.init.js"></script>

<!-- App js-->
<script src="{{asset('admin-panel-assets/v1')}}/js/app.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/select2/js/select2.min.js"></script>
<!-- Plugins js-->
<script src="{{asset('admin-panel-assets/v1')}}/libs/nestable2/jquery.nestable.min.js"></script>

<!-- Nestable init-->
<script src="{{asset('admin-panel-assets/v1')}}/js/pages/nestable.init.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/js/tree.js"></script>
<!-- Footable js -->
<script src="{{asset('admin-panel-assets/v1')}}/libs/footable/footable.all.min.js"></script>

<!-- Init js -->
<script src="{{asset('admin-panel-assets/v1')}}/js/pages/foo-tables.init.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/selectize/js/standalone/selectize.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/multiselect/js/jquery.multi-select.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/js/pages/form-advanced.init.js"></script>

{{-- <script src="{{asset('admin-panel-assets/v1')}}/libs/selectize/js/standalone/selectize.min.js"></script> --}}
{{-- <script src="{{asset('admin-panel-assets/v1')}}/js/standalone/selectize.min.js"></script> --}}
{{-- <script src="{{asset('admin-panel-assets/v1')}}/libs/selectize/js/standalone/selectize.min.js"></script> --}}
<script src="{{asset('admin-panel-assets/v1')}}/libs/mohithg-switchery/switchery.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/multiselect/js/jquery.multi-select.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/select2/js/select2.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/bootstrap-select/js/bootstrap-select.min.js"></script>

<!--Chartist Chart-->
<script src="{{asset('admin-panel-assets/v1')}}/libs/chartist/chartist.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>

<!-- Init js -->
<script src="{{asset('admin-panel-assets/v1')}}/js/pages/chartist.init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Plugins js-->
<script src="{{asset('admin-panel-assets/v1')}}/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

<!-- Init js-->

<script src="{{asset('admin-panel-assets/v1')}}/js/pages/form-wizard.init.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/libs/mohithg-switchery/switchery.min.js"></script>
<script src="{{asset('admin-panel-assets/v1')}}/js/pages/form-advanced.init.js"></script>

 @include('admin.v1.partials.alerts')
@include('admin.v1.partials.ajax_alerts')
<script>
    {{--

selcect group script
 --}}
    $(".select-group-selector").change(function () {
        var group = $(this).data("group");
        var inputsDivClass = 'select-group-' + group;
        var groupInputs = $('.' + inputsDivClass).find('input:checkbox');
        if (this.checked) {
            groupInputs.each(function () {
                $(this).prop('checked', true);
            });
        } else {
            groupInputs.each(function () {
                $(this).prop('checked', false);
            });
        }
    });
</script>

<script src="{{asset('admin-panel-assets/v1/js/fetch-notification.js')}}"></script>
{{-- end of script --}}
@yield('scripts')
@stack('custom-scripts')
</body>
</html>
