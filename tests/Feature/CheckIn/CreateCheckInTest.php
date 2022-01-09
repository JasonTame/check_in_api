<?php

use Carbon\Carbon;
use App\Models\User;

use function Pest\Faker\faker;
use function Pest\Laravel\json;
use function Pest\Laravel\assertDatabaseHas;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('A user can create a check in', function () {
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'weekly',
    ];

    $request = json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_OK);

    assertDatabaseHas(
        'check_ins',
        [
            'name' => $data['name'],
            'user_id' => $data['user_id']
        ]
    );

    assertDatabaseHas('reminders', [
        'interval' => $data['interval'],
        'check_in_id' => $request['checkIn']['id']
    ]);
});

test('A valid name must be sent with the request', function () {
    // No name
    $data = [
        'user_id' => $this->user->id,
        'interval' => 'weekly',
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Name is too long
    $data = [
        'name' => faker()->paragraph(),
        'user_id' => $this->user->id,
        'interval' => 'weekly',
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('A valid user ID must be sent with the request', function () {
    // No user ID
    $data = [
        'name' => faker()->name,
        'interval' => 'weekly',
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // User with given ID must exist
    $data = [
        'name' => faker()->name,
        'user_id' => 9999,
        'interval' => 'weekly',
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('A valid interval must be sent with the request', function () {
    // No interval sent
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Interval value is not allowed
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'random value',
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('Birthday data must be valid if sent with the request', function () {
    // Birthday as a string
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'weekly',
        'birthday' => 'today'
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Birthday as a valid date
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'weekly',
        'birthday' => Carbon::now()
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_OK);
});

test('Notes data must be valid if sent with the request', function () {
    // Too long
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'weekly',
        'notes' => faker()->paragraph(20)
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    // Valid string
    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'weekly',
        'notes' => faker()->paragraph()
    ];

    json('POST', '/api/checkins/create', $data)
        ->assertStatus(Response::HTTP_OK);
});
