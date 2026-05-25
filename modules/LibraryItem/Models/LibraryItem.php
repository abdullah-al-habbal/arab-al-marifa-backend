<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class LibraryItem extends Model
{
    protected $fillable = [
        'title',
        'item_type',
        'storage_path',
        'file_size_bytes',
        'mime_type',
        'classifiable_type',
        'classifiable_id',
        'is_downloadable',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_downloadable' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function classifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
