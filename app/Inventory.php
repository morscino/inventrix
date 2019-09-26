<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'category','description','price','unit','status',
    ];
}
