<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org_expense extends Model
{
    protected $connection = 'mysql';
    protected $table = 'org_expenses';
    protected $guarded = [];

    public function organization(){
        return $this->belongsTo('App\Organization','org_id','organization_id');
    }

    public function expense(){
        return $this->belongsTo('App\Expense','expense_id','id');
    }

    public function approvedUser(){
        return $this->belongsTo('App\User','approvedBy','id');
    }

    public function createdUser(){
        return $this->belongsTo('App\User','createdBy','id');
    }
}
