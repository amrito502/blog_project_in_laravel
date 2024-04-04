<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
class Post extends Model
{
    use HasFactory;

    function comments(){
        return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','cat_id');
    }
}
