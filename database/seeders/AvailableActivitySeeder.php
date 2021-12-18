<?php

namespace Database\Seeders;

use App\Models\AvailableActivity;
use Illuminate\Database\Seeder;

class AvailableActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AvailableActivity::firstOrCreate(['name' => 'Posilňovňa']);
        AvailableActivity::firstOrCreate(['name' => 'Telocvičňa']);
        AvailableActivity::firstOrCreate(['name' => 'Ihrisko']);

    }
}
