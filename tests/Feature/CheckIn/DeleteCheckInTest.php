<?php

use App\Models\CheckIn;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('A user can delete a CheckIn', function () {
    $user = createAndAuthenticateUser();

    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    $this
        ->actingAs($user)
        ->json("DELETE", "/api/checkins/{$checkIn->id}")
        ->assertStatus(Response::HTTP_OK);

    assertDatabaseMissing('check_ins', ['id' => $checkIn->id]);
});

test('Only the owner of a CheckIn can delete it', function () {
    $user = createAndAuthenticateUser();
    $user2 = createAndAuthenticateUser();

    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    $this
        ->actingAs($user2)
        ->json("DELETE", "/api/checkins/{$checkIn->id}")
        ->assertStatus(Response::HTTP_FORBIDDEN);

    $this
        ->actingAs($user)
        ->json("DELETE", "/api/checkins/{$checkIn->id}")
        ->assertStatus(Response::HTTP_OK);
});
