<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    
    public function videos(){
        return morphedByMany('Video', 'taggable');
    }
    public function posts(){
        return morphedByMany('Post', 'taggable');
    }
}
