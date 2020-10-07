<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    // protected fillable for safty from hackers
    protected $fillable = [
        'tax'
    ];
    public $timestamps = false;
}
