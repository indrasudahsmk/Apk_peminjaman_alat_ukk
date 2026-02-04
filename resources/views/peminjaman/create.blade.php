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
                    <form action="{{ route('peminjaman.store') }}" method="post">
                        @csrf
                        @if (session('error'))
                            <div class="m-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        @can('admin')
                            <div class="mb-4">
                                <span>User</span><br>
                                <select name="user_id" id="" class="bg-gray-800">
                                    @forelse ($user as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}--[{{ $user->email }}]
                                        </option>
                                    @empty
                                        <option>Tidak ada user</option>
                                    @endforelse
                                </select>
                            </div>
                        @endcan
                        @can('peminjam')
                            <input type="hidden" name="user_id" class="text-white bg-gray-800" value="{{ Auth::user()->id }}">
                        @endcan
                        <div class="mb-4">
                            <span>Alat</span><br>
                            <select name="alat_id" id="" class="bg-gray-800">
                                @forelse ($alat as $alat)
                                    <option value="{{ $alat->id }}">{{ $alat->nama_alat }}</option>
                                @empty
                                    <option>Tidak ada alat</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-4">
                            <span>Jumlah Pinjam</span><br>
                            <input type="number" name="jumlah" class="text-white bg-gray-800">
                        </div>
                        <div class="mb-4">
                            <span>Tanggal Kembali</span><br>
                            <input type="date" name="tgl_kembali" class="text-white bg-gray-800">
                        </div>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
