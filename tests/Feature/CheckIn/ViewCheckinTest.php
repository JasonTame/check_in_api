<?php

use App\Models\CheckIn;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;

test('Only the owner of the CheckIn can view it', function () {
    $user = createAndAuthenticateUser();
    $user2 = createAndAuthenticateUser();

    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    $this->actingAs($user2)
        ->json("GET", "/api/checkin/view/$checkIn->id")
        ->assertStatus(Response::HTTP_FORBIDDEN);

    $this->actingAs($user)
        ->json("GET", "/api/checkin/view/$checkIn->id")
        ->assertStatus(Response::HTTP_OK);
});

test('A user can view the details of a CheckIn', function () {
    $user = createAndAuthenticateUser();

    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    $this->actingAs($user)
        ->json("GET", "/api/checkin/view/$checkIn->id")
        ->assertStatus(Response::HTTP_OK)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->where('name', $checkIn->name)
                ->where('user_id', $checkIn->user_id)
                ->etc()
        );
});
