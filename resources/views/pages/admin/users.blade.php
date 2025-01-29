<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px]">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Users</h1>
                </div>

                <div>
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
                <a href="{{ route('admin.users.create-view') }}"
                    class="btn text-green-600 px-3 py-1 border border-green-600 hover:scale-110 transition-all duration-200">
                    Tambah User
                </a>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow-md mt-3">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-zinc-800 text-white">
                            <th class="px-6 py-3 text-left text-sm font-medium">Username</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Role</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-50">
                        @foreach ($users as $user)
                            <tr class="border-b hover:bg-zinc-100">
                                <td class="px-6 py-3 text-sm text-zinc-700">{{ $user->username }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-700">{{ $user->name }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-700">{{ $user->role }}</td>
                                <td class="px-6 py-3 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-indigo-600 hover:underline">
                                            Edit
                                        </a>
                                        @if ($user->status === 'ACTIVE')
                                            <form method="POST"
                                                action="{{ route('admin.users.deactivate', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Nonaktifkan
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST"
                                                action="{{ route('admin.users.activate', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:underline">
                                                    Aktifkan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</x-layout>
