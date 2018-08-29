<?php

use App\Timeslot;
use App\Game;
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
        $timeslot->title = 'Slot 1';
        $timeslot->start_time = '2018-10-12 21:00:00';
        $timeslot->end_time = '2018-10-13 00:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Slot 2';
        $timeslot->start_time = '2018-10-13 10:00:00';
        $timeslot->end_time = '2018-10-13 13:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Slot 3';
        $timeslot->start_time = '2018-10-13 17:00:00';
        $timeslot->end_time = '2018-10-13 20:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Slot 4';
        $timeslot->start_time = '2018-10-13 21:00:00';
        $timeslot->end_time = '2018-10-14 01:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

        $timeslot = new Timeslot();
        $timeslot->title = 'Slot 5';
        $timeslot->start_time = '2018-10-14 11:00:00';
        $timeslot->end_time = '2018-10-14 15:00:00';
        $timeslot->convention_id = 1;
        $timeslot->save();

    }
}
