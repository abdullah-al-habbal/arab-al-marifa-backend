<?php

declare(strict_types=1);

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Subject\Models\Subject;
use Modules\User\Models\User;

final class Exam extends Model
{
    protected $fillable = [
        'title',
        'subject_id',
        'question_count',
        'passing_score_percent',
        'time_limit_minutes',
        'unit_tags_filter',
        'lesson_ids_filter',
        'generation_strategy',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'unit_tags_filter' => 'array',
            'lesson_ids_filter' => 'array',
        ];
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
