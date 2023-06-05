@php
    $id = preg_replace('/[^\p{L}\p{N}\s]/u', '', $name);
@endphp
<div {{ $attributes->merge(['class' => 'form-group mb-3 '.$size]) }}">
<label for="{{'Id-'.ucfirst($id)}}">{{$title}}</label>
<select class="form-control" id="{{'Id-'.ucfirst($id)}}" @if($multiple == 1) multiple @endif name="{{$name}}"
        data-toggle="select2">
    {{$options}}
</select>

<div class="invalid-feedback" style="display: block" id="error-{{$name}}">
    @error($name)
    {{$message}}
    @enderror
    @if ($errors->has('phone.code') && $name = 'phone[code]')
        {{$errors->first('phone.code') }}
    @endif
</div>

</div> <!-- end col -->
