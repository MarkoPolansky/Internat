<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apartment::FirstOrCreate(['name' => 'AP1','floor' => 0]);
        Apartment::FirstOrCreate(['name' => 'AP2','floor' => 0]);
        Apartment::FirstOrCreate(['name' => 'B11','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B12','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B13','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B21','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B22','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B23','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B33','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'B34','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'C11','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'C12','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'C13','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'C21','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'C22','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'C23','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'C33','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'C34','floor' => 2]);


    }
}
