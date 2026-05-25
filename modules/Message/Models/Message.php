<?php

declare(strict_types=1);

namespace Modules\Message\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\ConversationChannel\Models\ConversationChannel;
use Modules\User\Models\User;

final class Message extends Model
{
    protected $fillable = [
        'channel_id',
        'sender_id',
        'sender_type',
        'message_type',
        'body',
        'attachment_path',
        'attachment_mime_type',
        'attachment_size_bytes',
        'sent_at',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'read_at' => 'datetime',
        ];
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(ConversationChannel::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
