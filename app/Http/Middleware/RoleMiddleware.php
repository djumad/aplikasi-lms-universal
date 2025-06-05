<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles  // roles yang diijinkan
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            // kalau belum login, redirect ke login
            return redirect('/login');
        }

        if (in_array($user->role, $roles)) {
            // user sesuai role, lanjut request
            return $next($request);
        }

        // Jika user siswa tapi akses admin, redirect ke dashboard siswa
        if ($user->role === 'siswa') {
            return redirect('/dashboard/siswa');
        }

        // Kalau role lain, bisa arahkan ke halaman lain atau forbidden
        abort(403, 'Unauthorized');
    }
}
