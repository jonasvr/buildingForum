<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $role_owner = Role::where('name', 'owner')->first();
        $role_habitant = Role::where('name', 'tenant')->first();
        $role_resident = Role::where('name', 'resident')->first();
        $role_admin = Role::where('name', 'admin')->first();

        for ($i = 0; $i < 5; $i++) {

            $name = $faker->name;
            $employee = new User();
            $employee->name = $name;
            $employee->email = $name . '@example.com';
            $employee->password = bcrypt('secret');
            $employee->save();
            $employee->roles()->attach($role_owner);
        }

        for ($i = 0; $i < 5; $i++) {

            $name = $faker->name;
            $employee = new User();
            $employee->name = $name;
            $employee->email = $name . '@example.com';
            $employee->password = bcrypt('secret');
            $employee->save();
            $employee->roles()->attach($role_habitant);
        }

        for ($i = 0; $i < 5; $i++) {

            $name = $faker->name;
            $employee = new User();
            $employee->name = $name;
            $employee->email = $name . '@example.com';
            $employee->password = bcrypt('secret');
            $employee->save();
            $employee->roles()->attach($role_resident);
        }

        $employee = new User();
        $employee->name = 'Jonas Van Reeth';
        $employee->email = 'jonasvanreeth@gmail.com';
        $employee->password = bcrypt('test1234');
        $employee->save();
        $employee->roles()->attach($role_admin);
    }
}
