<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    public function user(): BelongsTo

    {

        return $this->belongsTo(User::class);

    }

    public function data(): HasMany
    {
        return $this->hasMany(CourseData::class);
    }
    protected $fillable = [

        'data',
        'image',
        'title',
        'short_data',

    ];
}
