<?php

use Illuminate\Database\Seeder;
use App\BlogCategory;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $category = new BlogCategory();
        $category->title = 'Uncategorized';
        $category->save();

        $category = new BlogCategory();
        $category->title = 'News';
        $category->save();

        $category = new BlogCategory();
        $category->title = 'Reviews';
        $category->save();

        $category = new BlogCategory();
        $category->title = 'Articles';
        $category->save();
    }
}
