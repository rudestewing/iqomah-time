<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $guarded = [];
    
    public function schedules()
    {
        return $this->hasMany(\App\Schedule::class, 'time_id');
    }
}
