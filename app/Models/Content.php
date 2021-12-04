<?php

namespace App\Models;

use App\Enums\Visibility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{
    use SoftDeletes;
    protected $table = 'contents';
    protected $guarded = ['id'];

    public const TYPE_POST = 'post';
    public const TYPE_PAGE = 'page';
    public static $availableTypes = [
        self::TYPE_POST => self::TYPE_POST,
        self::TYPE_PAGE => self::TYPE_PAGE,
    ];

    protected static function booted()
    {
        parent::booted();
        if (!Auth::user()) {
            static::addGlobalScope('public', function (Builder $builder) {
                $builder->where('visibility', Visibility::PUBLIC);
            });
        }
    }

    public function scopeType(Builder $builder, $type)
    {
        $builder->where('type', $type);
    }

    public function tags()
    {
        return $this->hasManyThrough(Tag::class, ContentTag::class,
            'content_id', 'id', 'id', 'tag_id');
    }
}
