<?php

use App\SettingSpare;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('cities')->insert([
            'id' => 1,
            'name' => 'bogor'
        ]);
        // $this->call(SettingSpareSeeder::class);
        // $this->call(CitySeeder::class);
    }
}
