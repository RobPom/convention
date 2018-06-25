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
    }
}
