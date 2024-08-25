<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckApiToken
{
    protected $csrfVerifier;

    public function __construct(BaseVerifier $csrfVerifier)
    {
        $this->csrfVerifier = $csrfVerifier;
    }

    public function handle(Request $request, Closure $next)
    {
        // Log incoming request headers and data
        Log::info('CheckApiToken Middleware: Incoming request', [
            'headers' => $request->headers->all(),
            'data' => $request->all()
        ]);

        // Check if the user is authenticated
        if (!Auth::check()) {
            Log::warning('CheckApiToken Middleware: Unauthorized access attempt');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Verify CSRF token
        if ($this->isReading($request) || $this->tokensMatch($request)) {
            return $next($request);
        }

        Log::warning('CheckApiToken Middleware: CSRF token mismatch');
        return response()->json(['error' => 'CSRF token mismatch'], 419);
    }

    protected function isReading(Request $request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }

    protected function tokensMatch(Request $request)
    {
        return $this->csrfVerifier->tokensMatch($request);
    }
}
