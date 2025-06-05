<div>
    <div class="min-h-[70vh] bg-gradient-to-r from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Bagian Kiri (Teks) -->
            <div class="lg:w-1/2 space-y-6">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                    Selamat Datang di <span class="text-blue-600">LMS SMK Negeri 3 Ambon</span>
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed">
                    LMS SMK Negeri 3 Ambon adalah platform pembelajaran digital yang dirancang khusus untuk mendukung proses belajar mengajar dengan fitur lengkap dan mudah digunakan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="#" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                        <i class="bi bi-bell-fill text-lg"></i>
                        Masuk Sekarang
                    </a>
                    <a href="#" class="px-6 py-3 bg-white hover:bg-gray-100 text-gray-800 font-medium rounded-lg border border-gray-300 shadow-sm transition duration-300 flex items-center justify-center gap-2">
                        <i class="bi bi-info-circle-fill text-lg"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <!-- Bagian Kanan (Gambar) -->
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative w-full max-w-xs md:max-w-sm">
                    <!-- Blob animasi -->
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute -bottom-8 -right-8 w-24 h-24 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <div class="absolute top-20 -right-4 w-24 h-24 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>

                    <div class="relative bg-white p-4 rounded-2xl shadow-xl border border-gray-100">
                        <img src="{{ asset('foto/logo-smk.png') }}" alt="Logo SMK Negeri 3 Ambon" class="w-48 sm:w-60 h-auto object-contain mx-auto rounded-lg">
                        <!-- w-48 = 12rem, sm:w-60 = 15rem -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Animasi blob -->
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</div>