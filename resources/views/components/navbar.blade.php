<!-- Tambahkan di <head> jika belum -->
<!-- <script src="https://unpkg.com/alpinejs" defer></script> -->

<div x-data="{ navOpen: false, showLogoutModal: false }">
  <nav class="bg-gray-900 text-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      
      <!-- Brand -->
      <a href="/dashboard/siswa" class="text-xl font-bold text-white hover:text-blue-400 transition">{{ config('app.name') }}</a>
      
      <!-- Toggle button for mobile -->
      <button @click="navOpen = !navOpen" class="lg:hidden focus:outline-none" aria-label="Toggle Navigation">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

      <!-- Nav items -->
      <div :class="navOpen ? 'block' : 'hidden'" class="w-full lg:flex lg:items-center lg:w-auto mt-4 lg:mt-0">
        <ul class="lg:flex lg:space-x-6 lg:ml-auto space-y-2 lg:space-y-0 text-sm font-medium">
          
          @auth
            <li>
              <a href="/dashboard/siswa/ai" class="block px-3 py-2 rounded hover:bg-gray-800 transition">
                Tanya Ai
              </a>
            </li>

            <li class="flex items-center px-3 py-2 text-gray-300">
              Halo, <span class="ml-1 font-semibold text-white">{{ Auth::user()->name }}</span>
            </li>

            <li>
              <button 
                @click="showLogoutModal = true"
                class="block w-full text-left px-3 py-2 rounded hover:bg-red-600 hover:text-white transition"
              >
                Logout
              </button>
            </li>
          @endauth

          @guest
            <li>
              <a href="{{ route('login') }}" class="block px-3 py-2 rounded hover:bg-blue-600 transition">
                Login
              </a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal Logout -->
  <div
    x-show="showLogoutModal"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    x-cloak
  >
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Logout</h2>
      <p class="text-gray-600 mb-6">Apakah Anda yakin ingin logout?</p>
      <div class="flex justify-end space-x-3">
        <button
          @click="showLogoutModal = false"
          class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-800 transition"
        >
          Batal
        </button>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded transition"
          >
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
