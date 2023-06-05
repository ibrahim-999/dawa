<x-login-page-lite pageTitle="{{__('pages_title.reset_pasword')}}" baseUrl="{{route('dashboard')}}"
                   logo="{{asset('admin-panel-assets/v1/images/logo-dark.png')}}" url='{{route("$module.reset-pasword.post")}}'>
    <x-slot name="page_description">{{__('admin_text.reset_pasword_page_lite')}}</x-slot>
    <x-slot name="inputs">
        <x-admin.v1.form.hidden-input value="{{$email}}" name="email"/>
        <x-admin.v1.form.hidden-input value="{{$token}}" name="token"/>
        <x-admin.v1.form.password-input prepend="" size="" name="password" title="{{__('labels.password')}}"
                                        placeholder="{{__('placeholders.password')}}"/>
        <x-admin.v1.form.password-input prepend="" size="" name="password_confirmation"
        title="{{__('labels.password_confirmation')}}"
        placeholder="{{__('placeholders.password_confirmation')}}"/>
    </x-slot>
    <x-slot name="buttons">
        <x-admin.v1.buttons.regular-btn class="form-group mb-0 text-center" btnType="btn-primary btn-block" type="submit" title="{{__('labels.login_btn')}}"/>
    </x-slot>
</x-login-page-lite>
