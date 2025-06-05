<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <!-- Header with back button and title -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-4 flex items-center justify-between">
        <a href="{{ url()->previous() }}" class="text-white hover:text-blue-200 transition flex items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span class="hidden sm:inline">Kembali</span>
        </a>
        <h1 class="text-xl md:text-2xl font-bold text-white text-center flex-1">{{ $materi->judul }}</h1>
        <div class="w-6"></div> <!-- Spacer for balance -->
    </div>

    <!-- Content area -->
    <div class="p-6 md:p-8">
        <!-- Metadata -->
        <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <i class="bi bi-person-circle"></i>
                <span>Dibuat oleh: {{ $materi->user->name ?? 'Admin' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="bi bi-calendar"></i>
                <span>Diunggah: {{ $materi->created_at->translatedFormat('d F Y') }}</span>
            </div>
            @if($materi->kelas->count() > 0)
            <div class="flex items-center gap-2">
                <i class="bi bi-people"></i>
                <span>
                    Kelas: 
                    @foreach($materi->kelas as $kelas)
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-md text-xs ml-1">{{ $kelas->nama }}</span>
                    @endforeach
                </span>
            </div>
            @endif
        </div>

        <!-- Content with improved typography -->
        <div class="prose max-w-none prose-blue prose-headings:font-semibold prose-p:text-gray-700 prose-li:marker:text-blue-500 prose-a:text-blue-600 hover:prose-a:text-blue-800 border-t pt-6">
            {!! nl2br(e($materi->deskripsi)) !!}
        </div>

        <!-- File attachment section -->
        @if ($materi->file)
        <div class="mt-8 border-t pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="bi bi-paperclip text-blue-500"></i>
                Lampiran Materi
            </h3>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 bg-blue-50 rounded-lg p-4 border border-blue-100">
                <div class="flex items-center justify-center bg-white p-3 rounded-lg border border-blue-200">
                    <i class="bi bi-file-earmark-text text-3xl text-blue-500"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800">{{ basename($materi->file) }}</h4>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ round(filesize(public_path('storage/' . $materi->file)) / 1024, 1) }} KB
                    </p>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <a href="{{ asset('storage/' . $materi->file) }}" 
                       target="_blank"
                       class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition whitespace-nowrap">
                        <i class="bi bi-eye"></i> Lihat
                    </a>
                    <a href="{{ asset('storage/' . $materi->file) }}" 
                       download
                       class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-blue-600 font-medium py-2 px-4 rounded border border-blue-200 transition whitespace-nowrap">
                        <i class="bi bi-download"></i> Unduh
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>