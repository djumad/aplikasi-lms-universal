<div>
  <section class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
    <div class="container mx-auto px-4">
      <div class="flex flex-col lg:flex-row items-center justify-center min-h-screen">

        <!-- Gambar sebelah kiri -->
        <div class="hidden lg:block lg:w-1/2">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            alt="Sample image"
            class="w-full h-auto rounded-xl shadow-lg" />
        </div>

        <!-- Form login -->
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg lg:ml-10">
          <h3 class="text-2xl font-bold text-center text-indigo-600 mb-6">Masuk ke Akun Anda</h3>

          <form wire:submit.prevent="login">
            <!-- Email input -->
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
              <input type="email" id="email"
                     class="mt-1 block w-full px-4 py-2 rounded-lg border @error('email') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                     placeholder="Masukkan alamat email"
                     wire:model.defer="email" />
              @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Password input -->
            <div class="mb-4">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" id="password"
                     class="mt-1 block w-full px-4 py-2 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                     placeholder="Masukkan password"
                     wire:model.defer="password" />
              @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between mb-6">
              <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-indigo-600" />
                <span class="ml-2 text-sm text-gray-700">Ingat saya</span>
              </label>
            </div>

            <!-- Button -->
            <div class="text-center">
              <button type="submit"
                      class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold py-2 rounded-lg shadow-md transition duration-300">
                Masuk
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>
