<div class="card-box">

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">

                        <h4 class="header-title">Images</h4>

                        <div class="row">
                            @foreach ($variant->sub_images as $image)
                                <div class="col-sm-3">
                                    <img src="{{ $image->original_url }}" alt="image"
                                            class="img-fluid"/>
                                </div>
                            @endforeach
                        </div>

                </div> <!-- end row -->

            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>


</div>