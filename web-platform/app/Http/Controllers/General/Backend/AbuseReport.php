<?php

namespace App\Http\Controllers;

use App\Models\AbuseReport;
use App\Models\Asset;
use App\Models\User;
use DOMDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AbuseReportController extends Controller
{
    private const REPORT_TYPES = [
        'Swearing',
        'Bullying',
        'Dating',
        'Scamming',
        'Personal Information',
        'Offsite Links',
        'Cheating/Exploiting',
        'Inappropriate Content',
        'Other',
    ];

    private const SUBJECT_LABELS = [
        'asset' => 'Asset',
        'comment' => 'Comment',
        'feed' => 'Feed',
        'message' => 'Message',
        'userprofile' => 'User Profile',
        'user' => 'User',
        'group' => 'Group',
        'groupstatus' => 'Group Status',
        'grouproleset' => 'Group Role Set',
        'groupwallpost' => 'Group Wall Post',
        'forumpost' => 'Forum Post',
    ];

    public function create(Request $request, string $subject): View|RedirectResponse
    {
        if (! $request->user()) {
            return redirect('/login');
        }

        $subjectKey = strtolower($subject);
        $targetId = (int) $request->query('id', $request->query('ID', 0));
        if ($targetId <= 0) {
            abort(404);
        }

        return view('abusereport.create', [
            'subject' => $subjectKey,
            'subjectLabel' => self::SUBJECT_LABELS[$subjectKey] ?? ucfirst($subjectKey),
            'targetId' => $targetId,
            'redirectUrl' => $this->safeRedirectUrl($request),
            'reportTypes' => self::REPORT_TYPES,
            'targetName' => $this->targetName($subjectKey, $targetId),
        ]);
    }

    public function store(Request $request, string $subject): RedirectResponse
    {
        $user = $request->user();
        if (! $user) {
            return redirect('/login');
        }

        $request->merge([
            'target_id' => $request->input('target_id', $request->query('id', $request->query('ID'))),
        ]);

        $validated = $request->validate([
            'target_id' => ['required', 'integer', 'min:1'],
            'report_type' => ['required', Rule::in(self::REPORT_TYPES)],
            'comment' => ['nullable', 'string', 'max:1000'],
            'redirectUrl' => ['nullable', 'string', 'max:2048'],
        ]);

        $subjectKey = strtolower($subject);
        $targetId = (int) $validated['target_id'];
        $placeId = $subjectKey === 'asset' && Asset::query()->whereKey($targetId)->where('type', Asset::TYPE_PLACE)->exists()
            ? $targetId
            : 0;
        $abuserId = in_array($subjectKey, ['user', 'userprofile'], true) ? $targetId : 0;
        $comment = sprintf(
            'AbuserID:%d;%s;%s',
            $abuserId,
            $validated['report_type'],
            trim((string) ($validated['comment'] ?? '')),
        );
        $rawXml = sprintf(
            '<report userID="%d" placeID="%d" gameJobID=""><comment>%s</comment><subject type="%s" id="%d" /></report>',
            $user->id,
            $placeId,
            htmlspecialchars($comment, ENT_XML1),
            htmlspecialchars($subjectKey, ENT_XML1),
            $targetId,
        );

        try {
            AbuseReport::create([
                'UserId' => $user->id,
                'PlaceId' => $placeId,
                'JobId' => '',
                'Comment' => $comment,
                'Messages' => '[]',
                'RawXML' => $rawXml,
                'CreatedAt' => now(),
            ]);
        } catch (\Throwable $e) {
            \Log::error('Web abuse report insert failed', [
                'subject' => $subjectKey,
                'target_id' => $targetId,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['report' => 'Unable to submit your report right now. Please try again later.']);
        }

        return redirect($this->safeRedirectValue((string) ($validated['redirectUrl'] ?? '')))
            ->with('status', 'Thanks, your report has been submitted.');
    }

    public function inGameChat(Request $request): Response
    {
        $rawXml = trim($request->getContent());
        if ($rawXml === '') {
            $rawXml = trim((string) ($request->input('xml') ?? $request->input('report') ?? ''));
        }

        if ($rawXml === '') {
            return response('No payload received.', 400);
        }

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $loaded = $dom->loadXML($rawXml, LIBXML_NONET | LIBXML_NOBLANKS);
        libxml_clear_errors();

        if (! $loaded) {
            return response('Malformed XML.', 400);
        }

        $report = $dom->getElementsByTagName('report')->item(0);
        if (! $report) {
            return response('Missing <report> root node.', 400);
        }

        $userId = (int) $this->xmlAttribute($report, ['userID', 'userId', 'userid', 'UserID', 'UserId']);
        $placeId = max(0, (int) $this->xmlAttribute($report, ['placeID', 'placeId', 'placeid', 'PlaceID', 'PlaceId'], '0'));
        $jobId = substr(trim($this->xmlAttribute($report, ['gameJobID', 'gameJobId', 'gamejobid', 'jobID', 'jobId', 'JobID', 'JobId'], '')), 0, 64);
        $commentNode = $report->getElementsByTagName('comment')->item(0);
        $comment = $commentNode ? substr(trim($commentNode->textContent), 0, 1000) : '';

        if ($userId <= 0) {
            return response('Invalid report payload.', 422);
        }

        $messages = [];
        $messagesNode = $report->getElementsByTagName('messages')->item(0);
        if ($messagesNode) {
            foreach ($messagesNode->getElementsByTagName('message') as $messageNode) {
                $messages[] = [
                    'userID' => (int) $messageNode->getAttribute('userID'),
                    'guid' => substr((string) $messageNode->getAttribute('guid'), 0, 64),
                    'text' => substr(trim($messageNode->textContent), 0, 1000),
                ];
            }
        }

        try {
            AbuseReport::create([
                'UserId' => $userId,
                'PlaceId' => $placeId,
                'JobId' => $jobId,
                'Comment' => $comment,
                'Messages' => json_encode($messages, JSON_UNESCAPED_UNICODE),
                'RawXML' => $rawXml,
                'CreatedAt' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('In-game abuse report insert failed', [
                'user_id' => $userId,
                'place_id' => $placeId,
                'job_id' => $jobId,
                'error' => $e->getMessage(),
            ]);

            return response('Unable to log report.', 500);
        }

        return response('Report logged.');
    }

    private function xmlAttribute(\DOMElement $element, array $names, string $default = ''): string
    {
        foreach ($names as $name) {
            if ($element->hasAttribute($name)) {
                return (string) $element->getAttribute($name);
            }
        }

        return $default;
    }

    private function targetName(string $subject, int $targetId): ?string
    {
        if (in_array($subject, ['user', 'userprofile'], true)) {
            return User::query()->whereKey($targetId)->value('username');
        }

        if ($subject === 'asset') {
            return Asset::query()->whereKey($targetId)->value('name');
        }

        return null;
    }

    private function safeRedirectUrl(Request $request): string
    {
        return $this->safeRedirectValue((string) $request->query('redirectUrl', $request->query('RedirectUrl', '/')));
    }

    private function safeRedirectValue(string $redirectUrl): string
    {
        if ($redirectUrl === '' || str_starts_with($redirectUrl, '//') || preg_match('#^[a-z][a-z0-9+.-]*:#i', $redirectUrl)) {
            return '/';
        }

        return str_starts_with($redirectUrl, '/') ? $redirectUrl : '/'.ltrim($redirectUrl, '/');
    }
}
