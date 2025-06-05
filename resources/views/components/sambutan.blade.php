<div>
    <p class="text-center text-5xl font-extrabold">Kata Sambutan</p>

    <div class="min-h-screen flex items-center justify-center px-6 lg:px-20 py-10">
        <div class="flex flex-col lg:flex-row items-start gap-12 w-full max-w-6xl">

            {{-- Gambar di sebelah kiri --}}
            <div class="flex-1 flex justify-start">
                <img
                    src="{{ asset('storage/' . $settings->foto_kepala_sekolah) }}"
                    alt="Foto {{ $settings->nama_kepala_sekolah }}"
                    class="w-80 sm:w-96 md:w-[28rem] lg:w-[32rem] h-auto object-cover drop-shadow-lg rounded-lg"
                >
            </div>

            {{-- Teks di sebelah kanan --}}
            <div class="flex-1 space-y-6 text-left">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
                    {{ $settings->nama_kepala_sekolah }}
                </h2>
                <div class="text-lg text-gray-700 max-w-2xl prose prose-p:my-2">
                    {!! $settings->kata_sambutan !!}
                </div>
            </div>

        </div>
    </div>
</div>
