@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto pt-44 pb-20 px-4 lg:px-6 grid grid-cols-12 gap-4">
    <div class="col-span-8 grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
        <div class="col-span-2">
            <img src="/avatar/placeholder.jpg" alt="" class="w-16 rounded-full">
        </div>
        <div class="col-span-12 mt-4">
            <h4 class="font-semibold text-lg">{{ $data->name }}</h4>
        </div>
        <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500 mt-2">
            <span class=""><i class="fas fa-book text-sm"></i></span>
            <p class="text-sm font-semibold">Periode Praskripsi</p>
        </div>
        <div class="col-span-12 mt-4 flex flex-col gap-y-2">
            <div class="flex flex-col">
                <span class="text-xs text-slate-500">NIM: </span>
                <p class="text-sm">{{ $data->user->credential }}</p>
            </div>
            <div class="flex flex-col">
                <span class="text-xs text-slate-500">Angkatan : </span>
                <p class="text-sm">{{ $data->angkatan }}</p>
            </div>
        </div>
        <hr class="col-span-12 mt-4">
        <div class="col-span-12 mt-4 flex flex-col gap-y-4">
            <div class="flex items-center">
                <span
                    class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
                    <i class="fas fa-check"></i>
                </span>
                <p class="text-sm font-semibold">Surat Keterangan Tidak Mampu</p>
            </div>
            <div class="flex items-center">
                <span
                    class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                    <i class="fas fa-times"></i>
                </span>
                <p class="text-sm font-semibold">Surat Suka Berak</p>
            </div>
            <div class="flex items-center">
                <span
                    class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                    <i class="fas fa-times"></i>
                </span>
                <p class="text-sm font-semibold">Surat Makan Ketiak</p>
            </div>
        </div>
    </div>
    <div class="col-span-4 flex flex-col gap-y-2">
        <p>Dosen Verifikator : </p>
        <div
            class="relative overflow-visible bg-white p-6 rounded-xl w-full flex gap-x-4 border border-color-primary-500 shadow-sm items-center">
            <div class="w-16 rounded-full">
                <img src="/avatar/placeholder.jpg" alt="" class="rounded-full">
            </div>
            <div class="flex flex-col gap-y-1">
                <p class="font-semibold text-sm">Mohamad Rafiq Daud</p>
                <p class="text-sm">531421003</p>
            </div>
        </div>
        {{-- ini kalo tidak ada verifikator --}}
        <div
            class="relative overflow-visible bg-white p-6 rounded-xl w-full border border-color-danger-500 shadow-sm transition-all duration-300 ">
            <div class="flex items-center">
                <span
                    class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                    <i class="fas fa-exclamation"></i>
                </span>
                <p class="text-sm font-semibold text-color-danger-500">Belum Memiliki Dosen Verifikator</p>
            </div>
        </div>
    </div>



</section>
@endsection