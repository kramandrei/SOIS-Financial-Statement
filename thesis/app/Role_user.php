<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    protected $connection = 'main';
    protected $table = 'role_user';
    protected $guarded = [];

    public function org(){
        return $this->belongsTo('App\Organization','organization_id','organization_id');
    }

    public function role(){
        return $this->belongsTo('App\Role','role_id','role_id');
    }
}
