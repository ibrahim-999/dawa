@foreach(config('translatable.locales') as $local)
    <div class="col-md-6">
        <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[description]')}}"
                                         length="500"
                                         rows="4" size="col-md-12"
                                         value="{{$notification->translate($local)->description}}"
                                         name="{{$local}}[description]"
                                         title="{{__('labels.description',['local'=>$local])}}"
                                         placeholder="{{__('placeholders.description')}}"/>
    </div>
@endforeach
