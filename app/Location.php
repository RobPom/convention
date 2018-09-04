<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function conventions(){
        return $this->hasMany('App\Convention');
    }
}
