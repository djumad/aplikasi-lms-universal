<?php

use App\Livewire\ChatGemini;
use App\Livewire\MateriDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Beranda;
use App\Livewire\Login;
use App\Livewire\SiswaDashboard;
use App\Livewire\TugasDetail;
use App\Livewire\UjianDetail;
use App\Livewire\UjianMulai;
use Illuminate\Support\Facades\Auth;

Route::get('/', Beranda::class);

Route::redirect('/admin/login', '/login');


Route::get('/login' , Login::class)->name('login');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');


Route::middleware(['auth', RoleMiddleware::class . ':admin,guru'])->prefix('admin')->group(function () {

});


Route::middleware(['auth', RoleMiddleware::class . ':siswa'])->group(function () {
    Route::get('/dashboard/siswa', SiswaDashboard::class);
    Route::get('/dashboard/{tugas}' , TugasDetail::class)->name('tugas.detail');
    Route::get('/dashboard/siswa/ujian/{ujian}', UjianDetail::class)->name('ujian.detail');
    Route::get('/dashboard/siswa/ujian/{ujian}/mulai-ujian' , UjianMulai::class)->name('ujian.mulai');
    Route::get('/dashboard/siswa/materi/{materi}' , MateriDetail::class)->name('materi.detail');
    Route::get('/dashboard/siswa/ai' , ChatGemini::class)->name('ai.gemini');
});

