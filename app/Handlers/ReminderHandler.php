<?php

namespace App\Handlers;

use App\Models\Reminder;
use Carbon\Carbon;

class ReminderHandler
{
    public function complete(Reminder $reminder): Reminder
    {
        $intervalDate = $this->getNewCheckInDate($reminder->interval, $reminder->checkin_date);

        $reminder->checkin_date = $intervalDate->format('Y-m-d H:i:s');
        $reminder->save();

        return $reminder;
    }

    public function snooze(Reminder $reminder, String $snoozeUntil): Reminder
    {
        $current = Carbon::now();

        switch ($snoozeUntil) {
            case 'tomorrow':
                $checkinDate =  $current->addDay();
                break;
            case 'end-week':
                $checkinDate =  $current->endOfWeek();
                break;
            case 'next-week':
                $checkinDate =  $current->addDays(7);
                break;
            case 'next-month':
                $checkinDate =  $current->addMonth();
                break;
            default:
                $checkinDate =  $current->addDay();
                break;
        }

        $reminder->checkin_date = $checkinDate->format('Y-m-d H:i:s');
        $reminder->save();

        return $reminder;
    }

    private function getNewCheckInDate(String $interval): Carbon
    {
        $current = Carbon::now();

        switch ($interval) {
            case 'weekly':
                return $current->addWeek();
            case 'bi-weekly':
                return $current->addWeeks(2);
            case 'monthly':
                return $current->addMonth();
            case 'semi-annually':
                return $current->addMonths(6);
            case 'annually':
                return $current->addYear();
            default:
                return $current->addWeek();
        }
    }
}
