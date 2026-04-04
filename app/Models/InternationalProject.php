<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InternationalProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted()
    {
        static::saving(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title, '-');

                $originalSlug = $project->slug;
                $count = 1;
                while (static::where('slug', $project->slug)->where('id', '!=', $project->id)->exists()) {
                    $project->slug = "{$originalSlug}-" . $count++;
                }
            }
        });
    }

    public function photos()
    {
        return $this->hasMany(InternationalProjectPhoto::class);
    }
}
