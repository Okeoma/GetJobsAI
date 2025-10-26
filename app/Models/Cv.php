<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cv extends Model
{
    protected $fillable = [
        'user_id',
        'original_cv_path',
        'optimized_cv_path',
        'score',
        'recommendation',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
