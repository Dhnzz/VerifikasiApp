@extends('layout.admin')

@section('main')
    <section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center py-32 px-4 lg:px-12 gap-4">
        <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="w-full flex flex-col items-center">
                <p class="font-semibold text-lg">Detail Data Dosen</p>
            </div>
            <div class="mt-12">
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        NIDN
                    </label>
                    <input type="text" placeholder="NIDN" name="credential" value="{{ $data->user->credential }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        Nama Dosen
                    </label>
                    <input type="text" placeholder="Nama Lengkap" name="name" value="{{ $data->name }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                </div>
            </div>
            <hr class="my-4 border-gray-300">
            <div class="w-full flex flex-col items-center">
                <p class="font-semibold text-lg">Data Mahasiswa</p>
            </div>
        <div class="w-full">
            <ul class="list-disc pl-5">
                <li>Mahasiswa 1 - NIM: 123456</li>
                <li>Mahasiswa 2 - NIM: 123457</li>
                <li>Mahasiswa 3 - NIM: 123458</li>
                <li>Mahasiswa 4 - NIM: 123459</li>
                <li>Mahasiswa 5 - NIM: 123460</li>
            </ul>
        </div>
        </div>
    </section>
@endsection
