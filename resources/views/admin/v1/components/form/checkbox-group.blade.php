<div class="col-md-3 select-group-{{$groupName}}">
    <div class="card-box ribbon-box"
         style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) ">
        <div class="ribbon ribbon-{{$ribbonColorText}} float-right">
            <div class="col-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input select-group-selector" data-group="{{$groupName}}" id="{{'groupSelector-'.ucfirst($groupName)}}">
                    <label class="custom-control-label" for="{{'groupSelector-'.ucfirst($groupName)}}">{{__('labels.'.$groupName)}}</label>
                </div>
            </div>
        </div>
        <div class="ribbon-content">
            {{$options}}
        </div>
    </div>




















































</div>
