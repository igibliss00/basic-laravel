<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'path'
        ];
    
    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable');
    }
    
    public function getPathAttribute($value){
        $path = $this->directory . $value;
        return $path;
    }
}
