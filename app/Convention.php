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

    public function submissions(){
        return $this->hasMany('App\Submission');
    }
    
    public function games(){
        return $this->hasMany('App\Game' , 'event_id'); //use event_id for convention
    }
    
    public function attendees(){
        return $this->belongsToMany('App\User');
    }

    public function location(){
        return $this->hasOne('App\Location');
    }

    public function pretty_dates() {
        $start = new Carbon($this->start_date);
        $end = new Carbon($this->end_date);
        return $start->format('l M jS') . ' to ' . $end->format('l M jS') . '.';
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

    /**
     * 
     */
    public function gameSessionsCount()
    {
        $counter = 0;
        foreach($this->timeslots as $timeslot)
        {
            foreach($timeslot->games as $game)
            {
                $counter ++ ;
            }
            
        }
        return $counter;
    }
}
