<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $user)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->userService = $user;
    }

    public function register(RegisterRequest $request): jsonResponse
    {
        $user = $this->userService->register($request);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): jsonResponse
    {
        $token = $this->userService->login($request);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 60 * 60 * 60
        ], Response::HTTP_OK);     
    }

    public function getUserInfo(User $user): JsonResponse
    {
        try {
            $user = $this->userService->getUser($user->id);
        }  catch (Exception $e) {
            return response()->json([
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        } 
       
        return response()->json($user, Response::HTTP_OK);
    }
}
