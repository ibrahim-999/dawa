<div {{ $attributes->merge(['class' => 'form-group mb-3 '.$size]) }}">
<label for="{{'Id-'.ucfirst($name)}}">{{$title}}</label>
<div class="input-group">
    @if($prepend)
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">{{$prepend}}</span>
        </div>
    @endif
    <input type="file" class="form-control" id="{{'Id-'.ucfirst($name)}}" name="{{$name}}" aria-describedby="inputGroupPrepend">
    @error($name)
    <div class="invalid-feedback" style="display: block">
        {{$message}}
    </div>
    @enderror


</div>
</div>
@if ($oldImage)
<div class="col-2">
    {{-- <img src="{{ $oldImage }}" class="w-12 h-12" alt="no image"> --}}
    <img src="{{ $oldImage }}" alt="{{ $oldImage }}"
    class="shadow" style="width: inherit">
</div>
@endif