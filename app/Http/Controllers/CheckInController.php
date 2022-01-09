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

    /**
     * View CheckIn
     * 
     * View the details for a CheckIn
     * 
     * @group CheckIn
     *      
     * @param CheckIn $checkIn The ID of the CheckIn
     * @param Request $request
     * @return JsonResponse
     */
    public function view(CheckIn $checkIn, Request $request): JsonResponse
    {
        if ($request->user()->cannot('view', $checkIn)) {
            return response()->json(
                [
                    'message' => "You are not authorized to perform this action"
                ],
                403
            );
        }

        return response()
            ->json(
                $checkIn
            );
    }
}
