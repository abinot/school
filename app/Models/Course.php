<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function user(): BelongsTo

    {

        return $this->belongsTo(User::class);

    }
    protected $fillable = [

        'data',
        'image',
        'title'

    ];
}
