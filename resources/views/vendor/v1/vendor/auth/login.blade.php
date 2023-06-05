<x-login-page-pro pageTitle="{{__('pages_title.admin_login')}}" baseUrl="{{route('vendor.dashboard')}}"
                   logo="{{asset('admin-panel-assets/v1/images/logo-dark.png')}}" url="{{route('vendor.login.post')}}">
    <x-slot name="page_description">{{__('admin_text.login_page_lite')}}</x-slot>
    <x-slot name="inputs">
        <x-admin.v1.form.email-input value="{{old('email')}}" prepend="" size="" name="email" title="{{__('labels.email')}}"
                                     placeholder="{{__('placeholders.email')}}"/>
        <x-admin.v1.form.password-input prepend="" size="" name="password" title="{{__('labels.password')}}"
                                        placeholder="{{__('placeholders.password')}}"/>
        <x-admin.v1.form.checkbox-input  class="form-group row mb-3 justify-content-end " checked="1" value="1" name="remember_me" title="{{__('labels.remember_me')}}"/>
    </x-slot>
    <x-slot name="buttons">
        <x-admin.v1.buttons.regular-btn class="form-group mb-0 text-center" btnType="btn-primary btn-block" type="submit" title="{{__('labels.login_btn')}}"/>
    </x-slot>
</x-login-page-pro>
