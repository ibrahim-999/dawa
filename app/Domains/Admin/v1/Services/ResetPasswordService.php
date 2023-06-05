<?php

namespace App\Domains\Admin\v1\Services;

use App\Http\Requests\Admin\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class ResetPasswordService
{

    public function createResetPasswordToken(string $email): string
    {
        try {
            $token = Str::random(60);

             DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]); 

            return $token;
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function getToken(ResetPasswordRequest $request)
    {
        $token = DB::table('password_reset_tokens')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        return $token;
    }

    public function deleteToken(Request $request) : bool
    {
        $deleted = DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return $deleted;
    }

}
