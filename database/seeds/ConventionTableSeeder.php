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
        $convention->title = 'IntrigueCon 6';
        $convention->tagline = '... for when you gaze long into the abyss. The abyss gazes also into you.';
        $convention->lead = $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
        $convention->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $convention->start_date = '2018-10-12 00:00:00';
        $convention->end_date = '2018-10-14 00:00:00';
        $convention->status = 'active';
        $convention->save();

        $convention = new Convention();
        $convention->title = 'IntrigueCon Spring 2018';
        $convention->tagline = 'The Fellowship of the Spring';
        $convention->lead = $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
        $convention->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $convention->start_date = '2018-05-04 00:00:00';
        $convention->end_date = '2018-05-05 00:00:00';
        $convention->status = 'inactive';
        $convention->save();

        $convention = new Convention();
        $convention->title = 'IntrigueCon 5';
        $convention->tagline = 'Glory is fleeting but obscurity lasts forever';
        $convention->lead = $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
        $convention->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $convention->start_date = '2016-10-14 00:00:00';
        $convention->end_date = '2016-10-16 00:00:00';
        $convention->status = 'archived';
        $convention->save();

        $convention = new Convention();
        $convention->title = 'IntrigueCon 4';
        $convention->tagline = 'This way to certain death.';
        $convention->lead = $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
        $convention->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $convention->start_date = '2015-10-16 00:00:00';
        $convention->end_date = '2015-10-18 00:00:00';
        $convention->status = 'archived';
        $convention->save();
    }
}
