<div {{ $attributes->merge(['class' => 'form-group mb-3 '.$size]) }}">
    <label for="validationCustomUsername">{{$title}}</label>
    <div class="input-group">
        @if($prepend)
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">{{$prepend}}</span>
            </div>
        @endif
        <input type="password" class="form-control" id="{{'Id-'.ucfirst($name)}}" name="{{$name}}" placeholder="{{$placeholder}}" aria-describedby="inputGroupPrepend"  >
            <div class="input-group-append" data-password="false">
                <div class="input-group-text">
                    <span class="password-eye"></span>
                </div>
            </div>

            @error($name)
            <div class="invalid-feedback" style="display: block">
                {{$message}}
            </div>
            @enderror



    </div>
</div>

