<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::FirstOrcreate(['name' => 'internatista']);
        $role2 = Role::FirstOrcreate(['name' => 'vychovavatel']);
        $role3 = Role::FirstOrcreate(['name' => 'Super-Admin']);

    }
}
