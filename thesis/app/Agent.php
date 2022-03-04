<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{

    protected $table = 'agents';
    protected $connection = 'agents';
    protected $guarded = [];
}
