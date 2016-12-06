<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withPivot('action')->withTimestamps();
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function columns(){
        return $this->hasMany('App\Column');
    }

    public function breakingnews(){
        return $this->hasMany('App\BreakingNews');
    }


    public function getGenderAttribute($value)
    {
        if($value == 0)
        {
            return ucfirst('female');
        }
        else return ucfirst('male');
    }

    public function getIsActivatedAttribute($value)
    {
        if($value === 0)
        {
            return false;
        }
        else return true;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y', strtotime($value));
    }

    public function isAdministrator(){
        return $this->role->name === 'Administrator';
    }


    public function isReporter(){
        return $this->role->name === 'Reporter';
    }

    public function isColumnist(){
        return $this->role->name === 'Columnist';
    }
}
