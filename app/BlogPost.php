<?php

namespace App;
use Carbon\Carbon;
use App\BlogCategory;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    public function published(){
        return $this->posted_on !== null ? true : false ;
    }

    public function datePostedString(){
       // $dt = Carbon::parse('$this->posted_on');
        return Carbon::parse($this->posted_on)->format('F jS, Y');
    }

    public function shortDate(){
        // $dt = Carbon::parse('$this->posted_on');
        if($this->published())
        {
            return Carbon::parse($this->posted_on)->format('M Y');
        }
            return 'not published';
     }

     public function category(){
        // $dt = Carbon::parse('$this->posted_on');
         return BlogCategory::find($this->category);
     }

    public function user() {
        return $this->belongsTo('App\User');
    }


}
