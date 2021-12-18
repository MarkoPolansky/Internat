<?php

namespace Database\Factories;

use App\Models\AvailableOuting;
use App\Models\Outing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Outing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1,110),
            'available_outing_id' => random_int(1,100)
        ];
    }
}
