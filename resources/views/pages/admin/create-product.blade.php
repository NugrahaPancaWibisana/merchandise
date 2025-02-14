<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px] bg-pink-50">
        <section class="p-10">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-pink-600">Tambah Produk</h1>
            </div>

            <form action="{{ route('admin.products.create') }}" method="POST" enctype="multipart/form-data"
                class="mt-10 bg-white p-6 rounded-lg shadow-md border-2 border-pink-300">
                @csrf

                <div class="mb-4">
                    <label for="nama_product" class="block text-sm font-medium text-pink-700">Nama Produk</label>
                    <input type="text" id="nama_product" name="nama_product" required
                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="harga_product" class="block text-sm font-medium text-pink-700">Harga Produk</label>
                    <input type="number" id="harga_product" name="harga_product" required
                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-pink-700">Stock</label>
                    <input type="number" id="stock" name="stock" required
                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-pink-700">Kategori</label>
                    <select id="category_id" name="category_id" class="form-control"
                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm"
                        required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-pink-700">Upload Gambar</label>
                    <input type="file" id="image" name="image"
                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                </div>

                <div class="flex justify-end gap-5">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 text-pink-700 border border-pink-700 rounded-lg hover:bg-pink-700 hover:text-white transition duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-pink-700 rounded-lg hover:bg-pink-600 transition duration-200">
                        Tambah Produk
                    </button>
                </div>
            </form>
        </section>
    </main>
</x-layout>
