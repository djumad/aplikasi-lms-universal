<div class="py-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">

        <!-- Header with User Info -->
        <div class="text-center mb-12 bg-white rounded-xl shadow-sm p-6 max-w-4xl mx-auto">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-6">
                <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="bi bi-person-fill text-blue-600 text-4xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-1">Selamat Datang, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-600">Siswa Kelas 
                        @foreach(auth()->user()->kelas as $kelas)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-md text-sm">{{ $kelas->nama }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-600 font-medium">Tugas Aktif</h3>
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-bold">{{ $tugas->count() }}</span>
                    </div>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-600 font-medium">Materi Tersedia</h3>
                        <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-sm font-bold">{{ $materi->count() }}</span>
                    </div>
                </div>
                <div class="bg-cyan-50 p-4 rounded-lg border border-cyan-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-600 font-medium">Ujian Mendatang</h3>
                        <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-sm font-bold">{{ $ujian->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Tugas -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Tugas Section -->
                <section class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-500">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <i class="bi bi-journal-text"></i>
                            Tugas Terbaru
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($tugas->count() > 0)
                            <div class="space-y-4">
                                @foreach ($tugas->take(4) as $item)
                                <div class="border border-gray-200 rounded-lg p-5 hover:border-blue-300 transition-all duration-200">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-blue-100 p-3 rounded-lg">
                                            <i class="bi bi-journal-text text-blue-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $item->judul }}</h3>
                                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Batas: {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item->deskripsi, 120) }}</p>
                                            <div class="flex justify-between items-center">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($item->kelas->whereIn('id', auth()->user()->kelas->pluck('id')) as $kelas)
                                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $kelas->nama }}</span>
                                                    @endforeach
                                                </div>
                                                <a href="{{ route('tugas.detail', $item->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                                    <i class="bi bi-arrow-right"></i> Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($tugas->count() > 4)
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat semua tugas ({{ $tugas->count() }})</a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <i class="bi bi-journal-x text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Belum ada tugas untuk kelas Anda</p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Ujian Section -->
                <section class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-cyan-600 to-cyan-500">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <i class="bi bi-pencil-square"></i>
                            Ujian Mendatang
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($ujian->count() > 0)
                            <div class="space-y-4">
                                @foreach ($ujian->take(3) as $item)
                                <div class="border border-gray-200 rounded-lg p-5 hover:border-cyan-300 transition-all duration-200">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-cyan-100 p-3 rounded-lg">
                                            <i class="bi bi-clock text-cyan-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $item->judul }}</h3>
                                                <span class="text-xs bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item->deskripsi, 100) }}</p>
                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded flex items-center gap-1">
                                                        <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                                    </span>
                                                    @foreach ($item->kelas->whereIn('id', auth()->user()->kelas->pluck('id')) as $kelas)
                                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $kelas->nama }}</span>
                                                    @endforeach
                                                </div>
                                                <a href="{{ route('ujian.detail', $item->id) }}" class="text-sm font-medium text-cyan-600 hover:text-cyan-800 flex items-center gap-1">
                                                    <i class="bi bi-arrow-right"></i> Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($ujian->count() > 3)
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-cyan-600 hover:text-cyan-800 text-sm font-medium">Lihat semua ujian ({{ $ujian->count() }})</a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <i class="bi bi-calendar-x text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Tidak ada ujian mendatang</p>
                            </div>
                        @endif
                    </div>
                </section>
            </div>

            <!-- Right Column - Materi and Quick Links -->
            <div class="space-y-8">
                <!-- Materi Section -->
                <section class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <i class="bi bi-book"></i>
                            Materi Pembelajaran
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($materi->count() > 0)
                            <div class="space-y-4">
                                @foreach ($materi->take(5) as $item)
                                <div class="group flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                                    <div class="bg-indigo-100 p-2 rounded-lg group-hover:bg-indigo-200 transition-colors duration-200">
                                        <i class="bi bi-file-earmark-text text-indigo-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-medium text-gray-800 truncate">{{ $item->judul }}</h3>
                                        <p class="text-xs text-gray-500">Diunggah {{ $item->created_at->diffForHumans() }}</p>
                                    </div>
                                    <a href="{{ route('materi.detail', $item->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @if($materi->count() > 5)
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Lihat semua materi ({{ $materi->count() }})</a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <i class="bi bi-book text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Belum ada materi tersedia</p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Quick Links -->
                <!-- <section class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-500">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <i class="bi bi-lightning-charge"></i>
                            Akses Cepat
                        </h2>
                    </div>
                    <div class="p-6 grid grid-cols-2 gap-3">
                        <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-full mb-2">
                                <i class="bi bi-calendar-check text-purple-600 text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Jadwal</span>
                        </a>
                        <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-full mb-2">
                                <i class="bi bi-graph-up text-purple-600 text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Nilai</span>
                        </a>
                        <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-full mb-2">
                                <i class="bi bi-chat-left-text text-purple-600 text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Forum</span>
                        </a>
                        <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-full mb-2">
                                <i class="bi bi-gear text-purple-600 text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Pengaturan</span>
                        </a>
                    </div>
                </section> -->

                <!-- Calendar Widget -->
                <section class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-green-600 to-green-500">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <i class="bi bi-calendar-date"></i>
                            Kalender
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <span class="font-medium text-gray-800">Juni 2023</span>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-gray-500 mb-2">
                            <div>M</div>
                            <div>S</div>
                            <div>S</div>
                            <div>R</div>
                            <div>K</div>
                            <div>J</div>
                            <div>S</div>
                        </div>
                        <div class="grid grid-cols-7 gap-1">
                            @foreach(range(1, 30) as $day)
                                <div class="h-8 flex items-center justify-center text-sm rounded-full 
                                    {{ $day == date('j') ? 'bg-green-100 text-green-800 font-bold' : 'hover:bg-gray-100' }}">
                                    {{ $day }}
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span class="text-xs text-gray-600">Tugas Deadline</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="text-xs text-gray-600">Ujian</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>