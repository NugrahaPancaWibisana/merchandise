<x-layout>
    <main class="flex justify-center items-center w-full h-screen bg-gray-100">
        <section
            class="flex flex-col w-[90%] md:w-[50%] lg:w-[30%] p-8 bg-white rounded-xl border border-gray-300 shadow-md">
            <form class="w-full flex flex-col gap-6" action="{{ route('login') }}" method="post">
                @csrf

                <div class="text-center">
                    <p class="text-2xl font-bold">Masukkan Akun Anda</p>
                </div>

                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('username') border-red-500 @enderror">
                    @error('username')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- General Error Message -->
                @error('status')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-pink-400 text-white py-2 rounded-md hover:bg-pink-500">
                    Login
                </button>
            </form>
        </section>
    </main>
</x-layout>
