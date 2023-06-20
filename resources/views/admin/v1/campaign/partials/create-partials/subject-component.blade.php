@foreach(config('translatable.locales') as $local)
    <div class="col-md-6 subject_dev"
         @if(old('type')!='email')
             style="display: none;"
        @endif >

        <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[subject]')}}"
                                         length="500"
                                         rows="4" size="col-md-12"
                                         name="{{$local}}[subject]"
                                         title="{{__('labels.subject',['local'=>$local])}}"
                                         placeholder="{{__('placeholders.subject')}}"/>
    </div>
@endforeach
