<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\CheckInHandler;

class CheckInController extends Controller
{
    public function create(Request $request)
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
