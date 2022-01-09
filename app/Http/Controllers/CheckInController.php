<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Handlers\CheckInHandler;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCheckInRequest;
use App\Http\Requests\UpdateCheckInRequest;

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
     * View all CheckIns
     * 
     * Returns a list of all CheckIns that belong to the user
     * 
     * @group CheckIn
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $checkIns = $request->user()->checkIns;

        return response()
            ->json(
                $checkIns
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

    /**
     * Update a Check In
     * 
     * Update the details of a CheckIn belonging to the authenticated user
     * 
     * @group CheckIn
     *
     * @param CheckIn $checkIn
     * @param UpdateCheckInRequest $request
     * @return JsonResponse
     */
    public function update(CheckIn $checkIn, UpdateCheckInRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $checkIn->update($validated);

        return response()
            ->json(
                $checkIn
            );
    }

    /**
     * Delete CheckIn
     * 
     * Deletes a CheckIn belonging to the user
     * 
     * @group CheckIn
     *
     * @param CheckIn $checkIn
     * @param Request $request
     * @return void
     */
    public function delete(CheckIn $checkIn, Request $request)
    {
        if ($request->user()->cannot('delete', $checkIn)) {
            return response()->json(
                [
                    'message' => "You are not authorized to perform this action"
                ],
                403
            );
        }

        $checkIn->delete();

        return response()
            ->json(
                ['message' => 'CheckIn deleted']
            );
    }
}
