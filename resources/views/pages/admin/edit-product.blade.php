<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-800">Edit Produk</h1>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                class="mt-10 bg-zinc-100 p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT') <!-- Method Spoofing untuk UPDATE -->

                <div class="mb-4">
                    <label for="nama_product" class="block text-sm font-medium text-zinc-700">Nama Produk</label>
                    <input type="text" id="nama_product" name="nama_product" value="{{ $product->nama_product }}"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="harga_product" class="block text-sm font-medium text-zinc-700">Harga Produk</label>
                    <input type="number" id="harga_product" name="harga_product" value="{{ $product->harga_product }}"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>

                <div class="flex justify-end gap-5">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 text-zinc-800 border border-zinc-800 rounded-lg hover:bg-zinc-800 hover:text-white transition duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-zinc-800 rounded-lg hover:bg-zinc-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>
    </main>
</x-layout>
