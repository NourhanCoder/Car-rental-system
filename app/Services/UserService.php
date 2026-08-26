<?php

namespace App\Services;

use App\Models\User;
use App\Services\ImageUploadService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;


class UserService
{
    protected ImageUploadService $imageUploadService;

    // Inject the ImageUploadService in the Constructor
    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function getAllUsers(): Collection
    {
        return User::latest()->get();
    }

    public function getUserById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function updateUser(int $id, array $data): User
    {
        $user = $this->getUserById($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->uploadImage(
                $data['image'],
                'users',
                $user->image
            );
        } else {
            unset($data['image']);
        }

        $user->update($data);
        return $user;
    }


    public function createUser(array $data): User
    {
        if (isset($data['role'])) {
            $data['is_admin'] = ($data['role'] === 'admin') ? 1 : 0;
            unset($data['role']); 
        }
        
        $data['password'] = Hash::make($data['password']);

        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->uploadImage($data['image'], 'users');
        }

        return User::create($data);
    }
}
