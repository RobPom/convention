<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\Page;
use App\BlogPost;
use App\BlogCategory;
use Carbon\Carbon;

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
    	foreach (range(1,2) as $index) {
            $created = Carbon::instance($faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'));
            
            $posted = $created->addHours(mt_rand(1, 32))->toDateTimeString();
           

            $categories = BlogCategory::all();
            
            //$faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');

	        DB::table('blog_posts')->insert([
	            'user_id' => $organizers->random()->id,
                'title' => $faker->sentence(),
                'lead' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'body' => $faker->paragraphs($nbSentences = 3, $variableNbSentences = true),
                'category' => $categories->random()->id,
                'posted_on' => $posted,
                'created_at' => $created->toDateTimeString(),
	        ]);
        }  
        
        $page = new Page();
        $page->title = 'Front Page';
        $page->lead_article = 1;
        $page->featured_article = 2;
        $page->save();

    }
}
