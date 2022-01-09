<?php

use Illuminate\Support\Facades\Auth;

use function Pest\Faker\faker;
use function Pest\Laravel\json;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

use Symfony\Component\HttpFoundation\Response;

test('A user can login', function () {
    // Create account
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
        'password' => 'password',
        'password_confirmation'  => 'password'
    ];

    // Create account
    json("POST", "/api/create-account", $data);

    assertFalse(Auth::check());

    // Login
    json(
        "POST",
        "/api/login",
        [
            'email' => $data['email'],
            'password' => $data['password']
        ]
    )->assertStatus(Response::HTTP_OK);

    assertTrue(Auth::check());

    // Login with incorrect password
    json(
        "POST",
        "/api/login",
        [
            'email' => $data['email'],
            'password' => 'incorrect'
        ]
    )->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('A valid email address must be passed with the request', function () {
    // No email address
    $data = [
        'name' => faker()->name,
        'password' => 'password',
    ];

    json(
        "POST",
        "/api/login",
        $data
    )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Invalid email address
    $data = [
        'name' => faker()->name,
        'email' => faker()->word,
        'password' => 'password',
    ];

    json(
        "POST",
        "/api/login",
        $data
    )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('A valid password must be password along with the request', function () {
    // No password
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
    ];

    json(
        "POST",
        "/api/login",
        $data
    )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Invalid password
    $data = [
        'name' => faker()->name,
        'email' => faker()->email,
        'password' => 'pass',
    ];

    json(
        "POST",
        "/api/login",
        $data
    )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
