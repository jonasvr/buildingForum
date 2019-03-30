<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_tenant = new Role();
        $role_tenant->name = 'Tenant';
        $role_tenant->description = 'A tenant User';
        $role_tenant->save();

        $role_resident = new Role();
        $role_resident->name = 'Resident';
        $role_resident->description = 'A resident User';
        $role_resident->save();

        $role_owner = new Role();
        $role_owner->name = 'Owner';
        $role_owner->description = 'A owner User';
        $role_owner->save();

        $role_Admin = new Role();
        $role_Admin->name = 'Admin';
        $role_Admin->description = 'A Admin User';
        $role_Admin->save();
    }
}
