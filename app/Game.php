<?php

namespace App;
use Timeslot;
use App\GameSession;
use App\Convention;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function timeslots()
    {
        return $this->belongsToMany('App\Timeslot')->using('App\GameSession');
    }

    public function gamesessions()
    {
        return $this->belongsToMany('App\GameSession');
    }

    public function active(){
        if($this->status || $this->status == 'active') {
            return true;
        }
        return false;   
    }

    public function convention(){
        return $this->belongsTo('App\Convention' , 'event_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function parent(){
        if ($this->parent_id){
            return Game::find($this->parent_id);
        }
        return null;

    }


    public function getGamesSession($gameId , $timeslotId)
    {
        return GameSession::where('game_id', $gameId)->where('timeslot_id' , $timeslotId)->first();
    }


}
