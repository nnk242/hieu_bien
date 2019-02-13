<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['tag', 'tag_seo', 'status', 'type', 'post_id'];
}
