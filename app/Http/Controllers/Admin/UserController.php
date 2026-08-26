<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    // 1. Define the Service
    protected UserService $userService;

    // 2. Inject the Service in the Constructor
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
 * Show the users list page
 */

    public function index(): view
    {
        // Get users through the Service
        $users = $this->userService->getAllUsers();
        return view('admin.users.users', compact('users'));
    }

    public function edit(int $id): View
    {
        $user = $this->userService->getUserById($id);
        return view('admin.users.edituser', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $this->userService->updateUser($id, $request->validated());
        return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully!');
    }

    public function create()
    {
        return view('admin.users.addUser');
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('admin.users.index')
        ->with('success', 'User created successfully!');
    }
}
