<?php

namespace App;
use App\Game;
use App\Timeslot;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GameSession extends Pivot
{
    protected $table = 'game_timeslot';

    public function game() 
    {
        return  $this->hasOne('App\Game' , 'id' , 'game_id');
    }

    public function timeslot() 
    {
        return $this->hasOne('App\Timeslot' , 'id' , 'timeslot_id');
    }

    public function attendees()
    {
        return $this->belongsToMany('App\User', 'game_session_user', 'game_timeslot_id' , 'user_id');
    }
    
    

}
