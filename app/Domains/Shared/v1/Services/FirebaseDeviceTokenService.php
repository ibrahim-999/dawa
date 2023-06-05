<?php

namespace App\Domains\Shared\v1\Services;

use App\Models\Contact;
use App\Models\FirebaseDeviceToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FirebaseDeviceTokenService 
{
    private Model|Builder $firebaseDeviceTokenModel;

    public function __construct()
    {
        $this->firebaseDeviceTokenModel = new FirebaseDeviceToken();
    }

    public function add(Request $request): ?Model
    {
        try {
            $user = getAuthUser();

            $token = $this->firebaseDeviceTokenModel->updateOrCreate(['device_id' => $request->device_id],[
                'device_token' => $request->device_token,
                'device_type' => $request->device_type,
                'notifiable_id' => $user ? $user->id : null,
                'notifiable_type' => $user ? get_class($user) : null,
            ]);
            
            return $token;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getRequestPhone($request): ?string
    {
        try {
            return phone($request->phone['number'], $request->phone['code'])->formatE164();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function assignDeviceTokenToUser(Request $request,$user): ?bool
    {
        try {
            $fcmToken = $request->header('X-FcmToken');

            $token = $this->firebaseDeviceTokenModel->where('device_token',$fcmToken)
            ->update([
                'notifiable_id' => $user ? $user->id : null,
                'notifiable_type' => $user ? get_class($user) : null,
            ]);
            
            return $token;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function addAdminTokenWithoutDeviceId(Request $request): ?Model
    {
        try {
            
            $user = auth('web-admin')->user();

            // $token = $this->firebaseDeviceTokenModel->updateOrCreate(['notifiable_id' => $user->id, 'notifiable_type' => get_class($user)],[
            $token = $this->firebaseDeviceTokenModel->updateOrCreate(['device_token' => $request->device_token],[
                'device_token' => $request->device_token,
                'device_type' => $request->device_type,
                'notifiable_id' => $user ? $user->id : null,
                'notifiable_type' => $user ? get_class($user) : null,
            ]);
            
            return $token;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function addVendorTokenWithoutDeviceId(Request $request): ?Model
    {
        try {
            
            $user = auth('web-vendor')->user();

            // $token = $this->firebaseDeviceTokenModel->updateOrCreate(['notifiable_id' => $user->id, 'notifiable_type' => get_class($user)],[
            $token = $this->firebaseDeviceTokenModel->updateOrCreate(['device_token' => $request->device_token],[
                'device_token' => $request->device_token,
                'device_type' => $request->device_type,
                'notifiable_id' => $user ? $user->id : null,
                'notifiable_type' => $user ? get_class($user) : null,
            ]);
            
            return $token;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}