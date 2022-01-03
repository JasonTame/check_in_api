<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Handlers\AuthenticationHandler;
use App\Http\Requests\CreateAccountRequest;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    /**
     * Create account
     * 
     * Allows you to add a new user account
     *      
     * @group Authentication
     * @unauthenticated
     * 
     * @bodyParam name string required The name of the user. Example: Nathen Friesen
     * @bodyParam email email required The email address of the user. Example: abel.heller@example.org
     * @bodyParam password string required The user's password. Example: password
     * @bodyParam password_confirmation string required Add the password again as confirmation. Example: password
     * 
     * @param CreateAccountRequest $request
     * @return JsonResponse
     */
    public function createAccount(CreateAccountRequest $request): JsonResponse
    {
        (new AuthenticationHandler)->createAccount($request);

        return response()->json(['message' => "User created successfully"]);
    }

    /**
     * 
     * Login
     * 
     * Authenticate and login
     * 
     * @group Authentication
     * @unauthenticated
     * 
     * @bodyParam email email required The user's email address. Example: abel.heller@example.org
     * @bodyParam password string required The user's password. Example: password
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $attr = $request->validated();

        if (!Auth::attempt($attr)) {
            return response()->json(['message' => "Credentials don't match"], 401);
        }

        return response()->json(
            [
                'token' => $request->user()->createToken('API Token')->plainTextToken,
                'message' => "User logged in successfully"

            ]
        );
    }

    /**
     * Get profile data
     * 
     * Get the user's profile data
     * 
     * @group Authentication
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getProfileData(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json(
            [
                'profile' =>
                [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]
        );
    }

    /**
     * Logout
     * 
     * Revokes the user's API token
     * 
     * @group Authentication
     *      
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked'
        ]);
    }
}
