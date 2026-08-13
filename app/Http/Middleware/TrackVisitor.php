<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    private const COOKIE_NAME = 'visitor_uuid';

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldTrack($request)) {
            return $response;
        }

        $visitorUuid = $request->cookie(self::COOKIE_NAME);

        if (! $visitorUuid || ! Str::isUuid($visitorUuid)) {
            $visitorUuid = (string) Str::uuid();
            $response->headers->setCookie(Cookie::make(self::COOKIE_NAME, $visitorUuid, 60 * 24 * 365 * 5));
        }

        $visit = Visit::firstOrCreate(
            [
                'visitor_uuid' => $visitorUuid,
                'visited_date' => now()->toDateString(),
            ],
            [
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
            ]
        );

        if ($visit->wasRecentlyCreated) {
            Cache::forget('footer.total_visitors');
            Cache::forget('footer.today_visitors');
        }

        return $response;
    }

    private function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('GET') || $request->ajax() || $request->wantsJson()) {
            return false;
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return false;
        }

        return true;
    }
}
