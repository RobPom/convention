<?php

use App\Convention;
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
        $convention = App\Convention::first();
        
        //1
        $game = new Game();
        $game->user_id = 2;
        $game->title = 'Sſtabhmontown';
        $game->tagline = 'Get rich or die trying' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 3;
        $game->max = 10;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //2
        $game = new Game();
        $game->user_id = 3;
        $game->title = 'Escape from Taris';
        $game->tagline = 'You will never find a more wretched hive of scum and villainy.' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 6;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //3
        $game = new Game();
        $game->user_id = 9;
        $game->title = 'Sweeps Week';
        $game->tagline = '2001 and it\'s another Tuesday in Sunnydale' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 8;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //4
        $game = new Game();
        $game->user_id = 8;
        $game->title = 'Gas: Stories of a Dying Atmosphere';
        $game->tagline = 'Out of this world adventure in outer space!' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 6;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //5
        $game = new Game();
        $game->user_id = 7;
        $game->title = 'Rappan Athuk';
        $game->tagline = 'The Dungeon of Graves!' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 10;
        $game->active = false;
        $game->save();
        //6
        $game = new Game();
        $game->user_id = 2;
        $game->title = 'The Spellcasting School of Mugmort';
        $game->tagline = 'A mystical school days adventure!' ;
        $game->lead = $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ;
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'FATE Accelerated';
        $game->min = 2;
        $game->max = 6;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //7
        $game = new Game();
        $game->user_id = 9;
        $game->title = 'The Quiet Year';
        $game->tagline = 'Building a community one card at a time.' ;
        $game->lead = 'For a long time, we were at war with The Jackals. But now, we’ve driven them off, and we have this – a year of relative peace. One quiet year, with which to build our community up and learn once again how to work together';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->min = 2;
        $game->max = 6;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //8
        $game = new Game();
        $game->user_id = 8;
        $game->title = 'Bridge to Ehrdoth';
        $game->tagline = 'For Skjavenhold!' ;
        $game->lead = 'A race against time to save your city from destruction.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Dungeons & Dragons 5e';
        $game->min = 2;
        $game->max = 10;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //9
        $game = new Game();
        $game->user_id = 3;
        $game->title = 'Grimmsgate';
        $game->tagline = 'Be a part of the old school renaissance!' ;
        $game->lead = 'Deep in the wooded wilderness, the village of Grimmsgate is an outpost town on a seldom-traveled trail, right at the edge of nowhere.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Swords and Wizardry';
        $game->min = 2;
        $game->max = 8;
        $game->active = false;
        $game->save();
        //10
        $game = new Game();
        $game->user_id = 9;
        $game->title = 'Prince Charming, Reanimator';
        $game->tagline = 'Can you survive this fairy-tale funnel gone mad?' ;
        $game->lead = 'Prince Hubert Charming\'s cold and emotionless eyes are well known throughout the kingdom.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Dungeon Crawl Classics';
        $game->min = 2;
        $game->max = 6;
        $game->active = false;
        $game->save();
        //11
        $game = new Game();
        $game->user_id = 7;
        $game->title = 'Mandatory Team Building Exercise';
        $game->tagline = 'There are things out there, in the weirder reaches of space-time where reality is an optional extra' ;
        $game->lead = 'Good news: it\'s a weekend away from the drudgery of the office.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Dungeon Crawl Classics';
        $game->min = 2;
        $game->max = 4;
        $game->active = true;
        $game->save();
        //12
        $game = new Game();
        $game->user_id = 8;
        $game->title = 'We Are All Made of Stars';
        $game->tagline = 'Pew!' ;
        $game->lead = 'The galaxy\’s a wild and rough place.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'FATE Accelerated';
        $game->min = 2;
        $game->max = 8;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //13
        $game = new Game();
        $game->user_id = 7;
        $game->title = 'Underworld';
        $game->tagline = 'Leather pants optional, but recommended.' ;
        $game->lead = 'Vampires, werewolves?..oh yeah.  Sparkles?..hell no.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Unisystem';
        $game->min = 2;
        $game->max = 8;
        $game->active = true;
        $game->save();
        //14
        $game = new Game();
        $game->user_id = 2;
        $game->title = 'Cthulhu\'s Island';
        $game->tagline = '“Ph\'nglui mglw\'nafh Cthulhu R\'lyeh wgah\'nagl fhtagn."' ;
        $game->lead = 'The world is indeed comic, but the joke is on mankind.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Call of Cthulhu';
        $game->min = 2;
        $game->max = 6;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //15
        $game = new Game();
        $game->user_id = 9;
        $game->title = 'Frozen in Time';
        $game->tagline = 'Neolithic Sword and Sandals with some Funky Dice thrown in.' ;
        $game->lead = 'Eons-old secrets slumber beneath the forbidden Ghost Ice';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Dungeon Crawl Classics';
        $game->min = 2;
        $game->max = 4;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
        //16
        $game = new Game();
        $game->user_id = 10;
        $game->title = 'Hall of Bones';
        $game->tagline = 'Be a part of the old school renaissance!' ;
        $game->lead = 'Get rich and die trying.';
        $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
        $game->system = 'Swords and Wizardry';
        $game->min = 2;
        $game->max = 6;
        $game->active = true;
        $game->save();
        //$convention->games()->attach($game);
         //17
         $game = new Game();
         $game->user_id = 10;
         $game->title = 'Chickens... Why did it have to be chickens?';
         $game->tagline = 'Kobolds can be heroes... sort of' ;
         $game->lead = 'ALL HAIL KING TORG!';
         $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
         $game->system = 'Kobolds Ate My Baby';
         $game->min = 2;
         $game->max = 6;
         $game->active = true;
         $game->save();
         //$convention->games()->attach($game);
         //18
         $game = new Game();
         $game->user_id = 11;
         $game->title = 'Furry Road';
         $game->tagline = 'A stitch-punk tabletop role-playing game' ;
         $game->lead = 'A jury-rigged toy in a broken, stitched-together world.';
         $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
         $game->system = 'Threadbare (PBTA)';
         $game->min = 2;
         $game->max = 10;
         $game->active = false;
         $game->save();
         //19
         $game = new Game();
         $game->user_id = 11;
         $game->title = 'Milk Flights';
         $game->tagline = 'Silent through the night, the Witches join the fight' ;
         $game->lead = 'The wind will whisper when the Night Witches come.';
         $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
         $game->system = 'Night Witches (PBTA)';
         $game->min = 2;
         $game->max = 6;
         $game->active = false;
         $game->save();
         //20
         $game = new Game();
         $game->user_id = 7;
         $game->title = 'Remember Tomorrow';
         $game->tagline = 'Max Headroom ain\'t got nothing on you!' ;
         $game->lead = 'Goal-oriented stories built in play';
         $game->description = $faker->paragraphs($nbSentences = 3, $variableNbSentences = true);
         $game->system = 'Remember Tomorrow';
         $game->min = 2;
         $game->max = 4;
         $game->active = false;
         $game->save();
         //$convention->games()->attach($game);
    }
}
