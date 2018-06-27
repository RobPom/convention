<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
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
        $faker = Faker::create();

        $organizer = new User();
        $organizer->username = 'Ojoe';
        $organizer->firstname = 'Joe';
        $organizer->lastname = 'Organizer';
        $organizer->email = 'organizer@intriguecon.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $organizer = new User();
        $organizer->username = 'Inky';
        $organizer->firstname = $faker->firstname;
        $organizer->lastname = $faker->lastname;
        $organizer->email = $faker->email;
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $organizer = new User();
        $organizer->username = 'Wizard';
        $organizer->firstname = $faker->firstname;
        $organizer->lastname = $faker->lastname;
        $organizer->email = $faker->email;
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $member = new User();
        $member->username = 'member jill';
        $member->firstname = 'Jill';
        $member->lastname = 'Member';
        $member->email = 'member@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $admin = new User();
        $admin->username = 'Admin';
        $admin->firstname = 'Rob';
        $admin->lastname = 'Pomerleau';
        $admin->email = 'admin@intriguecon.com';
        $admin->password = bcrypt('secret');
        $admin->verified = true;
        $admin->save();
        $admin->roles()->attach($role_admin);

      	foreach (range(6,15) as $index) {
	        DB::table('users')->insert([
                'username' => $faker->userName,
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
	            'email' => $faker->email,
	            'password' => bcrypt('secret'),
            ]);

            $member = User::find($index);
            $member->roles()->attach($role_member);
        }
    }
}
