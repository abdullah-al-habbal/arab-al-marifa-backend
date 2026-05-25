<?php

declare(strict_types=1);

namespace Modules\CourseType\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\EducationalSubStage\Models\EducationalSubStage;

class CourseType extends Model
{
    protected $fillable = [
        'sub_stage_id',
        'name',
        'academic_year',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function subStage(): BelongsTo
    {
        return $this->belongsTo(EducationalSubStage::class);
    }
}
