<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SoilReading extends Model
{
    /**
     * @var float|mixed
     */
    
    protected $fillable = ['moisture'];

    // متد first
    public static function first()
    {
        return self::query()->first();
    }

    // متد latest
    public static function latest()
    {
        return self::orderBy('created_at', 'desc');
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
