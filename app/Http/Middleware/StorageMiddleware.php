<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class StorageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (function_exists('symlink')) {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
        } else {
            File::copyDirectory(storage_path('app/public'), public_path('storage'));
        }
        return $next($request);
    }
}
