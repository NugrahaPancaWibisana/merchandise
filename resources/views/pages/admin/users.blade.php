<x-layout>
    <x-navbar></x-navbar>

    <main class="w-full h-screen pl-[280px] bg-pink-50">
        <section class="p-10">
            <div class="w-full flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-pink-600">Users</h1>
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

            <div class="mt-10">
                <a href="{{ route('admin.users.create-view') }}"
                    class="px-4 py-2 bg-pink-100 text-pink-600 rounded-full hover:bg-pink-200 transition-all duration-200 font-medium">
                    Tambah User
                </a>
            </div>

            <div class="overflow-hidden bg-white rounded-2xl shadow-lg mt-8">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-400 to-purple-400">
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Username</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Role</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $user)
                            <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors duration-200">
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $user->username }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $user->role }}</td>
                                <td class="px-6 py-3 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-pink-600 hover:underline">
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