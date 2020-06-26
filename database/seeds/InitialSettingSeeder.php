<?php

use App\SettingBackground;
use App\SettingSpare;
use Illuminate\Database\Seeder;

class InitialSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingBackground::create([
            'image_path' => '',
        ]);
        
        SettingSpare::create([
            'iqomah' => 600,
            'iqomah_alert' => 15,
            'upcoming' => 600,
        ]);
    }
}
