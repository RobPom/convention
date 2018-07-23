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

    public function datePosted(){
        if($this->published())
        {
            return Carbon::parse($this->posted_on)->format('F jS, Y');
        }
            return 'not published';
        
    }

    public function shortDate(){
        if($this->published())
        {
            return Carbon::parse($this->posted_on)->format('M Y');
        }
            return 'not published';
     }

     public function category(){
         return BlogCategory::find($this->category);
     }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
