<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px] bg-pink-50">
        <section class="p-10">
            <!-- Header Section -->
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

            <!-- Stats Cards -->
            <div class="mt-10 flex justify-between w-full gap-5">
                <div
                    class="w-full h-36 shadow-lg bg-gradient-to-r from-pink-400 to-pink-500 rounded-2xl flex justify-between items-center p-8 transform hover:scale-105 transition-all duration-300">
                    <div class="flex flex-col">
                        <h2 class="text-white text-lg font-medium">Log Aktivitas Hari Ini</h2>
                        <span class="text-white text-2xl font-bold mt-2">{{ $log }}</span>
                    </div>
                    <div class="text-pink-200 text-3xl">📝</div>
                </div>

                <div
                    class="w-full h-36 shadow-lg bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl flex justify-between items-center p-8 transform hover:scale-105 transition-all duration-300">
                    <div class="flex flex-col">
                        <h2 class="text-white text-lg font-medium">Jumlah Produk</h2>
                        <span class="text-white text-2xl font-bold mt-2">{{ $product }}</span>
                    </div>
                    <div class="text-pink-200 text-3xl">🎁</div>
                </div>

                <div
                    class="w-full h-36 shadow-lg bg-gradient-to-r from-pink-500 to-purple-500 rounded-2xl flex justify-between items-center p-8 transform hover:scale-105 transition-all duration-300">
                    <div class="flex flex-col">
                        <h2 class="text-white text-lg font-medium">Total Transaksi</h2>
                        <span class="text-white text-2xl font-bold mt-2">{{ $transaction }}</span>
                    </div>
                    <div class="text-pink-200 text-3xl">💝</div>
                </div>

                <div
                    class="w-full h-36 shadow-lg bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex justify-between items-center p-8 transform hover:scale-105 transition-all duration-300">
                    <div class="flex flex-col">
                        <h2 class="text-white text-lg font-medium">Transaksi Hari Ini</h2>
                        <span class="text-white text-2xl font-bold mt-2">{{ $transactionToday }}</span>
                    </div>
                    <div class="text-pink-200 text-3xl">✨</div>
                </div>
            </div>

            <!-- Activity Table -->
            <div class="overflow-hidden bg-white rounded-2xl shadow-lg mt-8">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-400 to-purple-400">
                            <th class="px-6 py-4 text-left text-sm font-medium text-white">User</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-white">Aktivitas</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-white">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($logs as $log)
                            <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $log->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $log->activity }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $log->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-center text-gray-700">
                                    Tidak ada data log aktivitas 🌸
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</x-layout>
