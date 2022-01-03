<?php

use App\Handlers\AuthenticationHandler;
use App\Http\Requests\CreateAccountRequest;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;

it('can create a new user', function () {
    $request = new CreateAccountRequest([
        'name' => faker()->name,
        'email' => faker()->email,
        'password' => 'password',
        'password' => 'password'
    ]);

    (new AuthenticationHandler())
        ->createAccount($request);

    assertDatabaseHas(
        'users',
        [
            'name' => $request['name'],
            'email' => $request['email']
        ]
    );
});
