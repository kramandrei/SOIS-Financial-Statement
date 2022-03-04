<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org_income extends Model
{
    protected $connection = 'mysql';
    protected $table = 'org_incomes';
    protected $guarded = [];

    public function organization(){
        return $this->belongsTo('App\Organization','org_id','organization_id');
    }

    public function income(){
        return $this->belongsTo('App\Income','income_id','id');
    }

    public function approvedUser(){
        return $this->belongsTo('App\User','approvedBy','id');
    }

    public function createdUser(){
        return $this->belongsTo('App\User','createdBy','id');
    }
}
