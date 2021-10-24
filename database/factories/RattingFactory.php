<?php

namespace Database\Factories;

use App\Models\Ratting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => User::factory(),
            'apartment_id' => random_int(1,17),
            'rating' => 5.0
        ];
    }
}
