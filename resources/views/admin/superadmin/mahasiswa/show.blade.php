@extends('layout.admin')

@section('main')
    <section class="max-w-screen-lg min-h-screen mx-auto py-32 px-4 lg:px-12 grid grid-cols-2 grid-rows-2 gap-4">
        <!-- Box Data Mahasiswa -->
        <div class="row-span-1 col-span-1 p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="w-full flex flex-col items-center">
                <p class="font-semibold text-lg">Detail Data Mahasiswa</p>
            </div>
            <div class="mt-4">
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        NIM
                    </label>
                    <input type="text" placeholder="NIM" name="credential" value="{{ $data->user->credential }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs disable" />
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        Nama Mahasiswa
                    </label>
                    <input type="text" placeholder="Nama Lengkap" name="name" value="{{ $data->name }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        Angkatan
                    </label>
                    <input type="text" placeholder="Angkatan Akademik" name="angkatan" value="{{ $data->angkatan }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                </div>
            </div>
        </div>

        <!-- Box Data Kelengkapan Berkas -->
        <div class="row-span-1 col-span-1 p-10 bg-gray-200 rounded-xl border border-slate-300 shadow-sm flex flex-col">
            <div class="mb-4 text-center">
                <p class="font-semibold text-lg">Kelengkapan Berkas</p>
            </div>
            <ul class="space-y-4">
                <li class="flex justify-between items-center bg-gray-300 p-4 rounded-md">
                    <div>
                        <p class="font-semibold">Nama Berkas: <span class="font-normal">Berkas Akademik</span></p>
                        <p class="text-sm">Deskripsi: <span class="font-normal">Berkas yang berkaitan dengan status akademik mahasiswa.</span></p>
                    </div>
                    <div>
                        <p class="text-right font-semibold">Status: <span class="text-red-500">{{ $data->status_berkas ?? 'Belum Lengkap' }}</span></p>
                    </div>
                </li>
                <li class="flex justify-between items-center bg-gray-300 p-4 rounded-md">
                    <div>
                        <p class="font-semibold">Nama Berkas: <span class="font-normal">Berkas Keuangan</span></p>
                        <p class="text-sm">Deskripsi: <span class="font-normal">Berkas yang berkaitan dengan keuangan mahasiswa.</span></p>
                    </div>
                    <div>
                        <p class="text-right font-semibold">Status: <span class="text-red-500">{{ $data->status_berkas ?? 'Belum Lengkap' }}</span></p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Box Data Dosen Verifikator -->
        @if ($data->dosen)
        <div class="row-span-1 col-span-2 p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="mb-4 text-center">
                <p class="font-semibold text-lg">Data Dosen Verifikator</p>
            </div>
            <div class="mb-4">
                <label for="dosen_verifikator"
                    class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                    Nama Dosen Verifikator
                </label>
                <input type="text" placeholder="Nama Dosen Verifikator" name="dosen_verifikator"
                    value="{{ $data->dosen->name }}"
                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "
                    disabled />
            </div>
            <div class="mb-4">
                <label for="dosen_verifikator_nip"
                    class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                    NIP Dosen Verifikator
                </label>
                <input type="text" placeholder="NIP Dosen Verifikator" name="dosen_verifikator_nip"
                    value="{{ $data->dosen->user->credential }}"
                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "
                    disabled />
            </div>
        </div>
        @else
        <div class="row-span-1 col-span-2 p-4 border border-red-500 rounded-md bg-red-100">
            <p class="text-red-500">Belum ada dosen yang memverifikasi</p>
        </div>
        @endif
    </section>
@endsection

