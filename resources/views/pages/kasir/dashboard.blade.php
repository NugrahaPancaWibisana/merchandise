<x-layout>
    <main class="w-full h-screen bg-gray-100 overflow-hidden flex flex-col">
        <x-navbar></x-navbar>

        <section class="p-6 flex-1 flex gap-6 overflow-hidden">
            <div class="flex flex-col w-full h-full">
                <!-- Informasi Pelanggan -->
                <div class="mb-6 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Informasi Pelanggan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                    placeholder="Masukkan nama pelanggan" />
                            </div>
                        </div>
                        <div>
                            <label for="uang_bayar" class="block text-sm font-medium text-gray-700 mb-1">Uang Bayar</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500 font-medium">Rp</span>
                                <input type="number" id="uang_bayar" name="uang_bayar"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                    placeholder="0" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-6 flex-1 overflow-hidden">
                    <!-- Daftar Produk -->
                    <div class="flex-1 bg-white rounded-xl shadow-sm p-6 border border-gray-100 overflow-hidden flex flex-col">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Daftar Menu</h2>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 overflow-y-auto">
                            @foreach ($products as $product)
                                <div class="border border-gray-200 rounded-xl p-4 hover:border-green-500 transition-colors group">
                                    <div class="flex flex-col h-full">
                                        <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $product->nama_product }}</h3>
                                        <p class="text-gray-600 text-sm mb-4">Rp {{ number_format($product->harga_product) }}</p>
                                        <button onclick="tambahKeKeranjang({{ $product->id }})" 
                                                class="w-full bg-green-100 text-green-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-500 hover:text-white transition-colors mt-auto group-hover:bg-green-500 group-hover:text-white">
                                            Tambah ke Keranjang
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Keranjang -->
                    <div class="w-96 bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex flex-col keranjang-container">
                        <!-- Konten keranjang akan diupdate secara dinamis di sini -->
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layout>