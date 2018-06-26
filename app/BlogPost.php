<?php

namespace App;
use Carbon\Carbon;
use App\BlogCategory;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    public function datePostedString(){
       // $dt = Carbon::parse('$this->posted_on');
        return Carbon::parse($this->posted_on)->format('F jS, Y');
    }

    public function shortDate(){
        // $dt = Carbon::parse('$this->posted_on');
         return Carbon::parse($this->posted_on)->format('M Y');
     }

     public function category(){
        // $dt = Carbon::parse('$this->posted_on');
         return BlogCategory::find($this->category);
     }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
