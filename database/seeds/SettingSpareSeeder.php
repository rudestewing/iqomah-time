<?php

use App\SettingSpare;
use Illuminate\Database\Seeder;

class SettingSpareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingSpare::create([
            'iqomah' => 600,
            'iqomah_alert' => 12,
            'upcoming' => 600,
        ]);
    }
}
