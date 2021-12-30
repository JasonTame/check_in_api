<?php

namespace App\Observers;

use App\Models\CheckIn;
use App\Models\Reminder;

class CheckInObserver
{
    /**
     * Handle the CheckIn 'created' event
     *
     * @param CheckIn $checkIn
     * @return void
     */
    public function created(CheckIn $checkIn)
    {
        // Create a related reminder with default values
        $reminder = new Reminder([
            'check_in_id' => $checkIn->id
        ]);

        $reminder->save();
        $checkIn->save();
    }
}
