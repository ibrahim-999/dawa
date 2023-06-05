<div id="danger-alert-modal" class="modal fade in" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-checkmark h1 text-white"></i>
                    <h4 class="mt-2 text-white">{{$title}}</h4>
                    <p class="mt-3 text-white">{{$description}}</p>
                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">{{$btnTitle}}</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#danger-alert-modal').modal();
    });
</script>
