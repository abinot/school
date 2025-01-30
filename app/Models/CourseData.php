<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseData extends Model
{
    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected $fillable = [

        'key',
        'value',
        'show',
        'added_by',
        'selected_user',
        'message',
        'massage',
    ];
}
