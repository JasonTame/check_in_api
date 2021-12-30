<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\json;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('A user can create a check in', function () {
    $this->actingAs($this->user);

    $data = [
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'weekly',
    ];

    $request = json('POST', '/api/checkin/create', $data)
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
