<?php

namespace Database\Seeders;

use App\Models\Cleaning;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CleaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cleaning::firstOrCreate(['class' => 1,'day' => Carbon::tomorrow()]);
        Cleaning::firstOrCreate(['class' => 2,'day' => Carbon::tomorrow()]);
        Cleaning::firstOrCreate(['class' => 3,'day' => Carbon::tomorrow()]);
        Cleaning::firstOrCreate(['class' => 4,'day' => Carbon::tomorrow()]);
    }
}
