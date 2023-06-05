<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminService;
use App\Domains\Admin\v1\Services\ResetPasswordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;

class AdminForgotPasswordController extends Controller
{

    private ResetPasswordService $resetPasswordService;
    private AdminService $adminService;


    public function __construct(
        ResetPasswordService $resetPasswordService,
        AdminService       $adminService,
    )
    {
        $this->resetPasswordService = $resetPasswordService;
        $this->adminService = $adminService;
    }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token,$email) { 
         return view('admin/v1/admin/auth/reset-password', ['token' => $token, 'email' => $email, 'module' => 'admin']);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(ResetPasswordRequest $request)
      {
          $token = $this->resetPasswordService->getToken($request);
  
          if(!$token){
              return back()->withErrors(['password' => 'Invalid token!']);
          }
  
            $admin = $this->adminService->getAdminByEmail($request->email);

            if(!$admin){
                return back()->withErrors(['password' => 'Invalid email!']);
            }

            $updated = $this->adminService->resetPassword($request, $admin);

            if ($updated) {
                $this->resetPasswordService->deleteToken($request); 
                return Redirect::route('admin.login.view');
            } else {
                return back()->withErrors(['password' => 'update password faild']);
            }
        }
}
