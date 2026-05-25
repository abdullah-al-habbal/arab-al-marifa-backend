<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\EducationalStage\Models\EducationalStage;

class EducationalSubStage extends Model
{
    protected $fillable = [
        'stage_id',
        'name',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(EducationalStage::class);
    }
}
