<div 
    x-data="{
        showModal: true,
        async enterFullscreen() {
            try {
                if (!document.fullscreenElement) {
                    await document.documentElement.requestFullscreen();
                }
                this.showModal = false;
            } catch(e) {
                alert('Gagal masuk fullscreen: ' + e.message);
            }
        }
    }" 

    x-init="
        document.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement) {
                window.location.href = '/dashboard/siswa/ujian/{{ $ujian->id }}';
            }
        });
    " 

    class="min-h-screen bg-white px-4 py-6 sm:px-8 md:px-16 relative"
>
    <!-- Modal Fullscreen -->
    <template x-if="showModal">
        <div
            class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg p-6 max-w-sm w-full text-center shadow-lg">
                <h2 class="text-xl font-bold mb-4 text-blue-600">Mulai Ujian</h2>
                <p class="mb-6">Klik tombol di bawah untuk masuk ke mode layar penuh dan mulai ujian.</p>
                <button 
                    @click="enterFullscreen()" 
                    class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold"
                >
                    Mulai Ujian
                </button>
            </div>
        </div>
    </template>

    <!-- Konten ujian -->
    <div x-show="!showModal" x-transition>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-blue-600">{{ $ujian->nama }}</h2>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4 shadow">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="simpanJawaban" class="space-y-8">
            {{-- Soal Pilihan Ganda --}}
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Soal Pilihan Ganda</h3>
                @foreach ($ujian->soalPilihanGanda as $soal)
                    <div class="mb-6 border p-4 rounded shadow-sm bg-gray-50">
                        <p class="mb-2 text-gray-800 font-medium">{{ $soal->pertanyaan['soal'] }}</p>
                        <div class="space-y-2">
                            @foreach (['a', 'b', 'c', 'd'] as $opsi)
                                @php $opsiData = $soal->{'opsi_'.$opsi} ?? []; @endphp
                                <label class="flex items-start space-x-2">
                                    <input
                                        type="radio"
                                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300"
                                        name="pg_{{ $soal->id }}"
                                        wire:model="jawabanPg.{{ $soal->id }}"
                                        value="{{ $opsiData['nilai'] ?? 0 }}">
                                    <span class="text-gray-700">
                                        <strong>{{ strtoupper($opsi) }}.</strong> {{ $opsiData['teks'] ?? '' }}
                                        @if (!empty($opsiData['gambar']))
                                            <img src="{{ asset('storage/' . $opsiData['gambar']) }}"
                                                 class="mt-2 max-h-40 border rounded"
                                                 alt="Opsi {{ strtoupper($opsi) }}">
                                        @endif
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Soal Esai --}}
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Soal Esai</h3>
                @foreach ($ujian->soalEsai as $soal)
                    <div class="mb-6 border p-4 rounded shadow-sm bg-gray-50">
                        <p class="mb-2 text-gray-800 font-medium">{{ $soal->pertanyaan }}</p>
                        @if ($soal->foto)
                            <img src="{{ asset('storage/' . $soal->foto) }}"
                                 class="mb-3 max-h-48 border rounded"
                                 alt="Gambar soal esai" />
                        @endif
                        <textarea wire:model.defer="jawabanEsai.{{ $soal->id }}"
                                  rows="4"
                                  class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Tulis jawaban Anda di sini..."></textarea>
                    </div>
                @endforeach
            </div>

            <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow">
                <i class="bi bi-send-check me-1"></i> Kumpulkan
            </button>
        </form>
    </div>
</div>
