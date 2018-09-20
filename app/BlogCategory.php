<?php

namespace App;
use App\BlogPost;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public function posts(){
        return BlogPost::where('category' , $this->id )->get();
    }

    public function postCount(){
        return BlogPost::where('category' , $this->id )->where('posted_on' , '!=' , 'null')->count();
        
    }
}
