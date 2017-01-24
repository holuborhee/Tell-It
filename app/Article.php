<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    //
    public function column(){
    	return $this->belongsTo('App\Column');
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
    /*public function getCreatedAtAttribute($value)
    {
        return date('l F d, Y', strtotime($value));
    }*/
}
