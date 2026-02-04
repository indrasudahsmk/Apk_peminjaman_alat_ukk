<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Data Kategori</h3>
                        <a href="{{ route('kategori.create') }}">Tambah Data</a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">No</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Deskripsi</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $kategori)
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $kategori->name }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $kategori->deskripsi }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                <a href="{{ route('kategori.edit', $kategori->id) }}">Edit</a>
                                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
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
