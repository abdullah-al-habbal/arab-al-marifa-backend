<?php

declare(strict_types=1);

namespace Modules\Unit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Subject\Models\Subject;

final class Unit extends Model
{
    protected $fillable = [
        'name',
        'subject_id',
        'sort_order',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
