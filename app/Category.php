<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['image', 'title', 'title_seo', 'introduce', 'content', 'status', 'author', 'user_id'];
}
