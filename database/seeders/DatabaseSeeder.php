<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AvailableOuting;
use App\Models\Outing;
use App\Models\RatingRule;
use App\Models\Ratting;
use App\Models\User;
use Database\Factories\AvailableOutingsFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RatingRuleSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(ApartmentSeeder::class);
        $this->call(AvailableActivitySeeder::class);

        $this->call(RattingSeeder::class);


//            $this->call(CleaningSeeder::class);
//            Announcement::factory(30)->create();
//
//        User::factory(110)->create();
//        Ratting::factory(300)->create();
//        AvailableOuting::factory(100)->create();
//        Outing::factory(20)->create();
//
//
//        for($i=1;$i<100;$i++){
//            User::find($i)->assignRole(random_int(1,3));
//        }
//

    }
}
