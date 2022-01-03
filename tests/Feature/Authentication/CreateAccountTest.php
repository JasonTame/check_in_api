<?php

use App\Models\User;
use function Pest\Faker\faker;
use function Pest\Laravel\json;

use function Pest\Laravel\assertDatabaseHas;
use Symfony\Component\HttpFoundation\Response;

test('A user can create a new account', function () {
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];

    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_OK);

    assertDatabaseHas(
        'users',
        [
            'name' => $data['name'],
            'email' => $data['email']
        ]
    );
});

test('A valid name must be sent with the request', function () {
    // No name
    $data = [
        'email' => faker()->email,
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Name is too long
    $data = [
        'name' => faker()->paragraph(12),
        'email' => faker()->email,
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('A valid email address must be sent with the request', function () {
    // No email
    $data = [
        'name' => faker()->name,
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Invalid email address
    $data = [
        'name' => faker()->name,
        'email' => faker()->word,
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];

    // Non-unique email address
    User::factory()->create(['email' => 'test@test.com']);

    $data = [
        'name' => faker()->name,
        'email' => 'test@test.com',
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('A valid password must be sent with the request', function () {
    // No password
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
        'password_confirmation'  => 'password'
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Unconfirmed password
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
        'password' => 'password',
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Password too short
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
        'password' => 'pass',
        'password_confirmation'  => 'pass'
    ];
    json("POST", "/api/create-account", $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
