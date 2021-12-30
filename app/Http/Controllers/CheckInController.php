<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->input('name');
        $userId = $request->input('user_id');
        $interval = $request->input('interval');

        $checkIn = new CheckIn([
            'name' => $name,
            'user_id' => $userId
        ]);

        $checkIn->save();

        $reminder = $checkIn->reminder;
        $reminder->interval = $interval;
        $reminder->save();

        return response()->json(['checkIn' => $checkIn, 'message' => 'Check In created']);
    }
}
