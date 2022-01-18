<?php

namespace App\Handlers;

use App\Models\CheckIn;
use App\Models\Reminder;
use Carbon\Carbon;

class ReminderHandler
{
    public function complete(CheckIn $checkIn): Reminder
    {
        $reminder = $checkIn->reminder;
        $reminder->checkin_date = Carbon::now();
    }

    public function snooze()
    {
    }

    private function getIntervalDate(String $interval): Carbon
    {
    }
}
