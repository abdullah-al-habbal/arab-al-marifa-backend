<?php

declare(strict_types=1);

namespace Modules\Question\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\QuestionBank\Models\QuestionBank;

final class Question extends Model
{
    protected $fillable = [
        'question_bank_id',
        'body',
        'sort_order',
    ];

    public function questionBank(): BelongsTo
    {
        return $this->belongsTo(QuestionBank::class);
    }
}
