<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $connection = 'mysql';
    protected $table = 'users';

    public function organization(){
        return $this->belongsTo('App\Organization','organization_id','organization_id');
    }

    public function role(){
        return $this->belongsTo('App\Role','role_id','role_id');
    }

    public function role_user(){
        return $this->belongsTo('App\Role_user','id','user_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','organization_id','role_id','isActive','fullname',
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
}
