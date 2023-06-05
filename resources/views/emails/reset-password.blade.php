

Hi {{ $name }},

There was a request to set your password!

please click this link to change your password: <a href="{{ route("$module.reset-pasword.get",['token' => $token,'email' => $email]) }}">Reset Password</a>
<h1>Forget Password Email</h1>

Thanks,<br>
{{ config('app.name') }}
