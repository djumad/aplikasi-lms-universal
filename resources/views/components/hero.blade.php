<div class="min-h-[100vh] bg-gradient-to-r from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center justify-between gap-12">

    <!-- Bagian Kiri (Teks) -->
    <div class="lg:w-1/2 space-y-6" data-aos="fade-right">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
            Selamat Datang di <span class="text-blue-600">LMS SMK Negeri 3 Ambon</span>
        </h1>

        <p class="text-lg text-gray-700 leading-relaxed">
            LMS SMK Negeri 3 Ambon adalah platform pembelajaran digital yang dirancang khusus untuk mendukung proses belajar mengajar dengan fitur lengkap dan mudah digunakan.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <a href="/login" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2" data-aos="zoom-in" data-aos-delay="200">
                <i class="bi bi-bell-fill text-lg"></i>
                Masuk Sekarang
            </a>
            <a href="#" class="px-6 py-3 bg-white hover:bg-gray-100 text-gray-800 font-medium rounded-lg border border-gray-300 shadow-sm transition duration-300 flex items-center justify-center gap-2" data-aos="zoom-in" data-aos-delay="400">
                <i class="bi bi-info-circle-fill text-lg"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>

    <!-- Bagian Kanan (Gambar) -->
    <div class="lg:w-1/2 flex justify-center" data-aos="fade-left" data-aos-delay="600">
        <div class="relative w-full max-w-xs md:max-w-sm">
            <!-- Blob animasi -->
            <div class="absolute -top-6 -left-6 w-24 h-24 blob bg-blue-300 animate-blob blob-delay-0"></div>
            <div class="absolute -bottom-8 -right-8 w-24 h-24 blob bg-cyan-300 animate-blob blob-delay-2000"></div>
            <div class="absolute top-20 -right-4 w-24 h-24 blob bg-indigo-300 animate-blob blob-delay-4000"></div>

            <div class="relative bg-white p-4 rounded-2xl shadow-xl border border-gray-100">
                <img src="{{ asset('foto/logo-smk.png') }}" alt="Logo SMK Negeri 3 Ambon" class="w-48 sm:w-60 h-auto object-contain mx-auto rounded-lg">
            </div>
        </div>
    </div>

    <!-- Animasi blob -->
    <style>
        @keyframes blob {
            0%, 100% {
                transform: translate(0px, 0px) scale(1);
                background-color: #93c5fd; /* blue-300 */
            }
            25% {
                transform: translate(20px, -30px) scale(1.05);
                background-color: #7dd3fc; /* sky-300 */
            }
            50% {
                transform: translate(-20px, 20px) scale(0.95);
                background-color: #a5b4fc; /* indigo-300 */
            }
            75% {
                transform: translate(30px, 10px) scale(1.1);
                background-color: #bae6fd; /* cyan-200 */
            }
        }

        .blob {
            border-radius: 9999px;
            mix-blend-multiply;
            filter: blur(1rem);
            opacity: 0.7;
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
