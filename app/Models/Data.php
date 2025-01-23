<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
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
