<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-800">Edit Pengguna</h1>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mt-10 bg-zinc-100 p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-zinc-700">Username</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-zinc-700">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-zinc-700">Role</label>
                    <select id="role" name="role" required 
                        class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 sm:text-sm">
                        <option value="ADMIN" {{ $user->role == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                        <option value="OWNER" {{ $user->role == 'OWNER' ? 'selected' : '' }}>OWNER</option>
                        <option value="KASIR" {{ $user->role == 'KASIR' ? 'selected' : '' }}>KASIR</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                        class="px-4 py-2 text-white bg-zinc-800 rounded-lg hover:bg-zinc-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>
    </main>
</x-layout>
