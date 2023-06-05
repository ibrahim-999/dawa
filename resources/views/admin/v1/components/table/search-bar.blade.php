<div class="col-lg-12">
    <!-- Portlet card -->
    <div class="card">
        <div class="card-header text-white" style="background-color: #38414a" >
            <div class="card-widgets">
                {{--                    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>--}}
                <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false"
                   aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                {{--                    <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>--}}
            </div>
            <h5 class="card-title mb-0 text-white "> {{$title}}</h5>
        </div>
        <div id="cardCollpase4" class="collapse show">
            <div class="card-body">

                <form action="{{url()->current()}}">
                    <div class="form-row align-items-center row">
                        {{$inputs}}
                        <div class="col-auto" style="margin-top: 28px;">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-2">{{__('labels.search')}}</button>
                            <a href="{{url()->current()}}" class="btn btn-danger waves-effect waves-light mb-2" style="color: white">{{__('labels.cancel')}}</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div> <!-- end card-->
</div>
