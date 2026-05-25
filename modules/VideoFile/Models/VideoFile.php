<?php

declare(strict_types=1);

namespace Modules\VideoFile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Lesson\Models\Lesson;

final class VideoFile extends Model
{
    protected $fillable = [
        'lesson_id',
        'quality',
        'storage_path',
        'mime_type',
        'file_size_bytes',
        'duration_seconds',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
