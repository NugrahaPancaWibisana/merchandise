<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Dashboard</h1>
                    <p>Selamat datang, {{ Auth::user()->name }}!</p>
                </div>

                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="btn text-red-600 px-3 py-1 border border-red-600 hover:scale-110 transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-10 flex justify-between w-full gap-5">
                <div class="w-full h-36 shadow-md bg-teal-600 rounded-xl flex justify-between items-center p-10">
                    <h2 class="text-white text-xl font-semibold">Log Aktivitas Hari Ini:</h2>
                    <span class="text-white text-xl font-semibold">{{ $log }}</span>
                </div>

                <div class="w-full h-36 shadow-md bg-indigo-600 rounded-xl flex justify-between items-center p-10">
                    <h2 class="text-white text-xl font-semibold">Jumlah Produk:</h2>
                    <span class="text-white text-xl font-semibold">{{ $product }}</span>
                </div>

                <div class="w-full h-36 shadow-md bg-purple-600 rounded-xl flex justify-between items-center p-10">
                    <h2 class="text-white text-xl font-semibold">Total Transaksi:</h2>
                    <span class="text-white text-xl font-semibold">{{ $transaction }}</span>
                </div>

                <div class="w-full h-36 shadow-md bg-pink-600 rounded-xl flex justify-between items-center p-10">
                    <h2 class="text-white text-xl font-semibold">Transaksi Hari Ini:</h2>
                    <span class="text-white text-xl font-semibold">{{ $transactionToday }}</span>
                </div>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow-md mt-5">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-zinc-800 text-white">
                            <th class="px-6 py-3 text-left text-sm font-medium">User</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Aktivitas</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-50">
                        @forelse ($logs as $log)
                            <tr class="border-b hover:bg-zinc-100">
                                <td class="px-6 py-3 text-sm text-zinc-700">{{ $log->user->name }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-700">{{ $log->activity }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-700">{{ $log->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-center text-zinc-700">Tidak ada data
                                    log aktivitas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</x-layout>
