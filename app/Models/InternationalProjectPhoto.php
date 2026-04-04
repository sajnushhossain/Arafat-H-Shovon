<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalProjectPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'international_project_id',
        'title',
        'description',
        'file_path',
        'url',
    ];

    public function project()
    {
        return $this->belongsTo(InternationalProject::class, 'international_project_id');
    }
}
