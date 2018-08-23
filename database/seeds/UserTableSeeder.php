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

        $admin = new User();
        $admin->username = 'The Artist';
        $admin->firstname = 'Prince Rogers';
        $admin->lastname = 'Nelson';
        $admin->email = 'admin@intriguecon.com';
        $admin->password = bcrypt('secret');
        $admin->verified = true;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $organizer = new User();
        $organizer->username = 'PJ';
        $organizer->firstname = 'Polly Jean';
        $organizer->lastname = 'Harvey';
        $organizer->email = 'organizer@intriguecon.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $organizer = new User();
        $organizer->username = 'Flea';
        $organizer->firstname = 'Michael Peter';
        $organizer->lastname = 'Balzary';
        $organizer->email = 'flea@intriguecon.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $organizer = new User();
        $organizer->username = 'TonyFlow';
        $organizer->firstname = 'Tony';
        $organizer->lastname = 'Keidis';
        $organizer->email = 'tonyflow@intriguecon.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $organizer = new User();
        $organizer->username = 'MeatBat';
        $organizer->firstname = 'Chad';
        $organizer->lastname = 'Smith';
        $organizer->email = 'meatbat@intriguecon.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $organizer = new User();
        $organizer->username = 'Ghost';
        $organizer->firstname = 'Josh';
        $organizer->lastname = 'Klinghoffer';
        $organizer->email = 'joshk@intriguecon.com';
        $organizer->password = bcrypt('secret');
        $organizer->verified = true;
        $organizer->save();
        $organizer->roles()->attach($role_organizer);

        $member = new User();
        $member->username = 'Heroine';
        $member->firstname = 'Ella Marija Lani';
        $member->lastname = "Yelich-O'Connor ";
        $member->email = 'member@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Barny';
        $member->firstname = 'Bernard';
        $member->lastname = 'Sumner';
        $member->email = 'bsumner@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Hooky';
        $member->firstname = 'Peter';
        $member->lastname = 'Hook';
        $member->email = 'phook@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Gill';
        $member->firstname = 'Gillian';
        $member->lastname = 'Gilbert';
        $member->email = 'ggilbert@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Machine';
        $member->firstname = 'Stephen';
        $member->lastname = 'Morris';
        $member->email = 'smorris@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'JesseF';
        $member->firstname = 'Jesse';
        $member->lastname = 'Keeler';
        $member->email = 'jkeeler@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);
        
        $member = new User();
        $member->username = 'Grainy';
        $member->firstname = ' Sebastien';
        $member->lastname = 'Grainger';
        $member->email = 'sgrainger@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Francis';
        $member->firstname = 'Frank';
        $member->lastname = 'Black';
        $member->email = 'fblack@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'TammyAmpersand';
        $member->firstname = 'Kim';
        $member->lastname = 'Deal';
        $member->email = 'kdeal@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Alberto';
        $member->firstname = 'Joey';
        $member->lastname = 'Santiago';
        $member->email = 'jsantiago@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'Phenomenalist';
        $member->firstname = 'David';
        $member->lastname = 'Lovering';
        $member->email = 'dlovering@intriguecon.com';
        $member->password = bcrypt('secret');
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);
 	
    }
}
