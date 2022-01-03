<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\json;


test('Profile data for a user can be retrieved', function () {
    $user = User::factory()->create();
    $token  = $user->createToken('API Token')->plainTextToken;

    json("GET", "/api/profile", [], ["Authorization" => "Bearer $token"])
        ->assertStatus(Response::HTTP_OK)
        ->assertJson(
            [
                "profile" => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]
        );
});
