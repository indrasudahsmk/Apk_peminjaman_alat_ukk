<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Data Users</h3>
                        <a href="{{ route('users.create') }}">Tambah Data</a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">No</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Email</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Role</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $user->name }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $user->email }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $user->role }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
