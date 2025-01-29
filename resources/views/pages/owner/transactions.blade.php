<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Transactions</h1>
                </div>

                <div class="flex gap-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="btn text-red-600 px-3 py-1 border border-red-600 hover:scale-110 transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-10">
                <div class="flex items-center gap-2">
                    <form method="GET" action="{{ route('owner.transactions.list') }}">
                        <div class="flex items-center gap-2">
                            <label for="start_date">Filter Dari Tanggal:</label>
                            <input type="date" id="start_date" name="start_date" class="border rounded px-2 py-1"
                                value="{{ request('start_date') }}">
                            <span>sampai</span>
                            <input type="date" id="end_date" name="end_date" class="border rounded px-2 py-1"
                                value="{{ request('end_date') }}">
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow-md mt-5">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-zinc-800 text-white">
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Pelanggan</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nomor Unik</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Uang Bayar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Uang Kembali</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-50" id="transactions-body">
                        @if ($transactions->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-sm text-center text-zinc-700">Tidak ada data
                                    transaksi</td>
                            </tr>
                        @else
                            @foreach ($transactions as $transaction)
                                <tr class="border-b hover:bg-zinc-100">
                                    <td class="px-6 py-3 text-sm text-zinc-700">{{ $transaction->nama_pelanggan }}</td>
                                    <td class="px-6 py-3 text-sm text-zinc-700">
                                        {{ $transaction->product->nama_product ?? 'Produk Tidak Ditemukan' }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-zinc-700">{{ $transaction->nomor_unik }}</td>
                                    <td class="px-6 py-3 text-sm text-zinc-700">Rp
                                        {{ number_format($transaction->uang_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-zinc-700">Rp
                                        {{ number_format($transaction->uang_kembali, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-zinc-700">
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
