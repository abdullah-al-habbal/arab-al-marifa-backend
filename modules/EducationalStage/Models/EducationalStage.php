<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalStage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
