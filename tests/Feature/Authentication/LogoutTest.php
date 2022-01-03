<?php

use App\Models\User;
use function Pest\Faker\faker;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

use Symfony\Component\HttpFoundation\Response;

test('A user can logout', function () {
    $user = User::factory()->create();

    Auth::login($user);
    $user->createToken('API Token')->plainTextToken;
    assertTrue(Auth::check());

    // Logout and remove token
    $this->actingAs($user)
        ->json("POST", "/api/logout")
        ->assertStatus(Response::HTTP_OK);

    assertEmpty($user->tokens);
});
