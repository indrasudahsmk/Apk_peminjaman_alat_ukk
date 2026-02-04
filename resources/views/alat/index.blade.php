<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Data Alat</h3>
                        @canany(['admin', 'petugas'])
                            <a href="{{ route('alat.create') }}">Tambah Data</a>
                        @endcanany
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">No</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama Alat</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Kategori</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Stok</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alat as $alat)
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $loop->iteration }}
                                            </td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $alat->nama_alat }}
                                            </td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $alat->kategori->name }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $alat->stok }}</td>
                                            @can('admin')
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    <a href="{{ route('alat.edit', $alat->id) }}">Edit</a>
                                                    <form action="{{ route('alat.destroy', $alat->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">Hapus</button>
                                                    </form>
                                                </td>
                                            @endcan
                                            @can('peminjam')
                                                @if ($alat->stok > 0)
                                                    <td class="px-4 py-2 border dark:border-gray-700">
                                                        <a href="{{ route('peminjaman.create') }}">Pinjam alat</a>
                                                    </td>
                                                @else
                                                    <td class="px-4 py-2 border dark:border-gray-700">
                                                        <a href="#">Stok Habis</a>
                                                    </td>
                                                @endif
                                            @endcan
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
