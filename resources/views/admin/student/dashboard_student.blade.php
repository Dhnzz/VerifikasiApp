@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen grid grid-cols-12 py-44 px-4 lg:px-12 gap-4">
  <div class="lg:col-span-4 col-span-12  w-full ">
    <div class="p-6 bg-white flex gap-4 items-center rounded-xl shadow-sm border border-slate-200">
      <div class=" relative w-fit">
        <img src="/avatar/placeholder.jpg" alt="" class="w-20 rounded-full object-cover">
        <button
          class="absolute right-0 bottom-0 inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-gray-800 bg-white hover:bg-slate-100 shadow-md border border-slate-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
          <i class="fas fa-pencil-alt text-xs"></i>
        </button>
      </div>
      <div class="flex flex-col ">
        <p class="font-semibold text-base uppercase">Mohamad Rafiq Daud </p>
        <span class="text-xs text-slate-500">S1 - Sistem Informasi</span>
        <span class="text-slate-500 text-sm">Mahasiswa</span>
      </div>
    </div>

    {{-- <div class="w-full bg-white border border-gray-200 rounded-lg shadow mt-4">
      <a href="#" class="w-full">
        <img class="rounded-t-lg w-full brightness-50" src="/images/hero-image/image.png" alt="" />
      </a>
      <div class="p-6">
        <div class="mb-8">
          <div class="flex gap-x-2 items-center text-color-primary-500">
            <span class=""><i class="fas fa-book text-lg"></i></span>
            <p class="text-lg font-semibold">Periode Praskripsi</p>
          </div>
          <p class="text-sm mt-1 text-slate-500">
            Semester Ganjil 2023/2024
          </p>
        </div>
        <div class="grid grid-flow-row divide-y-[1px]">
          <div class="flex items-center gap-4 font-semibold pb-4">
            <span class=""><i class="fas fa-clipboard-check text-xl"></i></span>
            <p class="text-sm">Lengkapi Berkas</p>
          </div>
          <div class="flex items-center gap-4 font-semibold py-4">
            <span class=""><i class="fas fa-print text-base"></i></span>
            <p class="text-sm">Template</p>
          </div>
          <div class="flex items-center gap-4 font-semibold pt-4">
            <span class=""><i class="fas fa-sign-out-alt text-base"></i></span>
            <p class="text-sm">Keluar</p>
          </div>
        </div>
      </div>
    </div> --}}

    {{-- kalau belum terdaftar dalam periode apapun --}}
    <div
      class="mt-4 relative overflow-visible bg-white p-6 rounded-xl w-full border border-color-danger-500 shadow-sm transition-all duration-300 ">
      <div class="flex items-start">
        <div class="">
          <span
            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
            <i class="fas fa-exclamation"></i>
          </span>
        </div>

        <p class="text-sm font-semibold text-color-danger-500">Kamu Belum Mendaftar Dalam Periode, Daftar Terlebih
          Dahulu</p>
      </div>
    </div>

  </div>
  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4">
    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
      <div class="col-span-2">
        <img src="/logo/ung.png" alt="" class="w-16">
      </div>
      <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500 mt-8">
        <span class=""><i class="fas fa-book text-xl"></i></span>
        <p class="text-xl font-semibold">Perode Praskripsi</p>
      </div>
      <div class="col-span-12 mt-4 flex flex-col gap-y-2">
        <div class="flex flex-col">
          <span class="text-xs text-slate-500">Kode Periode: </span>
          <p class="text-sm">541341243</p>
        </div>
        <div class="flex flex-col">
          <span class="text-xs text-slate-500">Lama Periode : </span>
          <p class="text-sm">14 Agu 2023 - 31 Des 2023 <span class="text-slate-500">(1 bulan)</span></p>
        </div>
      </div>
      <hr class="col-span-12 mt-4">
      <div class="col-span-12 mt-4 flex flex-col gap-y-4">
        <div class="flex items-center">
          <span
            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
            <i class="fas fa-check"></i>
          </span>
          <a href="" class="text-sm font-semibold text-color-primary-500 underline">Surat Keterangan Tidak Mampu</a>
        </div>
        <div class="flex items-center">
          <span
            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
            <i class="fas fa-check"></i>
          </span>
          <a href="" class="text-sm font-semibold text-color-primary-500 underline">Surat Berak Dicelana</a>
        </div>
        <div class="flex items-center">
          <span
            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
            <i class="fas fa-check"></i>
          </span>
          <a href="" class="text-sm font-semibold text-color-primary-500 underline">Surat Berak Dicelana</a>
        </div>
      </div>
      <hr class="col-span-12 mt-4">
      <div class="col-span-12 mt-4">
        <x-button_md color="primary" type="submit">
          Daftar
        </x-button_md>
      </div>
    </div>
  </div>
</section>
@endsection