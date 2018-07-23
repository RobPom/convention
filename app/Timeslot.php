<?php

namespace App;

use App\GameSession;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    public function games()
    {
        return $this->belongsToMany('App\Game')->using('App\GameSession');
    }

    public function gamesessions()
    {
        return $this->hasMany('App\GameSession');
    }

    public function convention(){
        return $this->belongsTo('App\Convention');
    }

    public function start_time() {
        $time = new Carbon($this->start_time);
        return $time;
    }

    public function end_time() {
        $time = new Carbon($this->end_time);
        return $time;
    }

}
