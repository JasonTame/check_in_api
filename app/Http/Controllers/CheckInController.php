<?php

namespace App\Http\Controllers;

use App\Handlers\CheckInHandler;
use App\Http\Requests\StoreCheckInRequest;
use Illuminate\Http\JsonResponse;

class CheckInController extends Controller
{

    /**
     * Create CheckIn
     * 
     * Creates a new CheckIn
     *
     * @param StoreCheckInRequest $request
     * @return JsonResponse
     */
    public function create(StoreCheckInRequest $request): JsonResponse
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
