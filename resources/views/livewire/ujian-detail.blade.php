<div class="max-w-3xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-blue-600 mb-4">{{ $ujian->judul }}</h2>
    <p class="text-gray-700 text-base mb-6">{{ $ujian->deskripsi }}</p>

    <div class="mb-5">
        <h4 class="text-sm font-semibold text-gray-600">🕒 Waktu Ujian</h4>
        <p class="text-gray-500 mt-1">
            {{ \Carbon\Carbon::parse($ujian->jam_mulai)->format('d M Y, H:i') }} - 
            {{ \Carbon\Carbon::parse($ujian->jam_selesai)->format('H:i') }}
        </p>
    </div>

    <div class="mb-6">
        <h4 class="text-sm font-semibold text-gray-600">🏫 Untuk Kelas</h4>
        <div class="flex flex-wrap gap-2 mt-2">
            @foreach ($ujian->kelas->whereIn('id', auth()->user()->kelas->pluck('id')) as $kelas)
                <span class="bg-blue-100 text-blue-700 text-sm font-medium px-3 py-1 rounded-full shadow-sm">
                    {{ $kelas->nama }}
                </span>
            @endforeach
        </div>
    </div>

    <hr class="my-8 border-t border-gray-200">

    <a href="{{ route('ujian.mulai', $ujian->id) }}"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 rounded-lg shadow-md transition">
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
