<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response|RedirectResponse|null
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|null
    {
        if (!$request->user() || !$request->user()->is_admin) {
            abort(403, 'you ar not an admin.');
        }

        return $next($request);
    }
}
