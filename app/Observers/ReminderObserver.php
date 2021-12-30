<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\Reminder;

class ReminderObserver
{
    /**
     * Handle the Reminder 'created' event
     *
     * @param Reminder $reminder
     * @return void
     */
    public function created(Reminder $reminder)
    {
        // Set the initial checkin date
        $checkInDate = Carbon::now()->addMonth();
        $reminder->checkin_date = $checkInDate;

        $reminder->save();
    }
}
