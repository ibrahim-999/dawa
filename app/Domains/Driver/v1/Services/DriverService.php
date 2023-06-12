<?php

namespace App\Domains\Driver\v1\Services;

use App\Domains\Driver\v1\Enums\DriverProfileStep;
use App\Domains\Driver\v1\Enums\DriverStatusEnum;
use App\Domains\Shared\v1\Services\Auth\OtpAccessService;
use App\Domains\Shared\v1\Traits\UploadFilesTrait;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Propaganistas\LaravelPhone\PhoneNumber;

class DriverService
{
    use UploadFilesTrait;
    private Driver $driverModel;
    private OtpAccessService $otpAccessService;

    public function __construct(Driver $driverModel, OtpAccessService   $otpAccessService)
    {
        $this->driverModel = $driverModel;
        $this->otpAccessService = $otpAccessService;
    }

    public function getDriverByPhone($phone): ?Model
    {
        try {
            $driver = $this->driverModel->where('phone', $phone)->first();
            return $driver;
        } catch (\Throwable $exception) {
            throw $exception;

        }

    }

    public function getAuthDriver(string $guard): ?Model
    {
        try {
            return auth($guard)->user();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function registerDriver($request): ?Model
    {
        try {
            return $this->driverModel->create(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name ?? null,
                    'password' => Hash::make($request->password),
//                    'status' => DriverStatusEnum::PENDING,
                ]
            );
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function passwordReset(Driver $driver, $password): ?Model
    {
        try {
            $driver->update(
                [
                    'password' => Hash::make($password),
                ]
            );
           return $driver->fresh();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function getRequestPhone($request): ?string
    {
        try {

            if (is_array($request->phone)) {
                return phone($request->phone['number'], $request->phone['code'])->formatE164();
            }

            return phone($request->phone_number, $request->phone_code)->formatE164();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    /**
     * complete profile step one.
     */
    public function completeProfileStepOne(Driver $driver, $request): ?bool
    {
        try {
            if ($request->otp) {
                $isVerified = $this->otpAccessService->verifyOtpAttempt($this->getRequestPhone($request), $request->otp, $request);
                if (!$isVerified) {
                    throw ValidationException::withMessages([
                        'otp' => __('auth.wrong_otp')
                    ]);
                }
            }
            $driverUpdated = DB::transaction(function()use($request,$driver){

                $this->uploadFile($request->id_number_image, $driver, 'id_number_image', 'driver');

                $this->uploadFile($request->profile_image, $driver, 'profile', 'driver');

                return $driver->update(
                    [
                        'phone' => $this->getRequestPhone($request),
                        'name' => $request->name,
                        'id_number' => $request->id_number,
                        'nationality' => $request->nationality,
                        'city_id' => $request->city_id,
                    ]
                );
            });

            return $driverUpdated;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * complete profile step two.
     */
    public function completeProfileStepTwo(Driver $driver, $request): ?bool
    {
        try {
            $driverUpdated = DB::transaction(function()use($request,$driver){

                $this->uploadFile($request->driver_license, $driver, 'driver_license', 'driver');

                return $driver->update(
                    [
                        'vehicle_type' => $request->vehicle_type,
                        'vehicle_brand' => $request->vehicle_brand,
                        'vehicle_plate_number' => $request->vehicle_plate_number,
                        'step'  => $driver->step > DriverProfileStep::STEP_ONE->value ? $driver->step : DriverProfileStep::STEP_TWO->value ,
                    ]
                );
            });
            return $driverUpdated;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * complete profile step three.
     */
    public function completeProfileStepThree(Driver $driver, $request): ?bool
    {
        try {
            $data = $request->validated();
            $data['step'] = $driver->step > DriverProfileStep::STEP_TWO->value  ? $driver->step : DriverProfileStep::STEP_THREE->value ;

            //for test
                $comment = $driver->comments()->create([
                    'en' => [
                        'title' => 'your request is rejected',
                        'body' => 'your request is rejected',
                    ],
                    'ar' => [
                        'title' => ' ar your request is rejected',
                        'body' => 'ar  your request is rejected',
                    ],
                    'type' => 'danger',
                    'reason' => 'joining_as_driver',
                ]);
                $comment->profileComments()->create([
                        'input' => 'name',
                        'en' => [
                            'message' => 'error in your name'
                        ],
                        'ar' => [
                            'message' => ' ar error in your name'
                        ]
                ]);
                $data['has_message'] = 1;
            //end of test
            return $driver->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * get uthenticated driver.
     */
    public function getAuthUser(string $guard): ?Model
    {
        try {
            return auth($guard)->user();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function getCollection(): ?Model
    {
        try {
            return $this->driverModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function search(Request $request): ?DriverService
    {
        try {
            $this->driverModel->when($request->email,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('email', "%{$request->email}%");
                });
            });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function index(): Collection
    {
        try {
            return $this->driverModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->driverModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function updateDriverByAdmin(Request $request, $user): ?bool
    {
        try {
            $data = $request->except(['password','is_active']);
            $data['phone'] = $this->getRequestPhone($request);
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $data['is_active'] =  ($request->is_active && ($request->is_active ==1)) ? 1 : 0;
            return $user->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function deleteDriver(Driver $driver): ?bool
    {
        try {
            return $driver->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function addDriverByAdmin($request): ?Model
    {
        try {
            return $this->driverModel->create(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name ?? null,
                    'email' => $request->email ?? null,
                    'password' => Hash::make($request->password),
                    'is_active' => $request->is_active ? 1 : 0,
                    'status' => $request->status,
                ]
            );
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function updateDriverAvailability(Driver $driver, $request): ?Model
    {
        try {
            $driver->setting()->updateOrCreate([],
                [
                    'is_available' => $request->is_available,
                ]
            );
           return $driver->fresh();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
