<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Lesson\Models\Lesson;

final class LessonAttachment extends Model
{
    protected $fillable = [
        'lesson_id',
        'storage_path',
        'original_filename',
        'file_size_bytes',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
