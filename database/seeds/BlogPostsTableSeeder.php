<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\BlogPost;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizers = User::whereHas('roles', function($query)
            { $query->where('name', 'like', 'organizer'); }
        ) ->get();

        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('blog_posts')->insert([
	            'user_id' => $organizers->random()->id,
                'title' => $faker->sentence(),
                'lead' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'body' => $faker->paragraphs($nbSentences = 3, $variableNbSentences = true),
                'category' => 1,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'),
	        ]);
	    }   

    }
}
