<x-layout>
    <div class="flex h-screen bg-pink-50">
        <!-- Left Side - Catalog -->
        <div class="flex-1 p-6 overflow-y-auto">
            <!-- Search and Categories -->
            <div class="mb-6">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" id="searchProduct"
                        class="pl-10 w-full rounded-full border-pink-200 bg-white focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-all duration-200"
                        placeholder="Find something cute...">
                </div>
            </div>

            <!-- Categories -->
            <div class="flex gap-2 mb-6 overflow-x-auto">
                <button
                    class="category-btn active px-6 py-2 rounded-full bg-pink-400 text-white hover:bg-pink-500 transition-colors duration-200 shadow-sm"
                    data-category="all">
                    ✨ Semua
                </button>
                @foreach ($categories as $category)
                    <button
                        class="category-btn px-6 py-2 rounded-full bg-white hover:bg-pink-100 transition-colors duration-200 shadow-sm"
                        data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div id="productsGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="product-card group" data-category="{{ $product->category_id }}">
                        <div
                            class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-200 p-4 cursor-pointer transform hover:-translate-y-1">
                            <div class="aspect-square bg-pink-100 rounded-xl mb-3 flex items-center justify-center">
                                <!-- Placeholder for product image -->
                                <svg class="w-12 h-12 text-pink-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h3 class="font-medium text-gray-800">{{ $product->nama_product }}</h3>
                            <p class="text-sm text-pink-400">Stok: {{ $product->stock }}</p>
                            <p class="font-bold text-gray-800">Rp
                                {{ number_format($product->harga_product, 0, ',', '.') }}</p>
                            <input type="hidden" class="product-data" data-id="{{ $product->id }}"
                                data-name="{{ $product->nama_product }}" data-price="{{ $product->harga_product }}"
                                data-stock="{{ $product->stock }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Side - Cart -->
        <div class="w-96 bg-white p-6 shadow-lg flex flex-col">
            <div class="flex items-center justify-between gap-2 mb-4">
                <div class="flex">
                    <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h2 class="text-xl font-bold text-gray-800">Keranjang Belanja</h2>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-pink-400 rounded-full hover:bg-pink-500 transition-colors duration-200 shadow-sm"
                        id="clearCartBtn">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Cart Items -->
            <div id="cartItems" class="flex-1 overflow-y-auto">
                <!-- Cart items will be dynamically added here -->
            </div>

            <!-- Cart Summary -->
            <div class="border-t border-pink-100 pt-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                    <input type="text" id="customerName"
                        class="mt-1 w-full rounded-full border-pink-200 focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Uang Bayar</label>
                    <input type="number" id="paymentAmount"
                        class="mt-1 w-full rounded-full border-pink-200 focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                </div>

                <div class="flex justify-between mb-2 bg-pink-50 p-3 rounded-lg">
                    <span class="font-medium">Total</span>
                    <span id="cartTotal" class="font-bold">Rp 0</span>
                </div>

                <div class="flex justify-between mb-4 bg-pink-50 p-3 rounded-lg">
                    <span class="font-medium">Kembalian</span>
                    <span id="changeAmount" class="font-bold">Rp 0</span>
                </div>

                <button id="checkoutBtn"
                    class="w-full bg-pink-400 text-white px-6 py-3 rounded-full mb-2 hover:bg-pink-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm">
                    💝 Proses Transaksi
                </button>

                <button id="printBtn"
                    class="w-full border border-pink-200 px-6 py-3 rounded-full hover:bg-pink-50 transition-colors duration-200"
                    disabled>
                    🧾 Cetak Struk
                </button>
            </div>
        </div>
    </div>

    <template id="cartItemTemplate">
        <div class="cart-item mb-4 bg-pink-50 p-4 rounded-xl" data-id="">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-medium product-name text-gray-800"></h3>
                    <p class="text-sm text-pink-400 product-price"></p>
                </div>
                <div class="flex items-center gap-2">
                    <button
                        class="decrease-qty px-3 py-1 rounded-full bg-white hover:bg-pink-100 transition-colors duration-200 shadow-sm">-</button>
                    <span class="quantity-display w-8 text-center font-medium">1</span>
                    <button
                        class="increase-qty px-3 py-1 rounded-full bg-white hover:bg-pink-100 transition-colors duration-200 shadow-sm">+</button>
                </div>
            </div>
        </div>
    </template>
</x-layout>
