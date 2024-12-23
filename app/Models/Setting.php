<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['threshold', 'pump_status'];

    // متد first
    public static function first()
    {
        return self::query()->first();
    }

    // متد create
    public static function create(array $attributes)
    {
        $instance = new self();
        $instance->fill($attributes);
        $instance->save();
        return $instance;
    }
}
