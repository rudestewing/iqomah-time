<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TimeSeeder::class);
        SettingSpare::create([
            'iqomah' => 600,
            'iqomah_alert' => 12,
            'upcoming' => 600,
        ]);
        // $this->call(SettingSpareSeeder::class);
        $this->call(CitySeeder::class);
    }
}
