<?php

use App\Handlers\ReminderHandler;
use App\Models\User;
use App\Models\CheckIn;
use Carbon\Carbon;

use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    Carbon::setTestNow('2022-01-01 12:00:00');

    $user = User::factory()
        ->create();
    $this->reminder = CheckIn::factory()
        ->for($user)
        ->create()
        ->reminder;
});

it('can complete a reminder', function () {
    $handler = new ReminderHandler();
    $handler->complete($this->reminder);

    assertDatabaseHas(
        'reminders',
        [
            'id' => $this->reminder->id,
            // The default interval is monthly.
            'checkin_date' => Carbon::now()
                ->addMonths(1)
                ->format('Y-m-d H:i:s')
        ]
    );
});

it('can snooze a reminder for a day', function () {
    $handler = new ReminderHandler();
    $handler->snooze($this->reminder, 'tomorrow');

    assertDatabaseHas(
        'reminders',
        [
            'id' => $this->reminder->id,
            'checkin_date' => Carbon::now()
                ->addDay()
                ->format('Y-m-d H:i:s')
        ]
    );
});

it('can snooze a reminder until the end of the week', function () {
    $handler = new ReminderHandler();
    $handler->snooze($this->reminder, 'end-week');

    assertDatabaseHas(
        'reminders',
        [
            'id' => $this->reminder->id,
            'checkin_date' => Carbon::now()
                ->endOfWeek()
                ->format('Y-m-d H:i:s')
        ]
    );
});

it('can snooze a reminder until the following week', function () {
    $handler = new ReminderHandler();
    $handler->snooze($this->reminder, 'next-week');

    assertDatabaseHas(
        'reminders',
        [
            'id' => $this->reminder->id,
            'checkin_date' => Carbon::now()
                ->addDays(7)
                ->format('Y-m-d H:i:s')
        ]
    );
});

it('can snooze a reminder for a month', function () {
    $handler = new ReminderHandler();
    $handler->snooze($this->reminder, 'next-month');

    assertDatabaseHas(
        'reminders',
        [
            'id' => $this->reminder->id,
            'checkin_date' => Carbon::now()
                ->addMonth()
                ->format('Y-m-d H:i:s')
        ]
    );
});
