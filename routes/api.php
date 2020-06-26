<?php

use App\City;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/today/{city}', function(Request $request, City $city) {
    $cityId = 1;
    
    $year = now()->year;
    $month = now()->month;
    $date = now()->day;

    $schedules = Schedule::query()
        ->with([
            'time',
            'city',
        ])
        ->where('city_id', $city->id)
        ->where('year', $year)
        ->where('month', $month)
        ->where('date', $date)
        ->orderBy('epoch', 'asc')
        ->get();

    return response()->json([
        'data' => $schedules
    ], 200);
});

Route::get('city/{city}', function(City $city) {
    return response()->json([
        'data' => $city
    ]);
});
