<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Handlers\CheckInHandler;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCheckInRequest;

class CheckInController extends Controller
{

    /**
     * Create CheckIn
     * 
     * Creates a new CheckIn
     * 
     * @group CheckIn
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

    public function view(CheckIn $checkIn): JsonResponse
    {


        return response()
            ->json(
                [
                    'checkIn' => $checkIn,
                ]
            );
    }
}
