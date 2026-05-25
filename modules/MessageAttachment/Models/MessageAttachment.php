<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Message\Models\Message;

final class MessageAttachment extends Model
{
    protected $fillable = [
        'message_id',
        'attachment_path',
        'mime_type',
        'file_size_bytes',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
