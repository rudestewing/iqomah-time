<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SettingBackground;
use App\SettingSpare;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settingSpare = SettingSpare::first();
        $settingBackground = SettingBackground::first();
        return view('admin.home', compact('settingSpare', 'settingBackground'));
    }
}
