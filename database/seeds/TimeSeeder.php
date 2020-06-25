<?php

use App\Time;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('times')->insert([
            [
                'name' => 'imsyak',
                'title' => 'Imsyak',
                'description' => 'Imsyak',
                'image_path' => '',
                'is_iqomah' => '0',
                'order' => 1,
            ],
            [
                'name' => 'subuh',
                'title' => 'Subuh',
                'description' => 'Subuh',
                'image_path' => '',
                'is_iqomah' => '1',
                'order' => 2,
            ],
            [
                'name' => 'syuruq',
                'title' => 'Syuruq',
                'description' => 'Syuruq',
                'image_path' => '',
                'is_iqomah' => '0',
                'order' => 3,
            ],
            [
                'name' => 'dzuhur',
                'title' => 'Dzuhur',
                'description' => 'Dzuhur',
                'image_path' => '',
                'is_iqomah' => '1',
                'order' => 4,
            ],
            [
                'name' => 'ashar',
                'title' => 'Ashar',
                'description' => 'Ashar',
                'image_path' => '',
                'is_iqomah' => '1',
                'order' => 5,
            ],
            [
                'name' => 'maghrib',
                'title' => 'Maghrib',
                'description' => 'Maghrib',
                'image_path' => '',
                'is_iqomah' => '1',
                'order' => 6,
            ],
            [
                'name' => 'isya',
                'title' => 'Isya',
                'description' => 'Isya',
                'image_path' => '',
                'is_iqomah' => '1',
                'order' => 7,
            ],
        ]);
    }
}
