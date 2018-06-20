<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
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

        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('blog_posts')->insert([
	            'user_id' => 1,
                'title' => $faker->sentence(),
                'lead' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'body' => $faker->paragraphs($nbSentences = 3, $variableNbSentences = true),
	        ]);
	    }   

    }
}
