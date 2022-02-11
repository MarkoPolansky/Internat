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

        Apartment::FirstOrCreate(['name' => 'A11','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'A12','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'A13','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'A21','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'A22','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'A23','floor' => 1]);

        Apartment::FirstOrCreate(['name' => 'A31','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'A32','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'A33','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'A41','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'A42','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'A43','floor' => 2]);

        Apartment::FirstOrCreate(['name' => 'A51','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'A52','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'A53','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'A61','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'A62','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'A63','floor' => 3]);



        Apartment::FirstOrCreate(['name' => 'B11','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B12','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B13','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B21','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B22','floor' => 1]);
        Apartment::FirstOrCreate(['name' => 'B23','floor' => 1]);

        Apartment::FirstOrCreate(['name' => 'B31','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'B32','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'B33','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'B41','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'B42','floor' => 2]);
        Apartment::FirstOrCreate(['name' => 'B43','floor' => 2]);

        Apartment::FirstOrCreate(['name' => 'B51','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'B52','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'B53','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'B61','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'B62','floor' => 3]);
        Apartment::FirstOrCreate(['name' => 'B63','floor' => 3]);




    }
}
