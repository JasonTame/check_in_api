<?php

namespace App\Handlers;

use App\Models\User;
use App\Http\Requests\CreateAccountRequest;

class AuthenticationHandler
{
    /**
     * Creates a new user
     *
     * @param CreateAccountRequest $request
     * @return void
     */
    public function createAccount(CreateAccountRequest $request): void
    {
        User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email')
        ]);
    }
}
