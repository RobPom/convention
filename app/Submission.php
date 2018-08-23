<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function convention(){
        return $this->belongsTo('App\Convention');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function game() {
        return $this->belongsTo('App\Game');
    }
}
