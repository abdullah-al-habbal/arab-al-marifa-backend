<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Lesson\Models\Lesson;
use Modules\Student\Models\Student;
use Modules\Teacher\Models\Teacher;

final class ConversationChannel extends Model
{
    protected $fillable = [
        'lesson_id',
        'student_id',
        'teacher_id',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
