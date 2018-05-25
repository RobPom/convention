<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_member = new Role();
        $role_member->name = 'member';
        $role_member->description = 'A Registered User';
        $role_member->save();

        $role_organizer = new Role();
        $role_organizer->name = 'organizer';
        $role_organizer->description = 'An Organizer for the Conventions';
        $role_organizer->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Admin for the Website';
        $role_admin->save();
    }
}
