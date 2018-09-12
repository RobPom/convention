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

        $member = new User();
        $member->username = 'dgross';
        $member->firstname = 'Dave';
        $member->lastname = "Gross";
        $member->email = 'dave.gross@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

        $member = new User();
        $member->username = 'ngodbout';
        $member->firstname = 'Nick';
        $member->lastname = 'Godbout';
        $member->email = 'ngodbout87@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'jfour';
        $member->firstname = 'Johnn';
        $member->lastname = 'Four';
        $member->email = 'johnn@roleplayingtips.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'rcrockett';
        $member->firstname = 'Randy';
        $member->lastname = 'Crockett';
        $member->email = 'randycrockett@telus.net';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'tcameron';
        $member->firstname = 'Tara';
        $member->lastname = 'Cameron';
        $member->email = 'evil_little_onyx@yahoo.ca';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'afitzgerald';
        $member->firstname = 'Alana';
        $member->lastname = 'Fitzgerald';
        $member->email = 'astarke@shaw.ca';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'sfitzgerald';
        $member->firstname = 'Shane';
        $member->lastname = 'Fitzgerald';
        $member->email = 'stafitzgerald@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'dsteele';
        $member->firstname = 'Darren';
        $member->lastname = 'Steele';
        $member->email = 'darren.paul@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'brolls';
        $member->firstname = 'Braedon';
        $member->lastname = 'Rolls';
        $member->email = 'braedon@ualberta.ca';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);

	$member = new User();
        $member->username = 'gcomyn';
        $member->firstname = 'Graeme';
        $member->lastname = 'Comyn';
        $member->email = 'gicomyn@yahoo.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);


	$member = new User();
        $member->username = 'nknuff';
        $member->firstname = 'Neil';
        $member->lastname = 'Knuff';
        $member->email = 'neilknuff@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);


	$member = new User();
        $member->username = 'bjans';
        $member->firstname = 'Brent';
        $member->lastname = 'Jans';
        $member->email = 'brent.jans@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);


	$member = new User();
        $member->username = 'mlemieux';
        $member->firstname = 'Marc';
        $member->lastname = 'Lemieux';
        $member->email = 'lemieux.marc@gmail.com';
        $member->password = User::generatePassword();
        $member->verified = true;
        $member->save();
        $member->roles()->attach($role_member);
 	
    }
}
