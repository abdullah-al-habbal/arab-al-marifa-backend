<?php

declare(strict_types=1);

namespace Modules\StaticPage\Models;

use Illuminate\Database\Eloquent\Model;

final class StaticPage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'is_published',
        'meta_title',
        'meta_description',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }
}
