<div class="max-w-3xl mx-auto px-6 py-12 bg-white shadow-xl rounded-2xl">
    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('siswa.dashboard') }}"
            class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 font-medium transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    {{-- Notifikasi dari Middleware --}}
    @if (session('message'))
        <div class="mb-6 flex items-start gap-3 rounded-lg bg-yellow-50 border border-yellow-200 px-4 py-3 text-yellow-800 shadow-sm">
            <svg class="w-5 h-5 mt-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.602c.75 1.336-.213 3.006-1.742 3.006H3.48c-1.528 0-2.492-1.67-1.742-3.006L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-.25-4a.75.75 0 00-1.5 0v2a.75.75 0 001.5 0V9z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <div class="mb-8">
        <h2 class="text-4xl font-extrabold text-blue-700 mb-2">{{ $ujian->judul }}</h2>
        <p class="text-gray-600 text-base">{{ $ujian->deskripsi }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
        <div>
            <h4 class="text-sm text-gray-500 font-semibold uppercase mb-1">🕒 Waktu Ujian</h4>
            <div class="text-gray-800">
                {{ \Carbon\Carbon::parse($ujian->jam_mulai)->format('d M Y, H:i') }} – 
                {{ \Carbon\Carbon::parse($ujian->jam_selesai)->format('H:i') }}
            </div>
        </div>
        <div>
            <h4 class="text-sm text-gray-500 font-semibold uppercase mb-1">🏫 Untuk Kelas</h4>
            <div class="flex flex-wrap gap-2 mt-1">
                @foreach ($ujian->kelas->whereIn('id', auth()->user()->kelas->pluck('id')) as $kelas)
                    <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full shadow">
                        {{ $kelas->nama }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <hr class="my-8 border-gray-200">

    <div class="text-center">
        <a href="{{ route('ujian.mulai', $ujian->id) }}"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm md:text-base px-6 py-3 rounded-full shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 16 16">
                <path
                    d="M6.79 11.093V4.907c0-.675.74-1.094 1.312-.757l4.368 3.093a.894.894 0 010 1.514l-4.368 3.093c-.572.337-1.312-.082-1.312-.757z" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1116 0A8 8 0 010 8zm1.5 0a6.5 6.5 0 1113 0A6.5 6.5 0 011.5 8z"
                    clip-rule="evenodd" />
            </svg>
            Mulai Ujian
        </a>
    </div>
</div>
