<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-800">Tambah Pengguna</h1>
            </div>

            <form action="{{ route('admin.users.create') }}" method="POST" class="mt-10 bg-zinc-100 p-6 rounded-lg shadow-md">
                @csrf
                
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-zinc-700">Username</label>
                    <input type="text" id="username" name="username" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-zinc-700">Nama</label>
                    <input type="text" id="name" name="name" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-zinc-700">Role</label>
                    <select id="role" name="role" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                        <option value="ADMIN">ADMIN</option>
                        <option value="OWNER">OWNER</option>
                        <option value="KASIR">KASIR</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
                    <input type="password" id="password" name="password" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>
                
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>
                

                <div class="flex justify-end gap-5">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 text-zinc-800 border border-zinc-800 rounded-lg hover:bg-zinc-800 hover:text-white transition duration-200">
                        Kembali
                    </a>
                    <button type="submit" 
                        class="px-4 py-2 text-white bg-zinc-800 rounded-lg hover:bg-zinc-700 transition duration-200">
                        Tambah Pengguna
                    </button>
                </div>
            </form>
        </section>
    </main>
</x-layout>
