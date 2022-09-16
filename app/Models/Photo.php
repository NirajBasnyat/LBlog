<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path','type'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            if(static::where('path', $photo->path)->exists()){
                \Storage::disk('public')->delete($photo->path);
            }
        });
    }

    public function photoable()
    {
        return $this->morphTo();
    }

}
