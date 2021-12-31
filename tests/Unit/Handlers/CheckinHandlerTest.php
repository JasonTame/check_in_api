<?php

use App\Handlers\CheckInHandler;
use App\Http\Requests\StoreCheckInRequest;
use App\Models\User;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->request = new StoreCheckInRequest([
        'name' => faker()->name,
        'user_id' => $this->user->id,
        'interval' => 'monthly'
    ]);
});

it('can store a check in', function () {
    $handler = new CheckInHandler();
    $handler->store($this->request);

    assertDatabaseHas(
        'check_ins',
        [
            'user_id' => $this->user->id,
            'name' => $this->request->input('name')
        ]
    );
});

it('sets the interval for the associated reminder', function () {
    $handler = new CheckInHandler();
    $handler->store($this->request);

    assertDatabaseHas(
        'reminders',
        ['interval' => $this->request->input('interval')]
    );
});
