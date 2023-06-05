<div {{ $attributes->merge(['class' => 'form-group mb-3 '.$size]) }}">
<label for="{{'Id-'.ucfirst($name)}}">{{$title}}</label>
<div class="input-group">
    <input type="number" value="{{$value}}" min="{{$min}}" max="{{$max}}" step="{{$step}}" class="form-control" id="{{'Id-'.ucfirst($name)}}" name="{{$name}}"
           placeholder="{{$placeholder}}" aria-describedby="inputGroupPrepend"  >

    <div class="invalid-feedback  " style="display: block" >
        <span class="@if(empty($errorName))errorMsg-{{str_replace('.', '_', $name)}} @else errorMsg-{{str_replace('.', '_', $errorName)}} @endif"></span>
        @error(empty($errorName) ? $name :$errorName)
        {{$message}}
        @enderror
    </div>




</div>
</div>
