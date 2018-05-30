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
        $member->username = 'member jill';
        $member->firstname = 'Jill';
        $member->lastname = 'Member';
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'bsumner';
        $member->firstname = 'Bernard';
        $member->lastname = 'Sumner';
        $member->email = 'bsumner@gmail.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Hookie';
        $member->firstname = 'Peter';
        $member->lastname = 'Hook';
        $member->email = 'phook@gmail.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'ggilbert';
        $member->firstname = 'Gillian';
        $member->lastname = 'Gilbert';
        $member->email = 'ggilbert@gmail.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'smorris';
        $member->firstname = 'Stephen';
        $member->lastname = 'Morris';
        $member->email = 'smorris@gmail.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $organizer = new User();
        $organizer->username = 'organizer joe';
        $organizer->firstname = 'joe';
        $organizer->lastname = 'organizer';
        $organizer->email = 'organizer@gmail.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $admin = new User();
        $admin->username = 'Admin';
        $admin->firstname = 'Rob';
        $admin->lastname = 'Pomerleau';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('secret');
        $admin->verified = true;
        $admin->save();
        $admin->roles()->attach($role_admin);

    }
}
