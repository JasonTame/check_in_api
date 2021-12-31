<?php

namespace App\Handlers;

use App\Models\CheckIn;
use App\Http\Requests\StoreCheckInRequest;

class CheckInHandler
{
    public function store(StoreCheckInRequest $request): CheckIn
    {
        $name = $request->input('name');
        $userId = $request->input('user_id');

        $checkIn = new CheckIn([
            'name' => $name,
            'user_id' => $userId
        ]);

        $checkIn->save();

        $this->setReminderInterval($request, $checkIn);

        return $checkIn;
    }

    private function setReminderInterval(StoreCheckInRequest $request, CheckIn $checkIn): void
    {
        $interval = $request->input('interval');

        $reminder = $checkIn->reminder;
        $reminder->interval = $interval;
        $reminder->save();
    }
}
