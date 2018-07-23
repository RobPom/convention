<?php

namespace App;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{
    public function timeslots(){
        return $this->hasMany('App\Timeslot');
    }

    public function start_date(){
        return new Carbon($this->start_date);
    }

    public function end_date(){
        return new Carbon($this->end_date);
    }

    public function days(){
        $start = new Carbon($this->start_date());
        $end = new Carbon($this->end_date());
        $days = [];
        for($day = $start; $day->lte($end); $day->addDay()) {
            
            $days[] = new Carbon($day);
        } 

        return $days;
    }
}
