<?php

use App\Timeslot;
use App\GameSession;
use Illuminate\Database\Seeder;

class TimeslotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeslot = new Timeslot();
        $timeslot->title = 'Session 1';
        $timeslot->start_time = '2018-10-12 21:00:00';
        $timeslot->end_time = '2018-10-13 00:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Session 2';
        $timeslot->start_time = '2018-10-13 10:00:00';
        $timeslot->end_time = '2018-10-13 13:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Session 3';
        $timeslot->start_time = '2018-10-13 17:00:00';
        $timeslot->end_time = '2018-10-13 20:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Session 4';
        $timeslot->start_time = '2018-10-13 21:00:00';
        $timeslot->end_time = '2018-10-14 01:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Session 5';
        $timeslot->start_time = '2018-10-14 11:00:00';
        $timeslot->end_time = '2018-10-14 15:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Session 1';
        $timeslot->start_time = '2018-10-14 10:00:00';
        $timeslot->end_time = '2018-10-14 14:00:00';
        $timeslot->convention_id = 2;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Session 2';
        $timeslot->start_time = '2017-10-14 15:00:00';
        $timeslot->end_time = '2017-10-14 19:00:00';
        $timeslot->convention_id = 2;
        $timeslot->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 1;
        $gamesession->timeslot_id = 1;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 1;
        $gamesession->timeslot_id = 4;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 2;
        $gamesession->timeslot_id = 2;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 3;
        $gamesession->timeslot_id = 1;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 3;
        $gamesession->timeslot_id = 2;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 4;
        $gamesession->timeslot_id = 1;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 4;
        $gamesession->timeslot_id = 2;
        $gamesession->save();

        $gamesession = new GameSession();
        $gamesession->game_id = 6;
        $gamesession->timeslot_id = 4;
        $gamesession->save();

    }
}
