<?php

use App\Models\User;
use App\Models\CheckIn;

use function PHPUnit\Framework\assertCount;

it('can have multiple check ins', function () {
    $user = User::factory()->create();

    CheckIn::factory()
        ->count(3)
        ->for($user)
        ->create();

    assertCount(3, $user->checkIns);
});

it('can have multiple reminders', function () {
    $user = User::factory()->create();

    CheckIn::factory()
        ->count(3)
        ->for($user)
        ->create();

    assertCount(3, $user->reminders);
});
