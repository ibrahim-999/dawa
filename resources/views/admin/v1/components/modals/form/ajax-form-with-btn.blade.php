    <!--modal content -->
<div id="modal-{{$id}}" {{ $attributes->merge(['class' => 'modal fade '.$classes]) }} tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="{{asset('admin-panel-assets/v1')}}/images/logo-dark.png" alt="" height="80"></span>
                    </a>
                </div>

                <form class="px-3" id="form-{{$id}}" enctype="@if($fileable == "true") multipart/form-data  @else application/x-www-form-urlencoded @endif">

                    @csrf
                    {{$inputs}}


                </form>
                <div class="form-group text-center">
                    {{$actionBtns}}
                    <div {{$attributes}}>
                        <button class="btn btn-outline-primary" onclick="$('#form-{{$id}}').submit()">{{__('labels.save')}}</button>
                    </div>

                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('custom-scripts')
    <script>
        var form_elements=$('#form-{{$id}}');

        form_elements.on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var data = $(this).serialize();
            $.ajax({
                type: "{{$method}}",
                url: "{{$url}}",
                data: data,
                success: function( data ) {
                    var message=data.message;
                    $('#modal-{{$id}}').modal('toggle');
                    $('#ajax_success-alert-modal-message').text(message);
                    $('#ajax_success-alert-modal').modal();
                    setTimeout(function () {
                        location.reload(true);
                    }, 2000);
                },
                error :  function(data)
                {
                    if (data.status == 422) { // when status code is 422, it's a validation issue
                        var data=data.responseJSON;
                        var errors=data.errors;
                        $.each(errors, function (key, val) {
                            $(".errorMsg-"+key.replace(".", "_")).html(val);
                            // console.log('#errorMsg-'+key,val[0]);
                        });
                    }
                }
            });
        });
    </script>
@endpush
