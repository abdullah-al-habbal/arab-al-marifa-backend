<?php

declare(strict_types=1);

namespace Modules\Lesson\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SubjectCategory\Models\SubjectCategory;
use Modules\Teacher\Models\Teacher;

final class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject_category_id',
        'teacher_id',
        'title',
        'description',
        'unit_tag',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function subjectCategory(): BelongsTo
    {
        return $this->belongsTo(SubjectCategory::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
