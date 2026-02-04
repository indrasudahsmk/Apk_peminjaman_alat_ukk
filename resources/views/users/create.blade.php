<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <span>name</span><br>
                            <input type="text" name="name" class="text-white bg-gray-800">
                        </div>
                        <div class="mb-4">
                            <span>email</span><br>
                            <input type="text" name="email" class="text-white bg-gray-800">
                            <x-input-error :messages="$errors->get('email')"/>
                        </div>
                        <div class="mb-4">
                            <span>Password</span><br>
                            <input type="password" name="password" class="text-white bg-gray-800">
                        </div>
                        <div class="mb-4">
                            <span>Role</span><br>
                            <select name="role" id="" class="bg-gray-800">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="Peminjam">Peminjam</option>
                            </select>
                        </div>

                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
