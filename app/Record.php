<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
  
    protected $fillable = ['name','dob','civil_status','gender','address','purok',];
}
