<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('kategori.store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <span>nama</span><br>
                            <input type="text" name="name" class="text-white bg-gray-800">
                        </div>
                        <div class="mb-4">
                            <span>Deskripsi</span><br>
                            <textarea class="text-white bg-gray-800" name="deskripsi"></textarea>
                        </div>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
