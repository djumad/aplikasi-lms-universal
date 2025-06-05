<!-- Tambahkan Alpine.js di <head> jika belum -->
<!-- <script src="//unpkg.com/alpinejs" defer></script> -->

<div class="container mx-auto py-10 px-4 max-w-3xl" x-data="{ showFileName: false, fileName: '' }" x-init="
    $watch('fileName', () => {
        showFileName = false;
        setTimeout(() => showFileName = true, 1500);
    })
">
    <h2 class="mb-6 text-3xl font-bold text-blue-600">{{ $tugas->judul }}</h2>
    <p class="text-base text-gray-700 mb-8">{{ $tugas->deskripsi }}</p>

    @if (session()->has('success'))
        <div class="mb-6 flex items-center bg-green-100 text-green-700 px-4 py-3 rounded-md shadow relative" role="alert">
            <i class="bi bi-check-circle-fill mr-2 text-green-600 text-lg"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="absolute right-2 top-2 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    @if ($hasilTugas)
        <div class="bg-blue-100 text-blue-700 px-5 py-4 rounded-md shadow mb-6">
            <p class="font-semibold mb-2">Tugas sudah dikumpulkan.</p>
            <p>
                File:
                <a 
                    href="{{ asset('storage/' . $hasilTugas->file_tugas) }}" 
                    target="_blank" 
                    class="inline-flex items-center text-blue-600 hover:underline"
                >
                    <i class="bi bi-file-earmark-text-fill mr-2"></i>Lihat Tugas
                </a>
            </p>
        </div>
    @else
        <form wire:submit.prevent="submit" class="space-y-5" enctype="multipart/form-data">
            <div>
                <label for="fileTugas" class="block mb-2 font-semibold text-gray-700">Upload File Tugas</label>
                <input 
                    type="file"
                    id="fileTugas"
                    wire:model="file_tugas"
                    @change="fileName = $event.target.files[0]?.name || ''"
                    accept=".pdf,.doc,.docx,.zip,.rar"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_tugas') border-red-500 @enderror"
                >
                <p class="mt-1 text-sm text-gray-500">Format file: PDF, DOC, DOCX, ZIP, RAR. Maks 10MB.</p>

                <!-- Loading indicator -->
                <div class="text-sm text-gray-600 mt-2" wire:loading wire:target="file_tugas">
                    <i class="bi bi-arrow-repeat animate-spin mr-1"></i> Sedang memuat file...
                </div>

                <!-- Nama file ditampilkan setelah delay -->
                <template x-if="showFileName">
                    <p class="mt-2 text-sm text-blue-600" x-text="`File dipilih: ${fileName}`"></p>
                </template>

                @error('file_tugas')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol hanya muncul jika tidak sedang loading -->
<button 
    type="submit" 
    wire:loading.remove 
    wire:target="file_tugas, submit"
    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition"
>
    <i class="bi bi-upload mr-2 text-lg"></i> Kumpulkan Tugas
</button>

<!-- Indikator loading saat tombol hilang -->
<div 
    wire:loading 
    wire:target="file_tugas, submit"
    class="inline-flex items-center bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md transition"
>
    <i class="bi bi-arrow-repeat animate-spin mr-2 text-lg"></i> Mengunggah...
</div>

        </form>
    @endif
</div>
