<!-- Pastikan Alpine.js sudah ditambahkan -->
<!-- <script src="//unpkg.com/alpinejs" defer></script> -->

<div class="container mx-auto py-10 px-4 max-w-3xl" 
     x-data="{ showFileName: false, fileName: '' }" 
     x-init="$watch('fileName', () => { 
        showFileName = false; 
        setTimeout(() => showFileName = true, 500); 
     })">

    <h2 class="text-3xl font-bold text-blue-600 mb-3">{{ $tugas->judul }}</h2>
    <p class="text-base text-gray-700 mb-8">{{ $tugas->deskripsi }}</p>

    @if (session()->has('success'))
        <div class="mb-6 relative flex items-center bg-green-100 text-green-800 px-4 py-3 rounded-md shadow">
            <i class="bi bi-check-circle-fill mr-2 text-lg"></i>
            <span>{{ session('success') }}</span>
            <button type="button" 
                    class="absolute right-3 top-3 text-green-700 hover:text-green-900" 
                    onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg text-sm"></i>
            </button>
        </div>
    @endif

    @if ($hasilTugas)
        <div class="bg-blue-100 text-blue-800 px-5 py-4 rounded-md shadow mb-6">
            <p class="font-semibold mb-2">📂 Tugas sudah dikumpulkan</p>
            <p class="flex items-center gap-2 text-sm mb-4">
                <i class="bi bi-file-earmark-text-fill"></i>
                <a href="{{ asset('storage/' . $hasilTugas->file_tugas) }}" 
                   target="_blank" 
                   class="hover:underline text-blue-700 font-medium">
                    Lihat File Tugas
                </a>
            </p>
        </div>
    @else
        <form wire:submit.prevent="submit" class="space-y-6" enctype="multipart/form-data">
            <div>
                <label for="fileTugas" class="block mb-2 text-gray-700 font-medium">Upload File Tugas</label>
                <input 
                    type="file"
                    id="fileTugas"
                    wire:model="file_tugas"
                    @change="fileName = $event.target.files[0]?.name || ''"
                    accept=".pdf,.doc,.docx,.zip,.rar"
                    class="w-full p-2 border rounded-md border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('file_tugas') border-red-500 @enderror"
                >
                <p class="mt-1 text-sm text-gray-500">Format: PDF, DOC, DOCX, ZIP, RAR. Maksimal 10MB.</p>

                <!-- Loading -->
                <div class="text-sm text-gray-600 mt-2 flex items-center gap-1" wire:loading wire:target="file_tugas">
                    <i class="bi bi-arrow-repeat animate-spin text-base"></i> Memproses file...
                </div>

                <!-- File Name Feedback -->
                <template x-if="showFileName">
                    <p class="mt-2 text-sm text-blue-600 font-medium transition duration-300 ease-in-out" x-text="`File dipilih: ${fileName}`"></p>
                </template>

                @error('file_tugas')
                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex items-center gap-4">
                <button 
                    type="submit" 
                    wire:loading.remove 
                    wire:target="file_tugas, submit"
                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-md shadow transition">
                    <i class="bi bi-upload mr-2 text-lg"></i> Kumpulkan Tugas
                </button>

                <!-- Loading Submit -->
                <div 
                    wire:loading 
                    wire:target="file_tugas, submit"
                    class="inline-flex items-center bg-gray-300 text-gray-700 font-semibold py-2 px-5 rounded-md shadow">
                    <i class="bi bi-arrow-repeat animate-spin mr-2 text-lg"></i> Mengunggah...
                </div>
            </div>
        </form>
    @endif

    <!-- Tombol Kembali ke Dashboard -->
    <div class="mt-10">
        <a href="{{ route('siswa.dashboard') }}" 
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-md shadow transition">
           <i class="bi bi-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
