<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title, '-');

                // Ensure the slug is unique
                $originalSlug = $gallery->slug;
                $count = 1;
                while (static::where('slug', $gallery->slug)->where('id', '!=', $gallery->id)->exists()) {
                    $gallery->slug = "{$originalSlug}-" . $count++;
                }
            }
        });
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
