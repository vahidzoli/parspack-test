<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function register($request)
    {
        return $this->userModel->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function login($request)
    {
        $token = auth()->attempt($request->all());

        return $token;
    }

    public function getUserById($id)
    {
        return $this->userModel->findOrFail($id);
    }
}