<div {{$attributes}} >
<div class="col-12">
    <div class="custom-control custom-radio">
        <input type="radio"  name="{{$name}}" value="{{$value}}" @if($checked) checked @endif class="custom-control-input" id="{{'Id-'.ucfirst($title)}}">
        <label class="custom-control-label" for="{{'Id-'.ucfirst($title)}}">{{$title}}</label>
    </div>
    @error($name)
    <div class="invalid-feedback" style="display: block">
        {{$message}}
    </div>
    @enderror
</div>
</div>
