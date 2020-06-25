<?php

namespace App\Console\Commands;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate schedule from xml data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('finding xml file ');
        $file = Storage::disk('local')->get('data-source-xml/data-bogor-2020.xml');
        $this->info('file found !');

        $this->info('converting xml file to object');
        $xmlData = simplexml_load_string($file);

        foreach($xmlData->data as $data) {
            $this->info('creating Schedule');

            $year = $data->year;
            $month = $data->month;
            $date = $data->date;

            $time = $data->imsyak;

            $this->info('creating imsyak');
            
            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");

            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 1,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);

            $time = $data->fajr;

            $this->info('creating fajr');

            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");
            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 2,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);
            
            $time = $data->syuruq;

            $this->info('creating syuruq');

            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");
            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 3,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);
            
            $time = $data->dzuhr;

            $this->info('creating dzuhur');

            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");
            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 4,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);

            $time = $data->ashr;

            $this->info('creating ashr');

            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");
            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 5,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);

            $time = $data->maghrib;

            $this->info('creating maghrib');

            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");
            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 5,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);

            $time = $data->isya;

            $this->info('creating isya');

            $epoch = $this->generateTimestamp("{$year}-{$month}-{$date} {$time}");
            Schedule::query()->updateOrCreate([
                'year' => $data->year,
                'month' => $data->month,
                'date' => $data->date,
                'city_id' => 1,
                'time_id' => 5,
                'time' => $time,
                'epoch' => $epoch,
                'data' => json_encode($data)
            ]);
        }
    }

    private function generateTimestamp($string)
    {
        return Carbon::parse($string, 'Asia/Jakarta')->timestamp;
    }
}
