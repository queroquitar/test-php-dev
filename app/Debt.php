<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Debt extends Model
{
    protected $connection = 'mongodb';
}
