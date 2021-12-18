<?php

namespace Database\Factories;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(random_int(1,8)),
            'body'  => $this->faker->sentence(random_int(5,25)),
            'visible_until' => Carbon::today()->addDay(random_int(0,60))
        ];
    }
}
