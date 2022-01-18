<?php

use App\Models\User;
use App\Models\CheckIn;

it('can complete a reminder', function () {
    $user = User::factory()
        ->create();
    $checkIn = CheckIn::factory()
        ->for($user)
        ->create();

    
});
