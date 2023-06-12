<!-- ========== Left Sidebar Start ========== -->
@php
    $admin=auth('web-admin')->user();
@endphp
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('admin-panel-assets/v1')}}/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                 class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                   data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <x-admin.v1.sidebar.single-navigation-item reference="{{route('dashboard')}}"
                                                           title="{{__('labels.dashboard')}}" badge="dev">
                    <x-slot name="icon"><i data-feather="airplay"></i></x-slot>
                </x-admin.v1.sidebar.single-navigation-item>

                <li class="menu-title mt-2">Apps</li>

                @if($admin->can('create_admins') || $admin->can('index_admins') )
                    <x-admin.v1.sidebar.menu-navigation-item name="admins" title="{{__('labels.admins')}}" badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_admins')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('admins.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('index_admins')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('admins.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.admins')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif


                @if($admin->can('create_vendors') || $admin->can('index_vendors') )
                    <x-admin.v1.sidebar.menu-navigation-item name="vendors" title="{{__('labels.vendors')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_vendors')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('admin.vendors.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_vendors')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('admin.vendors.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.vendors')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif

                @if($admin->can('create_admin_roles') || $admin->can('index_roles')|| $admin->can('create_vendor_roles') )
                    <x-admin.v1.sidebar.menu-navigation-item name="roles" title="{{__('labels.roles')}}" badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_admin_roles')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('roles.create')}}"
                                                                           title="{{__('labels.admin_roles')}}"
                                                                           badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_vendor_roles')
                                <x-admin.v1.sidebar.single-navigation-item
                                    reference="{{route('roles.create',['guard'=>'web-vendor'])}}"
                                    title="{{__('labels.vendor_roles')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('index_roles')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('roles.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.roles')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_chains')|| $admin->can('create_chains') )
                    <x-admin.v1.sidebar.menu-navigation-item name="chains" title="{{__('labels.chains')}}" badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_chains')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('chains.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('index_chains')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('chains.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.chains')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif

                @if($admin->can('index_pharmacies')|| $admin->can('create_pharmacies') )
                    <x-admin.v1.sidebar.menu-navigation-item name="pharmacies" title="{{__('labels.pharmacies')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('index_pharmacies')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('pharmacies.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_pharmacies')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('pharmacies.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.pharmacies')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif

                @if($admin->can('index_categories')|| $admin->can('create_categories') )
                    <x-admin.v1.sidebar.menu-navigation-item name="categories" title="{{__('labels.categories')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('index_categories')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('categories.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_categories')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('categories.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.categories')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_brands')|| $admin->can('create_brands') )
                    <x-admin.v1.sidebar.menu-navigation-item name="brands" title="{{__('labels.brands')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('index_brands')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('brands.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_brands')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('brands.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.brands')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_products')|| $admin->can('create_products') )
                    <x-admin.v1.sidebar.menu-navigation-item name="products" title="{{__('labels.products')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('index_products')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('products.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_products')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('products.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.products')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_carts') )
                    <x-admin.v1.sidebar.menu-navigation-item name="carts" title="{{__('labels.cart')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="cart"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('index_carts')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('admin.cart.index')}}"
                                                                           title="{{__('labels.cart')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.cart')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_users')|| $admin->can('create_users') )
                    <x-admin.v1.sidebar.menu-navigation-item name="users" title="{{__('labels.users')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('index_users')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('users.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('create_users')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('users.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.users')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_drivers')|| $admin->can('create_drivers') )
                    <x-admin.v1.sidebar.menu-navigation-item name="drivers" title="{{__('labels.drivers')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_drivers')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('drivers.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('index_drivers')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('drivers.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.drivers')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_coupons')|| $admin->can('index_coupons') )
                    <x-admin.v1.sidebar.menu-navigation-item name="coupons" title="{{__('labels.coupons')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_coupons')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('coupons.create')}}"
                                                                           title="{{__('labels.add')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-plus-square nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                            @can('index_coupons')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('coupons.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.coupons')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
                @if($admin->can('index_carts')|| $admin->can('create_carts') )
                    <x-admin.v1.sidebar.menu-navigation-item name="users" title="{{__('labels.cart')}}"
                                                             badge="dev">
                        <x-slot name="icon"><i data-feather="users"></i></x-slot>
                        <x-slot name="badge"></x-slot>
                        <x-slot name="items">
                            @can('create_carts')
                                <x-admin.v1.sidebar.single-navigation-item reference="{{route('admin.cart.index')}}"
                                                                           title="{{__('labels.index')}}" badge="dev">
                                    <x-slot name="icon"><i class="far fa-list-alt nav-icon"></i></x-slot>
                                </x-admin.v1.sidebar.single-navigation-item>
                            @endcan
                        </x-slot>
                        <x-slot name="title">{{__('labels.cart')}}</x-slot>
                    </x-admin.v1.sidebar.menu-navigation-item>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
