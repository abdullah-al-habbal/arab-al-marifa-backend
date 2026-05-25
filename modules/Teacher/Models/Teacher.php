<?php

declare(strict_types=1);

namespace Modules\Teacher\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Models\User;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'profile_photo_path',
        'specialization',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
