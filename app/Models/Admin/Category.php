<?php

namespace App\Models\Admin;

use App\Models\Blog;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasPhoto, SoftDeletes;

    protected $fillable = ['name', 'description', 'is_active'];

    protected static function boot()
    {
        parent::boot();

        //saving works for both create and update
        static::saving(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function scopeSearch($query, $term): void
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', $term)
                ->orWhere('slug', 'LIKE', $term);
        });
    }

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }
}
