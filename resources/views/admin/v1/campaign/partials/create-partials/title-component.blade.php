@foreach(config('translatable.locales') as $local)
    <div class="col-md-6">
        <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend=""
                                    value="{{old($local.'[title]')}}" size="col-md-12"
                                    name="{{$local}}[title]"
                                    title="{{__('labels.title',['local'=>$local])}}"
                                    placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
    </div>
@endforeach
