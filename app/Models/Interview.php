<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    protected $fillable = ['user_id', 'job_title', 'questions', 'score', 'answer', 'ideal_answer'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
