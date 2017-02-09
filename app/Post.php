<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    //
    public function textpost()
    {
        return $this->hasOne('App\TextPost');
    }

    public function videoPost()
    {
        return $this->hasOne('App\VideoPost');
    }


    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('action')->withTimestamps();
    }


    public function getDay()
    {
        return date('l F d, Y', strtotime($this->created_at));
    }

    public function getTime()
    {
        return date('h:i A', strtotime($this->created_at));
    }

    public function getDate()
    {
        return 'dynamic date';
    }
    public function photos(){
        return $this->hasMany('App\PicturePost');
    }
}
