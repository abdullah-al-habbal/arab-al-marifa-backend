<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Lesson\Models\Lesson;
use Modules\Question\Models\Question;
use Modules\Question\Models\QuestionOption;
use Modules\Subject\Models\Subject;
use Modules\User\Models\User;

final class QuestionBank extends Model
{
    protected $fillable = [
        'subject_id',
        'lesson_id',
        'unit_tag',
        'stem',
        'question_type',
        'difficulty',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function options(): HasMany
    {
        return $this->hasMany(Question::class, 'question_id');
    }

    public function correctOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'correct_option_id');
    }
}
