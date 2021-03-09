<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = ['name','respondent', 'reason', 'place','time','date'];
}
