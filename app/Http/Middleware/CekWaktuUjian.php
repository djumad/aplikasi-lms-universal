<?php

namespace App\Http\Middleware;

use App\Models\Ujian;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CekWaktuUjian
{
    public function handle(Request $request, Closure $next)
    {
        $ujianId = $request->route('ujian'); // ambil parameter dari route
        $ujian = Ujian::find($ujianId);

        if (!$ujian) {
            abort(404, 'Ujian tidak ditemukan.');
        }

        $now = Carbon::now();

        // Misal jam_mulai dan jam_selesai disimpan dalam database berupa waktu saja,
        // kita gabungkan tanggal ujian dengan waktu mulai dan selesai:
        // Jika jam_mulai dan jam_selesai adalah string waktu saja (HH:mm:ss), 
        // dan ujian ada kolom tanggal_ujian, maka:
        if (isset($ujian->tanggal_ujian)) {
            $start = Carbon::parse($ujian->tanggal_ujian . ' ' . $ujian->jam_mulai);
            $end = Carbon::parse($ujian->tanggal_ujian . ' ' . $ujian->jam_selesai);
        } else {
            // Jika jam_mulai dan jam_selesai adalah datetime lengkap, langsung parse:
            $start = Carbon::parse($ujian->jam_mulai);
            $end = Carbon::parse($ujian->jam_selesai);
        }

        // Cek jika sekarang belum waktunya ujian
        if ($now->lt($start)) {
            return redirect()->route('ujian.detail', $ujianId)
                ->with('message', "Ujian mulai pada " . $start->format('d M Y H:i'));
        }

        // Cek jika sudah lewat waktu ujian
        if ($now->gt($end)) {
            return redirect()->route('ujian.detail', $ujianId)
                ->with('message', "Ujian selesai pada " . $end->format('d M Y H:i'));
        }

        // Jika sudah dalam rentang waktu ujian, lanjut request
        return $next($request);
    }
}
