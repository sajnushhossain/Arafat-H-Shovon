<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
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
        static::saving(function ($achievement) {
            if (empty($achievement->slug)) {
                $achievement->slug = Str::slug($achievement->title, '-');

                // Ensure the slug is unique
                $originalSlug = $achievement->slug;
                $count = 1;
                while (static::where('slug', $achievement->slug)->where('id', '!=', $achievement->id)->exists()) {
                    $achievement->slug = "{$originalSlug}-" . $count++;
                }
            }
        });
    }
}
