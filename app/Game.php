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

    public function isActive($gameId){
        $convention = Convention::where('status' , 'active')->first();
        $gamesessions = GameSession::where('game_id', $gameId)->get();
        foreach($gamesessions as $gamesession)
        if( $gamesession->timeslot->convention_id == $convention->id ){
            return true;
        }
        return false;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getGamesSession($gameId , $timeslotId)
    {
        return GameSession::where('game_id', $gameId)->where('timeslot_id' , $timeslotId)->first();
    }
}
