<?php

namespace App\Domains\Shared\v1\Services\Auth;

use App\Domains\Shared\v1\Contracts\Services\AccessSecurityServiceContract;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AccessSecurityService implements AccessSecurityServiceContract
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
    protected $decayMinutes = 1;

    public function ThrottlesCheck(Request $request): ?bool
    {
        try {

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return true;
            }
            return false;
        } catch (\Throwable $exception) {
            //TODO:Custom Exception with logger and api message
            return $exception->getMessage();
        }
    }

    public function IncrementAttempts(Request $request): ?bool
    {
        try {
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if (method_exists($this, 'incrementLoginAttempts')) {
                $this->incrementLoginAttempts($request, '');
                return true;
            }
            return false;
        } catch (\Throwable $exception) {
            //TODO:Custom Exception with logger and api message
            return $exception->getMessage();
        }

    }
}
