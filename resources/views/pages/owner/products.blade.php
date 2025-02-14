<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px] bg-pink-50">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-pink-600">Product</h1>
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

            <div class="overflow-hidden bg-white rounded-2xl shadow-lg mt-8">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-400 to-purple-400">
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Nama Product</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Harga Product</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($products->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-center text-gray-700">
                                    Tidak ada data product 🌸
                                </td>
                            </tr>
                        @else
                            @foreach ($products as $product)
                                <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors duration-200">
                                    <td class="px-6 py-3 text-sm text-gray-700">{{ $product->nama_product }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-700">Rp
                                        {{ number_format($product->harga_product, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</x-layout>
