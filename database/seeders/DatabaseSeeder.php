<?php

namespace Database\Seeders;

use App\Models\AvailableOuting;
use App\Models\Outing;
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
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(ApartmentSeeder::class);

        User::factory(100)->create();
//        Ratting::factory(100)->create();
//        AvailableOuting::factory(100)->create();
//        Outing::factory(10)->create();
//
//        for($i=1;$i<100;$i++){
//            User::find($i)->assignRole(random_int(1,3));
//        }
//



    }
}
