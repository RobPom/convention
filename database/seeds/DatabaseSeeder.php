<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);

        // Set Up default blog post categories
        $this->call(PostCategorySeeder::class);

         // Blog Post seeder will use the above user roles and categories when creating posts
        $this->call(BlogPostsTableSeeder::class);

        //seed a couple of conventions
        $this->call(ConventionTableSeeder::class);

        // Game seeder will use the above users when creating games
        $this->call(GameTableSeeder::class);

         //seed timeslots with session 1 to 5
         $this->call(TimeslotTableSeeder::class);
    }
}
