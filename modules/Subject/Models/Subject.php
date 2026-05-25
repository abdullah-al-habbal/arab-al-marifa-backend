<?php

declare(strict_types=1);

namespace Modules\Subject\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CourseType\Models\CourseType;

final class Subject extends Model
{
    protected $fillable = [
        'course_type_id',
        'name',
        'description',
        'cover_image_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function courseType(): BelongsTo
    {
        return $this->belongsTo(CourseType::class);
    }
}
