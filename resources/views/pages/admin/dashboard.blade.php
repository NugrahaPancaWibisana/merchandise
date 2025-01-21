<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="w-full flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Dashboard</h1>
                    <p>Selamat datang, {{ Auth::user()->name }}!</p>
                </div>

                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn text-red-600 px-3 py-1 border border-red-600 hover:scale-110 transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-10 flex justify-between w-full gap-5 ">
                <div class="w-full h-36 bg-teal-600 rounded-xl flex justify-between items-center p-10">
                    <h2 class="text-white text-xl font-semibold">Jumlah Pengguna:</h2>
                    <span class="text-white text-xl font-semibold">{{ $user }}</span>
                </div>

                <div class="w-full h-36 bg-indigo-600 rounded-xl flex justify-between items-center p-10">
                    <h2 class="text-white text-xl font-semibold">Jumlah Product:</h2>
                    <span class="text-white text-xl font-semibold">{{ $product }}</span>
                </div>
            </div>
        </section>
    </main>
</x-layout>
