<?php

namespace App\Models;

use DOMDocument;
use Illuminate\Database\Eloquent\Model;

class AbuseReport extends Model
{
    protected $table = 'reports';
    public $timestamps = false;

    protected $fillable = [
        'UserId',
        'PlaceId',
        'JobId',
        'Comment',
        'Messages',
        'RawXML',
        'CreatedAt',
        'MarkAsResolved',
    ];

    protected $casts = [
        'UserId' => 'integer',
        'PlaceId' => 'integer',
        'MarkAsResolved' => 'boolean',
        'CreatedAt' => 'datetime',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'UserId');
    }

    public function place()
    {
        return $this->belongsTo(Asset::class, 'PlaceId');
    }

    public function parsedComment(): array
    {
        $parts = explode(';', (string) $this->Comment, 3);
        $abuserId = null;
        if (isset($parts[0]) && str_starts_with($parts[0], 'AbuserID:')) {
            $abuserId = (int) substr($parts[0], strlen('AbuserID:'));
        }

        return [
            'abuser_id' => $abuserId ?: null,
            'type' => trim($parts[1] ?? ''),
            'comment' => trim($parts[2] ?? ''),
        ];
    }

    public function subject(): array
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $loaded = $dom->loadXML((string) $this->RawXML, LIBXML_NONET | LIBXML_NOBLANKS);
        libxml_clear_errors();

        if ($loaded) {
            $subject = $dom->getElementsByTagName('subject')->item(0);
            if ($subject) {
                return [
                    'type' => strtolower((string) $subject->getAttribute('type')),
                    'id' => (int) $subject->getAttribute('id'),
                ];
            }
        }

        return [
            'type' => '',
            'id' => 0,
        ];
    }

    public function supportsContentDeletion(): bool
    {
        return in_array($this->subject()['type'], ['asset', 'feed', 'user', 'userprofile'], true);
    }

    public function messagesArray(): array
    {
        $messages = json_decode((string) $this->Messages, true);

        return is_array($messages) ? $messages : [];
    }
}
