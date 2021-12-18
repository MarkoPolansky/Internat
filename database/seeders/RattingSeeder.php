<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Ratting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Ramsey\Collection\Collection;

class RattingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rattingInsertion = \Illuminate\Support\Collection::empty();


       $apartments = Apartment::all();

       foreach ($apartments as $apartment){

           $period = CarbonPeriod::create(Carbon::now()->subWeek(3)->startOfWeek(), '1 days', today());

           foreach ($period as $key => $date) {
               if ($date->isWeekday() && $date->dayOfWeek != Carbon::MONDAY)
               $rattingInsertion->push([
                   'apartment_id' =>$apartment->id,
                   'rating' => random_int(1,10)/2,
                   'created_at' => $date,
                   'updated_at' => $date
               ]);
           }
       }
       Ratting::insert($rattingInsertion->toArray());

    }
}
