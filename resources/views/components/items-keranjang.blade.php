<div class="flex-1 overflow-y-auto space-y-4">
    @forelse($keranjang as $idProduk => $item)
        <div
            class="flex justify-between items-start p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
            <div class="flex-1">
                <div class="flex justify-between">
                    <p class="font-medium text-gray-800">{{ $item['nama'] }}</p>
                    <p class="font-medium text-gray-800">Rp {{ number_format($item['total']) }}</p>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <button onclick="updateJumlah({{ $idProduk }}, 'kurang')"
                        class="p-1 rounded-md hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <span class="text-sm font-medium">{{ $item['jumlah'] }}</span>
                    <button onclick="updateJumlah({{ $idProduk }}, 'tambah')"
                        class="p-1 rounded-md hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-4">Keranjang masih kosong</p>
    @endforelse
</div>

<div class="border-t border-gray-200 pt-4 mt-4 space-y-3">
    <div class="flex justify-between text-sm">
        <p class="text-gray-600">Sub Total</p>
        <p class="font-medium text-gray-800">Rp {{ number_format($subtotal) }}</p>
    </div>
    <div class="flex justify-between text-sm">
        <p class="text-gray-600">Pajak (12%)</p>
        <p class="font-medium text-gray-800">Rp {{ number_format($pajak) }}</p>
    </div>
    <div class="flex justify-between text-lg font-bold">
        <p class="text-gray-800">Total</p>
        <p class="text-green-500">Rp {{ number_format($total) }}</p>
    </div>
</div>

<button
    class="w-full bg-green-500 text-white py-3 rounded-lg mt-6 font-medium hover:bg-green-600 transition-colors flex items-center justify-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
            clip-rule="evenodd" />
    </svg>
    Proses Pembayaran
</button>
