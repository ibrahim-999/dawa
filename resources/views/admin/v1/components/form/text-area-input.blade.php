<div {{ $attributes->merge(['class' => 'form-group mb-3 '.$size]) }}">
<label for="{{'Id-'.ucfirst($name)}}">{{$title}}</label>
<div class="input-group">
    @if($prepend)
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">{{$prepend}}</span>
        </div>
    @endif
    <textarea id="{{'Id-'.ucfirst($name)}}" class="form-control {{$name}}" id="{{'Id-'.ucfirst($name)}}" name="{{$name}}" maxlength="{{$length}}" rows="{{$rows}}" placeholder="{{$placeholder}}">{{$value}}</textarea>
    @error($name)
    <div class="invalid-feedback" style="display: block">
        {{$message}}
    </div>
    @enderror



</div>
</div>
