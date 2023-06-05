    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">

                        {{$left_actions}}
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            {{$right_actions}}

                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table id="demo-foo-accordion" class="table table-colored mb-0 toggle-arrow-tiny" id="products-datatable">
                        <thead>
                        <tr>
                            {{$headers}}
                        </tr>
                        </thead>
                        <tbody>

                        {{$rows}}

                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
