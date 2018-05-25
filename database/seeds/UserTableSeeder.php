<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_member = Role::where('name', 'member')->first();
        $role_organizer = Role::where('name', 'organizer')->first();
        $role_admin = Role::where('name', 'admin')->first();


        $member = new User();
        $member->name = 'Joe Member';
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('secret');
        $member->save();
        $member->roles()->attach($role_member);

        $organizer = new User();
        $organizer->name = 'Clinton Daniels';
        $organizer->email = 'organizer@gmail.com';
        $organizer->password = bcrypt('secret');
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);



    }
}
