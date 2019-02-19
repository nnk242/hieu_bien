<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer';
    protected $fillable = ['facebook', 'icon_facebook', 'number_phone', 'icon_number_phone', 'zalo', 'icon_zalo', 'address', 'icon_address'];
}
