<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Question\Models\Question;

final class QuestionOption extends Model
{
    protected $fillable = [
        'question_id',
        'body',
        'sort_order',
        'is_correct',
    ];

    protected function casts(): array
    {
        return [
            'is_correct' => 'boolean',
        ];
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
