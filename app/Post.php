<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    protected $fillable = ['image', 'title', 'title_seo', 'introduce', 'content', 'status', 'author', 'user_id', 'categoty_id', 'slide'];
}
