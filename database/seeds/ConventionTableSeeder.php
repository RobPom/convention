<?php

use App\Convention;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ConventionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $convention = new Convention();
        $convention->title = 'An Upcoming Convention';
        $convention->tagline = 'A look to the future.';
        $convention->lead = $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
        $convention->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $convention->start_date = '2018-10-12 00:00:00';
        $convention->end_date = '2018-10-14 00:00:00';
        $convention->status = 'active';
        $convention->save();

        $convention = new Convention();
        $convention->title = 'A Convention from the Past';
        $convention->tagline = 'Dwelling in the pasts';
        $convention->lead = $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
        $convention->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $convention->start_date = '2017-10-14 00:00:00';
        $convention->end_date = '2017-10-15 00:00:00';
        $convention->status = 'inactive';
        $convention->save();
    }
}
