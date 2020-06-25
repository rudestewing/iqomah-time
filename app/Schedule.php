<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];
    
    protected $cast = [
        'data' => 'array'
    ];

    public function city()
    {
        return $this->belongsTo(\App\City::class, 'city_id');
    }

    public function time()
    {
        return $this->belongsTo(\App\Time::class, 'time_id');
    }
}
