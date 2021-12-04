<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function contents()
    {
        return $this->hasManyThrough(Content::class, ContentTag::class,
            'tag_id', 'id', 'id', 'content_id');
    }
}
