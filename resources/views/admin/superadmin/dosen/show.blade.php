@extends('layout.admin')

@section('main')
    <section class="max-w-screen-lg min-h-screen mx-auto grid grid-cols-12 pt-44 pb-20 px-4 lg:px-12 gap-4">
        <div class="col-span-12 w-full h-fit p-8 bg-white rounded-xl border border-slate-200 shadow-sm">
            <div>
                <p class="font-semibold text-lg">Detail Data Dosen</p>
            </div>
            <div class="mt-4">
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        NIDN
                    </label>
                    <input type="text" placeholder="NIDN" name="credential" value="{{ $data->user->credential }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "
                        disabled />
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        Nama Dosen
                    </label>
                    <input type="text" placeholder="Nama Lengkap" name="name" value="{{ $data->name }}"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "
                        disabled />
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                        Role
                    </label>
                    <input type="text" placeholder="Nama Lengkap" name="name" value="Dosen Pembimbing"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "
                        disabled />
                </div>
            </div>
        </div>
        @if ($data->user->role != 'kajur' && $data->user->role != 'kaprodi' && $data->user->role != 'admin')
            <div class="col-span-12 w-full">
                <p class="mt-4">Total Mahasiswa : </p>
                @if ($data->Mahasiswa > 0)
                    <div class="mt-4 max-h-[42rem] overflow-y-auto flex flex-col gap-y-2">
                        <div
                            class="relative overflow-visible bg-white p-6 rounded-xl w-full flex gap-x-4 border border-color-primary-500 shadow-sm items-center">
                            <div class="w-16 rounded-full">
                                <img src="/avatar/placeholder.jpg" alt="" class="rounded-full">
                            </div>
                            <div class="flex flex-col gap-y-1">
                                <p class="font-semibold text-sm">Mohamad Rafiq Daud</p>
                                <p class="text-sm">531421003</p>
                                <div class="flex gap-x-2 items-center text-color-primary-500">
                                    <span class=""><i class="fas fa-book text-sm"></i></span>
                                    <p class="text-sm font-semibold">Nama Periode Terdaftar</p>
                                </div>
                            </div>
                        </div>
                @elseif ($data->Mahasiswa == 0)
                        <div class="w-full flex flex-col items-center justify-center gap-y-4 py-12">
                            <img src="/illustration/Caution.png" alt="" class="w-40">
                            <p class="font-semibold text-lg text-color-danger-500 ">Data Mahasiswa Tidak Tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </section>
@endsection
