<style>
    @keyframes gradient-x {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .animate-gradient {
        background-size: 300% 300%;
        animation: gradient-x 10s ease infinite;
    }
</style>

<div class="bg-gradient-to-r from-pink-200 via-pink-400 to-violet-500 animate-gradient text-gray-800">
    <div class="min-h-screen flex items-center justify-center px-7 lg:px-20 py-10">
        <div class="flex flex-col lg:flex-row items-start gap-12 w-full max-w-6xl">

            {{-- Teks di sebelah Kiri --}}
            <div class="flex-1 space-y-6 text-left">
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Menerima Tugas & Mengumpulkan Tugas
                </h2>
                <div class="text-lg text-gray-800 max-w-2xl prose prose-p:my-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ex, consequuntur tempore veritatis odio expedita, sequi accusantium vero aliquid consectetur quia doloremque nobis eius sapiente incidunt sunt reiciendis...
                </div>
            </div>

            {{-- Gambar di sebelah Kanan --}}
            <div class="flex-1 flex justify-center lg:justify-start">
                <img
                    src="{{ asset('foto/tugas.png') }}"
                    alt="Ilustrasi Menerima Tugas"
                    class="w-80 sm:w-96 md:w-[28rem] lg:w-[32rem] h-auto object-cover drop-shadow-lg rounded-lg"
                >
            </div>

        </div>
    </div>
</div>
