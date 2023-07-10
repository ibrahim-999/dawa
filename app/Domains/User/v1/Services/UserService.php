<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Shared\v1\Traits\UploadFilesTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    private Model $userModel;
    use UploadFilesTrait;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function getUserByPhone($phone): ?Model
    {
        try {
            $user = $this->userModel->where('phone', $phone)->first();
            return $user;
        } catch (\Throwable $exception) {
            throw $exception;

        }

    }

    public function getAuthUser(string $guard): ?Model
    {
        try {
            return auth($guard)->user();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function addUser($request): ?Model
    {
        try {
            return $this->userModel->create(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name ?? null,
                    'email' => $request->email ?? null,
                ]
            );
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
     * update profile.
     */
    public function updateProfile(User $user, $request): ?bool
    {
        try {

            return $user->update(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name,
                    'email' => $request->email
                ]
            );

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * update profile.
     */
    public function updateProfileImage(User $user, $request): ?bool
    {
        try {
            $user->clearMediaCollection('images');
            $image = $user->addMediaFromRequest('image')->withCustomProperties(['type' => 'profile'])->toMediaCollection('images');
            return (bool) $image;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * deactivate Accont profile.
     */
    public function deactivateAccount(User $user): ?bool
    {
        try {

            return $user->update(['is_active' => false]);

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getCollection(): ?Model
    {
        try {
            return $this->userModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function search(Request $request): ?UserService
    {
        try {
            $this->userModel->when($request->email,function ($q) use ($request){
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
            return $this->userModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->userModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function updateUserByAdmin(Request $request, $user): ?bool
    {
        try {
            $data = $request->except(['password','is_active']);
            $data['phone'] = $this->getRequestPhone($request);
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $data['is_active'] =  $request->is_active ? 1 : 0;

            return $user->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function deleteUser(User $user): ?bool
    {
        try {
            return $user->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function addUserByAdmin($request): ?Model
    {
        try {
            return $this->userModel->create(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name ?? null,
                    'email' => $request->email ?? null,
                    'password' => Hash::make($request->password),
                    'is_active' => $request->is_active ? 1 : 0,
                ]
            );
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
