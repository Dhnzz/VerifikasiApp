@extends('layout.admin')

@section('main')
    <section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center pt-44 pb-20 px-4 lg:px-12 gap-4">
        <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="w-full flex flex-col items-center">
                <p class="font-semibold text-lg">Tambah Data Dosen</p>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                <form action="{{ route('admin.dosen.store') }}" method="post" class=" w-full">
                    @csrf
                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                            NIP
                        </label>
                        <input type="text" placeholder="NIP" name="credential"
                            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                            Nama Dosen
                        </label>
                        <input type="text" placeholder="Nama Lengkap" name="name"
                            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="text" placeholder="Email" name="email"
                            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                            Role Dosen
                        </label>
                        <select name="role"
                            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs">
                            <option value="dosen" selected>Dosen</option>
                            <option value="kajur">Kajur</option>
                        </select>
                    </div>
                    <x-button_md color="primary" class="w-full col-span-12" type="submit">
                        Kirim
                    </x-button_md>
                </form>
            </div>
        </div>
    </section>
@endsection
