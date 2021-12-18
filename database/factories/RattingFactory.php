<?php

namespace Database\Factories;

use App\Models\Ratting;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class RattingFactory extends Factory
{


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ratting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'apartment_id' => random_int(1,17),
            'rating' => random_int(1,10)/2,
            'created_at' => Carbon::now()->subWeek(3)->startOfWeek()->addDay(random_int(0,30))
        ];
    }
}
