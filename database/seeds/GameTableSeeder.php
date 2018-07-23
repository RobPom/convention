<?php

use App\Game;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $organizers = User::whereHas('roles', function($query)
            { $query->where('name', 'like', 'organizer'); }
        ) ->get();
        
        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'Sſtabhmontown';
        $game->tagline = 'Get rich or die trying' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 3;
        $game->max = 10;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'Escape from Taris';
        $game->tagline = 'You will never find a more wretched hive of scum and villainy.' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 6;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'Sweeps Week';
        $game->tagline = '2001 and it\'s another Tuesday in Sunnydale' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 4;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'Gas: Stories of a Dying Atmosphere';
        $game->tagline = 'Out of this world adventure in outer space!' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 6;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'Rappan Athuk';
        $game->tagline = 'The Dungeon of Graves!' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 9;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'The Spellcasting School of Mugmort';
        $game->tagline = 'A mystical school days adventure!' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'FATE Accelerated';
        $game->min = 2;
        $game->max = 6;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'The Quiet Year';
        $game->tagline = 'Building a community one card at a time.' ;
        $game->lead = 'For a long time, we were at war with The Jackals. But now, we’ve driven them off, and we have this – a year of relative peace. One quiet year, with which to build our community up and learn once again how to work together';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 6;
        $game->save();

        $game = new Game();
        $game->user_id = $organizers->random()->id;
        $game->title = 'Bridge to Ehrdoth';
        $game->tagline = 'For Skjavenhold!' ;
        $game->lead = 'A race against time to save your city from destruction.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Dungeons & Dragons 5e';
        $game->min = 2;
        $game->max = 6;
        $game->save();
    }
}
