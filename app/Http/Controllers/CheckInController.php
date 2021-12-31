<?php

namespace App\Http\Controllers;

use App\Handlers\CheckInHandler;
use App\Http\Requests\StoreCheckInRequest;

class CheckInController extends Controller
{
    public function create(StoreCheckInRequest $request)
    {
        $checkIn = (new CheckInHandler)
            ->store($request);

        return response()
            ->json(
                [
                    'checkIn' => $checkIn,
                    'message' => 'Check In created'
                ]
            );
    }
}
