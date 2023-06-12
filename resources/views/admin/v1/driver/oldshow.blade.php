@extends('admin.v1.layout')
@section('title',__('pages_title.edit_driver')."|".$driver->name)
@section('content')
<x-admin.v1.layout.partials.basic-page-header>
    <x-slot name="breadcrumbs">
        <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                     isActive="0"/>
        <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.drivers_show')}}"
                                                     url="{{route('drivers.index')}}" isActive="0"/>
        <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.drivers_show')}}-{{$driver->name}}" url=""
                                                     isActive="1"/>
    </x-slot>
    <x-slot name="title">
        {{__('texts.drivers_index_header')}}
    </x-slot>
</x-admin.v1.layout.partials.basic-page-header>
@php
    $comment = $driver->warningComment;
    $warnings = $comment?->profileComments->toArray();
    function checkArrHasKey($warnings, $value){  
        if ($warnings && is_array($warnings)) {
            foreach ($warnings as $warning) {
                if ($warning['input'] == $value) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
    function getMessagewithKey($warnings, $value){  
        if ($warnings && is_array($warnings)) {
            foreach ($warnings as $warning) {
                if ($warning['input'] == $value) {
                    return $warning['message'];
                }
            }
            return false;
        }
        return false;
    }
    // dd(checkArrHasKey($warnings, 'name'));
    // dd(getMessagewithKey($warnings, 'name'));
    // dd($warnings);
@endphp
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-blue rounded">
                        <i class="fe-aperture avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1">$<span data-plugin="counterup">12,145</span></h3>
                        <p class="text-muted mb-1 text-truncate">Income status</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">60%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                         aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-success rounded">
                        <i class="fe-shopping-cart avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1"><span data-plugin="counterup">1576</span></h3>
                        <p class="text-muted mb-1 text-truncate">January's Sales</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">49%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="49" aria-valuemin="0"
                         aria-valuemax="100" style="width: 49%">
                        <span class="sr-only">49% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-warning rounded">
                        <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1">$<span data-plugin="counterup">8947</span></h3>
                        <p class="text-muted mb-1 text-truncate">Payouts</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">18%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="18" aria-valuemin="0"
                         aria-valuemax="100" style="width: 18%">
                        <span class="sr-only">18% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-info rounded">
                        <i class="fe-cpu avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1"><span data-plugin="counterup">178</span></h3>
                        <p class="text-muted mb-1 text-truncate">Available Stores</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">74%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="74" aria-valuemin="0"
                         aria-valuemax="100" style="width: 74%">
                        <span class="sr-only">74% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->
</div>
{{-- end of card --}}


{{-- start of taps --}}
<div class="col-xl-12">
    <div class="card-box">
        <h4 class="header-title mb-4">profile data</h4>

        <ul class="nav nav-pills navtab-bg nav-justified">
            <li class="nav-item">
                <a href="#home1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    basic information
                </a>
            </li>
            <li class="nav-item">
                <a href="#profile1" data-toggle="tab" aria-expanded="false" class="nav-link">
                    images
                </a>
            </li>
            <li class="nav-item">
                <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                    steps
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="home1">
                {{-- profile basic data  --}}
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card-box text-center">
                            <img src="{{$driver->id_number_image?->url ? url('storage/'.$driver->id_number_image?->url) : asset('admin-panel-assets/v1/images/logo-dark.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                                alt="profile-image">

                            <h4 class="mb-0">{{ $driver->name }}</h4>
                            {{-- <p class="text-muted">@webdesigner</p> --}}

                            <div class="text-left mt-3">
                                <h4 class="font-13 text-uppercase">About Me :</h4>
                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ $driver->name }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"> {{ $driver->phone }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $driver->email }}</span></p>

                                <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">{{ $driver->phone_country_code }}</span></p>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col-->
                </div>
            </div>


            <div class="tab-pane" id="profile1">>
                    <div class="row">
                        <div class="gal-box col-sm-6 col-xl-3">
                            <a href="{{$driver->id_number_image?->url ? url('storage/'.$driver->id_number_image?->url) : ''}}" class="image-popup" title="Screenshot-1">
                                <img src="{{$driver->id_number_image?->url ? url('storage/'.$driver->id_number_image?->url) : ''}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                            <div class="gall-info">
                                <h4 class="font-16 mt-0">id number image</h4>
                            </div> <!-- gallery info -->
                        </div> <!-- end gal-box -->
                        <div class="gal-box col-sm-6 col-xl-3">
                            <a href="{{$driver->driver_license?->url ? url('storage/'.$driver->driver_license?->url) : ''}}" class="image-popup" title="Screenshot-1">
                                <img src="{{$driver->driver_license?->url ? url('storage/'.$driver->driver_license?->url) : ''}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                            <div class="gall-info">
                                <h4 class="font-16 mt-0">driver license</h4>
                            </div> <!-- gallery info -->
                        </div> <!-- end gal-box -->
                    </div> <!-- end col -->
                
            </div>
            <div class="tab-pane" id="messages1">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mb-3">Wizard With Progress Bar</h4>

                        <form method="post" action="{{route('drivers.warningDriverByAdmin',$driver->id)}}" id="stepForm">
                            @csrf
                            <div id="progressbarwizard">

                                <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                    <li class="nav-item">
                                        <a href="#step-1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                            <i class="mdi mdi-account-circle mr-1"></i>
                                            <span class="d-none d-sm-inline">step one</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#step-2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-face-profile mr-1"></i>
                                            <span class="d-none d-sm-inline">step two</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#step-3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                            <span class="d-none d-sm-inline">step three</span>
                                        </a>
                                    </li>
                                </ul>
                            
                                <div class="tab-content b-0 mb-0 pt-0">
                            
                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                    </div>
                                        <div class="tab-pane active show" id="step-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="userName1">User name</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="name" @if (checkArrHasKey($warnings, 'name')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagename" name="name"  placeholder="message" value="{{  getMessagewithKey($warnings, 'name') }}" style="display:{{ checkArrHasKey($warnings, 'name') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="phone">phone</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="phone" @if (checkArrHasKey($warnings, 'phone')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagephone" name="phone" c placeholder="message" value="{{ checkArrHasKey($warnings, 'phone') ? getMessagewithKey($warnings, 'phone') : '' }}" style="display:{{ checkArrHasKey($warnings, 'phone') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="id_number">id_number</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="id_number" @if (checkArrHasKey($warnings, 'id_number')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messageid_number" name="id_number"  placeholder="message" value="{{ checkArrHasKey($warnings, 'id_number') ? getMessagewithKey($warnings, 'id_number') : '' }}" style="display:{{ checkArrHasKey($warnings, 'id_number') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="id_number_image">id_number_image</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="id_number_image" onclick="myFunction(this)" @if (checkArrHasKey($warnings, 'id_number_image')) {{ "checked" }} @endif>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messageid_number_image" name="id_number_image"  placeholder="message" style="display:{{ checkArrHasKey($warnings, 'id_number_image') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="nationality">nationality</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="nationality" @if (checkArrHasKey($warnings, 'nationality')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagenationality" name="nationality"  placeholder="message" value="{{ checkArrHasKey($warnings, 'nationality') ? getMessagewithKey($warnings, 'nationality') : '' }}" style="display:{{ checkArrHasKey($warnings, 'nationality') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="profile_image">profile_image</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="profile_image" @if (checkArrHasKey($warnings, 'profile_image')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messageprofile_image" name="profile_image"  placeholder="message" value="{{ checkArrHasKey($warnings, 'profile_image') ? getMessagewithKey($warnings, 'profile_image') : '' }}" style="display:{{ checkArrHasKey($warnings, 'profile_image') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="city">city</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="city" @if (checkArrHasKey($warnings, 'city')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagecity" name="city"  placeholder="message" value="{{ checkArrHasKey($warnings, 'city') ? getMessagewithKey($warnings, 'city') : '' }}" style="display:{{ checkArrHasKey($warnings, 'city') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>



                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>

                                        <div class="tab-pane" id="step-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="vehicle_type">vehicle_type</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="vehicle_type" @if (checkArrHasKey($warnings, 'vehicle_type')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagevehicle_type" name="vehicle_type"  placeholder="message" value="{{ checkArrHasKey($warnings, 'vehicle_type') ? getMessagewithKey($warnings, 'vehicle_type') : '' }}" style="display:{{ checkArrHasKey($warnings, 'vehicle_type') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>


                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="vehicle_brand">vehicle_brand</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="vehicle_brand" @if (checkArrHasKey($warnings, 'vehicle_brand')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagevehicle_brand" name="vehicle_brand"  placeholder="message" value="{{ checkArrHasKey($warnings, 'vehicle_brand') ? getMessagewithKey($warnings, 'vehicle_brand') : '' }}" style="display:{{ checkArrHasKey($warnings, 'vehicle_brand') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="vehicle_plate_number">vehicle_plate_number</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="vehicle_plate_number"  @if (checkArrHasKey($warnings, 'vehicle_plate_number')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagevehicle_plate_number" name="vehicle_plate_number"  placeholder="message" value="{{ checkArrHasKey($warnings, 'vehicle_plate_number') ? getMessagewithKey($warnings, 'vehicle_plate_number') : '' }}" style="display:{{ checkArrHasKey($warnings, 'vehicle_plate_number') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="driver_license">driver_license</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="driver_license" @if (checkArrHasKey($warnings, 'driver_license')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagedriver_license" name="driver_license"  placeholder="message" value="{{ checkArrHasKey($warnings, 'driver_license') ? getMessagewithKey($warnings, 'driver_license') : '' }}" style="display:{{ checkArrHasKey($warnings, 'driver_license') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>

                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>

                                        <div class="tab-pane" id="step-3">
                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="payment_service">payment_service</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="payment_service" @if (checkArrHasKey($warnings, 'payment_service')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagepayment_service" name="payment_service"  placeholder="message" value="{{ checkArrHasKey($warnings, 'payment_service') ? getMessagewithKey($warnings, 'payment_service') : '' }}" style="display:{{ checkArrHasKey($warnings, 'payment_service') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="account_holder_name">account_holder_name</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="account_holder_name" @if (checkArrHasKey($warnings, 'account_holder_name')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messageaccount_holder_name" name="account_holder_name"  placeholder="message" value="{{ checkArrHasKey($warnings, 'account_holder_name') ? getMessagewithKey($warnings, 'account_holder_name') : '' }}" style="display:{{ checkArrHasKey($warnings, 'account_holder_name') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>


                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="iban_number">iban_number</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="iban_number" @if (checkArrHasKey($warnings, 'iban_number')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messageiban_number" name="iban_number"  placeholder="message" value="{{ checkArrHasKey($warnings, 'iban_number') ? getMessagewithKey($warnings, 'iban_number') : '' }}" style="display:{{ checkArrHasKey($warnings, 'iban_number') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="stc_number">stc_number</label>
                                                        <div class="col-md-3" style="margin:auto">
                                                            warning: <input type="checkbox" id="stc_number" @if (checkArrHasKey($warnings, 'stc_number')) {{ "checked" }} @endif onclick="myFunction(this)">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" id="messagestc_number" name="stc_number"  placeholder="message" value="{{ checkArrHasKey($warnings, 'stc_number') ? getMessagewithKey($warnings, 'stc_number') : '' }}" style="display:{{ checkArrHasKey($warnings, 'stc_number') ? 'block' : 'none' }}">
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>

                                        <ul class="list-inline mb-0 wizard">
                                            <li class="previous list-inline-item">
                                                <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                            </li>
                                            <li class="next list-inline-item float-right" id="submitMessageForm">
                                                <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                            </li>
                                        </ul>
                                </div> <!-- tab-content -->
                            </div> <!-- end #progressbarwizard-->
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- end card-box-->
</div> <!-- end col -->
{{-- end of tabs --}}
@endsection
@section('scripts')
<script>
$("#submitMessageForm").click(function(){
//   alert("The paragraph was clicked.");
  var isDisabled = $("#submitMessageForm").hasClass('disabled');
    // alert(isDisabled);
    if (isDisabled) {
        $("#stepForm").submit();
    }
    // var get= document.getElementById('submitMessageForm');
    // if (get.disabled) {
    //     console.log('The element is disabled!');
    // }else{
    //     console.log('The element is not disabled!');
    // }

});
function myFunction(el) {
    // alert(el.id)
  // Get the checkbox
//   var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("message"+el.id);

  // If the checkbox is checked, display the output text
  if (el.checked == true){
    text.style.display = "block";
    text.setAttribute("required", "")
  } else {
    text.style.display = "none";
    text.removeAttribute("required");   
    text.value = "";  
  }
}
</script>
@endsection