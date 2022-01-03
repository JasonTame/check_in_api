<?php

namespace App\Handlers;

use App\Models\CheckIn;
use App\Http\Requests\StoreCheckInRequest;

class CheckInHandler
{
    /**
     * Creates a new CheckIn
     *
     * @param StoreCheckInRequest $request
     * @return CheckIn
     */
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

    /**
     * Sets the interval for the Reminder associated with the CheckIn
     *
     * @param StoreCheckInRequest $request
     * @param CheckIn $checkIn
     * @return void
     */
    private function setReminderInterval(StoreCheckInRequest $request, CheckIn $checkIn): void
    {
        $interval = $request->input('interval');

        $reminder = $checkIn->reminder;
        $reminder->interval = $interval;
        $reminder->save();
    }
}
