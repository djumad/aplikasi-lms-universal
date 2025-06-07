<div class="min-h-screen px-5 lg:px-16 py-10 bg-gradient-to-br from-blue-50 via-cyan-100 to-indigo-100">
    <div class="max-w-6xl mx-auto">
        <!-- Judul -->
        <p class="text-center text-5xl font-extrabold text-blue-700 mb-2">Kata Sambutan</p>

        <div class="flex flex-col lg:flex-row items-start gap-12">
            <!-- Gambar di sebelah kiri -->
            <div class="flex-1 flex justify-center lg:justify-start">
                <div class="relative">
                    <!-- Blob animasi -->
                    <div class="absolute -top-6 -left-6 w-24 h-24 blob bg-blue-300 animate-blob blob-delay-0"></div>
                    <div class="absolute -bottom-8 -right-8 w-24 h-24 blob bg-cyan-300 animate-blob blob-delay-2000"></div>
                    <div class="absolute top-20 -right-4 w-24 h-24 blob bg-indigo-300 animate-blob blob-delay-4000"></div>

                    <img
                        src="{{ asset('storage/' . $settings->foto_kepala_sekolah) }}"
                        alt="Foto {{ $settings->nama_kepala_sekolah }}"
                        class="relative w-80 sm:w-96 md:w-[28rem] lg:w-[32rem] h-auto object-cover drop-shadow-xl rounded-xl border border-blue-100"
                    >
                </div>
            </div>

            <!-- Teks di sebelah kanan -->
            <div class="flex-1 text-left space-y-6">
                <h2 class="text-4xl md:text-5xl font-extrabold text-blue-800 leading-tight">
                    {{ $settings->nama_kepala_sekolah }}
                </h2>
                <div class="text-lg max-w-2xl prose prose-blue prose-p:text-gray-800 prose-strong:text-blue-800 prose-a:text-blue-600 hover:prose-a:text-blue-800 transition-all duration-300">
                    {!! $settings->kata_sambutan !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Animasi blob -->
    <style>
        @keyframes blob {
            0%, 100% {
                transform: translate(0px, 0px) scale(1);
                background-color: #93c5fd;
            }
            25% {
                transform: translate(20px, -30px) scale(1.05);
                background-color: #7dd3fc;
            }
            50% {
                transform: translate(-20px, 20px) scale(0.95);
                background-color: #a5b4fc;
            }
            75% {
                transform: translate(30px, 10px) scale(1.1);
                background-color: #bae6fd;
            }
        }

        .blob {
            border-radius: 9999px;
            mix-blend-multiply;
            filter: blur(1rem);
            opacity: 0.7;
            position: absolute;
            z-index: 0;
        }

        .animate-blob {
            animation: blob 8s infinite;
        }

        .blob-delay-0 {
            animation-delay: 0s;
        }

        .blob-delay-2000 {
            animation-delay: 2s;
        }

        .blob-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</div>
