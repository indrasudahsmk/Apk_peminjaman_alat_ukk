<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Data Pengembalian</h3>
                        @canany(['admin', 'petugas'])
                            <a href="{{ route('pengembalian.create') }}">Tambah Data</a>
                        @endcanany
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">No</th>
                                        @canany(['admin', 'petugas'])
                                            <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama</th>
                                            <th class="px-4 py-2 border dark:border-gray-600 text-left">Email</th>
                                        @endcanany
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama Alat</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Jumlah</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Status</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Denda</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Tanggal Pinjam</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Tanggal Kembali
                                            (Tempo)</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Tanggal Pengembalian
                                        </th>
                                        @can('admin')
                                            <th class="px-4 py-2 border dark:border-gray-600 text-left">Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengembalian as $pengembalian)
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $loop->iteration }}
                                            </td>
                                            @canany(['admin', 'petugas'])
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    {{ $pengembalian->peminjaman->user->name }}</td>
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    {{ $pengembalian->peminjaman->user->email }}</td>
                                            @endcanany
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $pengembalian->peminjaman->jumlah }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $pengembalian->peminjaman->status }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $pengembalian->denda }}
                                            </td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $pengembalian->peminjaman->tgl_pinjam }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $pengembalian->peminjaman->tgl_kembali }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $pengembalian->tanggal_pengembalian }}</td>
                                            @can('admin')
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    <form action="{{ route('pengembalian.destroy', $pengembalian->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">Hapus</button>
                                                    </form>
                                                </td>
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
