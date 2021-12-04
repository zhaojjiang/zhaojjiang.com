<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentTag extends Model
{
    protected $table = 'content_tags';
    protected $guarded = ['id'];
    public $timestamps = false;
}
