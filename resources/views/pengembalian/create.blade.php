<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('pengembalian.store') }}" method="post">
                        @csrf
                        @if (session('error'))
                            <div class="m-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="mb-4">
                            <span>Pilih data peminjaman</span><br>
                            <select name="peminjaman_id" id="" class="bg-gray-800">
                                @forelse ($peminjaman as $peminjaman)
                                    <option value="{{ $peminjaman->id }}">
                                        {{ $peminjaman->alat->nama_alat . '--[' . $peminjaman->user->name . '-' . $peminjaman->user->email .'-'.'['.$peminjaman->jumlah.']' }}
                                    </option>
                                @empty
                                    <option>Tidak ada alat</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-4">
                            <span>Tanggal Pengembalian</span><br>
                            <input type="date" name="tanggal_pengembalian" class="text-white bg-gray-800">
                        </div>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
