<?php

use App\Models\CheckIn;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;

test('A user can update the details of a CheckIn', function () {
    $user = createAndAuthenticateUser();

    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    $data = [
        'name' => faker()->word,
        'birthday' => faker()->date,
        'notes' => faker()->paragraph
    ];

    $this
        ->actingAs($user)
        ->json("PUT", "/api/checkins/{$checkIn->id}", $data)
        ->assertStatus(Response::HTTP_OK)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->where('name', $data['name'])
                ->where('birthday', $data['birthday'])
                ->where('notes', $data['notes'])
                ->etc()
        );

    assertDatabaseHas(
        'check_ins',
        [
            'name' => $data['name'],
            'birthday' => $data['birthday'],
            'notes' => $data['notes']
        ]
    );
});

test('Only the owner of the CheckIn can update it', function () {
    $user = createAndAuthenticateUser();
    $user2 = createAndAuthenticateUser();

    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    $this
        ->actingAs($user2)
        ->json("PUT", "/api/checkins/{$checkIn->id}")
        ->assertStatus(Response::HTTP_FORBIDDEN);

    $this
        ->actingAs($user)
        ->json("PUT", "/api/checkins/{$checkIn->id}")
        ->assertStatus(Response::HTTP_OK);
});
