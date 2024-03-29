<?php

namespace Database\Factories;

use App\Models\AvailableOuting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailableOutingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AvailableOuting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' =>random_int(1,110),
            'until' => Carbon::createFromTime(20,random_int(0,59))->toTimeString()
        ];
    }
}
