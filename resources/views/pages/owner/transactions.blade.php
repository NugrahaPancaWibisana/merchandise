<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px] bg-pink-50">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-pink-600">Transaction</h1>
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

            <div class="mt-10">
                <div class="flex items-center gap-2">
                    <form method="GET" action="{{ route('owner.transactions.list') }}">
                        <div class="flex items-center gap-2 text-pink-600">
                            <label for="start_date">Filter Dari Tanggal:</label>
                            <input type="date" id="start_date" name="start_date" class="border rounded px-2 py-1"
                                value="{{ request('start_date') }}">
                            <span>sampai</span>
                            <input type="date" id="end_date" name="end_date" class="border rounded px-2 py-1"
                                value="{{ request('end_date') }}">
                            <button type="submit" class="bg-pink-500 text-white px-3 py-1 rounded">Filter</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="overflow-hidden bg-white rounded-2xl shadow-lg mt-8">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-400 to-purple-400">
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Nama Pelanggan</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Nomor Unik</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Uang Bayar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Uang Kembali</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-50" id="transactions-body">
                        @if ($transactions->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-700">
                                    Tidak ada data transaksi 🌸
                                </td>
                            </tr>
                        @else
                            @foreach ($transactions as $transaction)
                                <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors duration-200">
                                    <td class="px-6 py-3 text-sm text-gray-700">{{ $transaction->nama_pelanggan }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-700">
                                        @foreach (json_decode($transaction->items) as $index => $item)
                                            {{ $item->product->nama_product ?? 'Produk' }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-700">{{ $transaction->nomor_unik }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-700">Rp
                                        {{ number_format($transaction->uang_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-700">Rp
                                        {{ number_format($transaction->uang_kembali, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-700">
                                        {{ $transaction->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </section>
    </main>
</x-layout>
