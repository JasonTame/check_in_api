<?php

use App\Models\User;
use App\Models\CheckIn;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEquals;

it('cannot be created without a CheckIn', function () {
    $this->expectException(QueryException::class);

    $reminder = new Reminder();
    $reminder->save();
})->throws(QueryException::class);

it('can be created with a related CheckIn', function () {
    $checkIn = CheckIn::factory()
        ->for(User::factory())
        ->create();

    $reminder = new Reminder([
        'check_in_id' => $checkIn->id
    ]);

    $reminder->save();

    assertDatabaseHas(
        'reminders',
        [
            'id' => $reminder->id,
            'check_in_id' => $checkIn->id,
            'interval' => 'monthly'
        ]
    );
    assertEquals($checkIn->id, $reminder->checkIn->id);
});

it('creates a checkin date based on the chosen interval', function () {
    Carbon::setTestNow("2022-01-01 12:00:00");

    $checkIn = CheckIn::factory()
        ->for(User::factory())
        ->create();

    $reminder = new Reminder([
        'check_in_id' => $checkIn->id
    ]);

    $reminder->save();

    assertEquals(Carbon::now()->addMonth(), $reminder->checkin_date);
});
