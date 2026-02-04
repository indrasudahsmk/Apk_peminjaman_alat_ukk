<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Data Peminjaman</h3>
                        @can('admin')
                            <a href="{{ route('peminjaman.create') }}">Tambah Data</a>
                        @endcan
                        <div class="overflow-x-auto">
                            
                                <a href="{{ route('peminjaman.print') }}">Cetak</a>
                            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">No</th>
                                        @canany(['admin', 'petugas'])
                                            <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama</th>
                                            <th class="px-4 py-2 border dark:border-gray-600 text-left">Email</th>
                                        @endcanany
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Nama Alat</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Kategori</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Jumlah</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Status</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Tanggal Pinjam</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Tanggal Kembali</th>
                                        <th class="px-4 py-2 border dark:border-gray-600 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $peminjaman)
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $loop->iteration }}
                                            </td>
                                            @canany(['admin', 'petugas'])
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    {{ $peminjaman->user->name }}</td>
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    {{ $peminjaman->user->email }}</td>
                                            @endcanany
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $peminjaman->alat->nama_alat }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $peminjaman->alat->kategori->name }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $peminjaman->jumlah }}
                                            </td>
                                            <td class="px-4 py-2 border dark:border-gray-700">{{ $peminjaman->status }}
                                            </td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $peminjaman->tgl_pinjam }}</td>
                                            <td class="px-4 py-2 border dark:border-gray-700">
                                                {{ $peminjaman->tgl_kembali }}</td>
                                            @can('admin')
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    <a href="{{ route('peminjaman.edit', $peminjaman->id) }}">Edit</a>
                                                    <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">Hapus</button>
                                                    </form>
                                                </td>
                                            @endcan
                                            @can('petugas')
                                                <td class="px-4 py-2 border dark:border-gray-700">
                                                    @if ($peminjaman->status == 'menunggu')
                                                        <form action="{{ route('peminjaman.setuju', $peminjaman->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit">Setuju</button>
                                                        </form>
                                                        <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit">Tolak</button>
                                                        </form>
                                                    @elseif ($peminjaman->status == 'dipinjam')
                                                        disetujui
                                                    @else
                                                        ditolak
                                                    @endif
                                                </td>
                                            @endcan
                                            @can('peminjam')
                                                @if ($peminjaman->status === 'dipinjam')
                                                    <td class="px-4 py-2 border dark:border-gray-700">
                                                        <form
                                                            action="{{ route('pengembalian.kembalikan', $peminjaman->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit">Kembalikan alat</button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td>-</td>
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
