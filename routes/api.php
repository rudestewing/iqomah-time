<?php

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/today', function(Request $request) {
    $cityId = 1;
    
    $year = now()->year;
    $month = now()->month;
    $date = now()->day;

    $schedules = Schedule::query()
        ->with([
            'time',
            'city',
        ])
        ->where('city_id', $cityId)
        ->where('year', $year)
        ->where('month', $month)
        ->where('date', $date)
        ->orderBy('epoch', 'asc')
        ->get();

    return response()->json([
        'data' => $schedules
    ], 200);
});
