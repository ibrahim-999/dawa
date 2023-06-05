<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminAccessService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminStoreUserRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Requests\Admin\AdminUpdateUserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    private AdminAccessService $accessService;
    private UserService $userService;

    public function __construct(
        AdminAccessService $accessService,
        UserService       $userService,
    )
    {
        $this->accessService = $accessService;
        $this->userService = $userService;

        $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_users', ['only' => ['show']]);
        $this->middleware('permission:update_users', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_users', ['only' => ['index']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $users = $this->userService->search($request)->getCollection()->paginate($itemsPerPage);
        return view('admin/v1/user/index', compact('users'));
    }

    public function create()
    {
        return view('admin/v1/user/create');
    }

    public function store(AdminStoreUserRequest $request)
    {
        $user = $this->userService->addUserByAdmin($request);
        if ($user) {
            return Redirect::route('users.index')->with('success', __('messages.user_created_successfully'));
        } else {
            return Redirect::back();
        }

    }


    public function destroy(User $user)
    {
        $deleted = $this->userService->deleteUser($user);
        if ($deleted) {
            return Redirect::route('users.index')->with('success', __('messages.user_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('users.index')->with('success', __('messages.user_deleted_successfully'));
    }

    public function edit(User $user)
    {
        return view('admin/v1/user/edit', compact('user'));
    }

    public function update(User $user, AdminUpdateUserRequest $request)
    {
        $updated = $this->userService->updateUserByAdmin($request, $user);
        if ($updated) {
            return Redirect::route('users.index')->with('success', __('messages.user_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
