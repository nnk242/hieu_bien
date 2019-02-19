<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $table = 'doctors';
    protected $fillable = ['title', 'expert', 'education', 'experience', 'description', 'image', 'status'];
}
