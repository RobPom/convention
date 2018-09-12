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

    public function players(){
        $counter = 0;
        foreach($this->games as $game){
            $gamesession = $this->gamesession($game);
            $counter += $gamesession->attendees->count();
        }
        return $counter;
    }

    public function max_players(){
        $counter = 0;
        foreach($this->games as $game){
            
            $counter += $game->max;
        }
        return $counter;
    }


    public function gamesessions()
    {
        return $this->hasMany('App\GameSession');
    }

    public function gamesession($game)
    {
        $gamesession = GameSession::where('timeslot_id', $this->id)->where('game_id' , $game->id)->first();
        return  $gamesession;
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


    public function pretty_times() {
        $start = new Carbon($this->start_time);
        $end = new Carbon($this->end_time);
        $string = '';
        $string .= $start->format('l') . ' ';
        $string .= $start->minute == 0 ? $start->format('ga') : $start->format('g:ia');
        $string .= ' to ';
        $string .= $end->minute == 0 ? $end->format('ga') : $end->format('g:ia');
        return $string;
    }

    public function only_times() {
        $start = new Carbon($this->start_time);
        $end = new Carbon($this->end_time);
        $string = '';
        $string .= $start->minute == 0 ? $start->format('ga') : $start->format('g:ia');
        $string .= ' to ';
        $string .= $end->minute == 0 ? $end->format('ga') : $end->format('g:ia');
        return $string;
    }

}
