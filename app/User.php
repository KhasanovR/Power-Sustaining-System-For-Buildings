<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\select;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function best_record()
    {
        return $this->hasOne('App\best_record');
    }

    public function rank()
    {
        return $this->hasOne('App\rank');
    }
    
    public function ecg_items()
    {
        return $this->hasMany('App\ecg_items');
    }
    
    public function buildings()
    {
        return $this->hasMany('App\building');
    }
    
    public function phones()
    {
        return $this->hasMany('App\phones');
    }
    
    public function guider()
    {
        return $this->hasMany('App\User');
    }
    public function guidee()
    {
        return $this->hasMany('App\User');
    }

    public function selects(){
        return $this->hasMany(select::class);
    }
}
