<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected fillable for safty from hackers
    protected $fillable = [
        'title', 'desc', 'instock',
    ];

}
