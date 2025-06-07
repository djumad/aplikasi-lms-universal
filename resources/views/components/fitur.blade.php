<style>
  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(15px);
    }
  }

  .animate-bounce-slow {
    animation: bounce 2s ease-in-out infinite;
  }

  /* Animasi warna biru ke ungu */
  @keyframes colorShift {
    0%, 100% {
      color: #3b82f6; /* biru-500 Tailwind */
    }
    50% {
      color: #8b5cf6; /* ungu-500 Tailwind */
    }
  }

  .animate-color-shift {
    animation: colorShift 4s ease-in-out infinite;
  }
</style>

<div class="w-full h-screen flex flex-col items-center justify-center text-center bg-black text-white">
  <p class="text-7xl font-extrabold animate-color-shift">
    Fitur Pada Aplikasi LMS SMK NEGERI 3 AMBON
  </p>
  <div class="mt-16">
    <p class="text-7xl font-extrabold animate-bounce-slow">
      <i class="bi bi-arrow-down-circle-fill"></i>
    </p>
  </div>
</div>
