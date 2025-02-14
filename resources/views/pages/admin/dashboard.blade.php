<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px] bg-pink-50">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-pink-600">Dashboard</h1>
                    <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}! 💖</p>
                </div>
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-pink-100 text-pink-600 rounded-full hover:bg-pink-200 transition-all duration-200 font-medium">
                            Logout ✨
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-10 flex justify-between w-full gap-5 ">
                <div class="w-full h-36 shadow-lg bg-gradient-to-r from-pink-400 to-pink-500 rounded-2xl flex justify-between items-center p-8 transform hover:scale-105 transition-all duration-300">
                    <h2 class="text-white text-xl font-semibold">Jumlah Pengguna:</h2>
                    <span class="text-white text-xl font-semibold">{{ $user }}</span>
                </div>

                <div class="w-full h-36 shadow-lg bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl flex justify-between items-center p-8 transform hover:scale-105 transition-all duration-300">
                    <h2 class="text-white text-xl font-semibold">Jumlah Product:</h2>
                    <span class="text-white text-xl font-semibold">{{ $product }}</span>
                </div>
            </div>
        </section>
    </main>
</x-layout>
