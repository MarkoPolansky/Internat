<?php

namespace Database\Seeders;

use App\Models\AvailableOuting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            ['name' =>  'Adam Tančák', 'email' =>'tancak@spse-po.sk'],
            ['name' =>  'Jakub Baranský', 'email' =>'baransky@spse-po.sk'],
            ['name' =>  'Jakub Šebest', 'email' =>'sebest@spse-po.sk'],
            ['name' =>  'Timotej Breznický', 'email' =>'breznicky@spse-po.sk'],
            ['name' =>  'Marko Poľanský', 'email' =>'polansky@spse-po.sk']];

        foreach ($users as $user){
           $u = User::firstOrCreate([
                'name' => $user['name'],
                'apartment_id' => 2,
                'email' => $user['email'],
                'email_verified_at' => now(),
                'class' => 4,
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),]);

            $u->assignRole('internatista');

            AvailableOuting::create([
                'user_id' => $u->id,
                'until' => '21:30'
            ]);
        }


        //ADMIN
        User::firstOrCreate([
            'name' => 'admin',
            'apartment_id' => random_int(1,10),
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),])
            ->assignRole(['Super-Admin']);
    }
}
