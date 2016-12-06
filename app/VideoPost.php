<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPost extends Model
{
    //
    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
