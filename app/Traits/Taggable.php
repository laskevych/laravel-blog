<?php

namespace App\Traits;

trait Taggable 
{

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }
}