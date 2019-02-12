<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //
    protected $table = 'prices';

    protected $fillable = ['name', 'description', 'price', 'per', 'type_id', 'status'];
}
