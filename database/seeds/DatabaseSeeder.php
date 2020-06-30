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
        $this->call(SettingSpareSeeder::class);
        $this->call(CitySeeder::class);
    }
}
