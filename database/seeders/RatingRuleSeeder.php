<?php

namespace Database\Seeders;

use App\Models\RatingRule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RatingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vychádzky s maximalnym stratením 10 bodov
        RatingRule::firstOrCreate(['class' => 1,'min_rating' =>4.85, 'until' => '20:30']);
        RatingRule::firstOrCreate(['class' => 2,'min_rating' =>4.85, 'until' => '21:30']);
        RatingRule::firstOrCreate(['class' => 3,'min_rating' =>4.85, 'until' => '21:30']);
        RatingRule::firstOrCreate(['class' => 4,'min_rating' =>4.85, 'until' => '21:30']);


        //vychádzky so stratením 20% bodov
        RatingRule::firstOrCreate(['class' => 2,'min_rating' => 4,'until' => '21:00']);
        RatingRule::firstOrCreate(['class' => 3,'min_rating' => 4,'until' => '21:00']);
        RatingRule::firstOrCreate(['class' => 4,'min_rating' => 4,'until' => '21:00']);

        //ostatne
        RatingRule::firstOrCreate(['class' => 1,'min_rating' =>0, 'until' => '20:00']);
        RatingRule::firstOrCreate(['class' => 2,'min_rating' =>0, 'until' => '20:00']);
        RatingRule::firstOrCreate(['class' => 3,'min_rating' =>0, 'until' => '20:00']);
        RatingRule::firstOrCreate(['class' => 4,'min_rating' =>0, 'until' => '20:00']);

    }
}
