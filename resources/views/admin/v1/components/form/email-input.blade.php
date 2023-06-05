<div {{ $attributes->merge(['class' => 'form-group mb-3 '.$size]) }}">
<label for="{{'Id-'.ucfirst($name)}}">{{$title}}</label>
<div class="input-group">
    @if($prepend)
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">{{$prepend}}</span>
        </div>
    @endif
    <input type="email" value="{{$value}}" class="form-control" id="{{'Id-'.ucfirst($name)}}" name="{{$name}}"
           placeholder="{{$placeholder}}" aria-describedby="inputGroupPrepend">
    @error($name)
    <div class="invalid-feedback" style="display: block">
        {{$message}}
    </div>
    @enderror


</div>
</div>
