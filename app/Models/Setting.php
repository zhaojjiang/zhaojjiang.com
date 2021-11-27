<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'settings';
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function get($key, $default = null)
    {
        return Cache::remember("settings:$key", 86400, function () use ($key, $default) {
            $model = self::query()->select('value')->where('key', $key)->first();
            return $model ? $model->value : $default;
        });
    }
}
