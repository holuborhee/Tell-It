<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextPost extends Model
{


	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	public $timestamps = false;
    //
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
