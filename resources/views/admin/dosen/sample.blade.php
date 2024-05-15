@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen grid grid-cols-12 py-40 px-4 lg:px-12 gap-4">
  <div class="col-span-4 w-full">
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
      <a href="#" class="w-full">
        <img class="rounded-t-lg w-full brightness-50" src="/images/hero-image/image.png" alt="" />
      </a>
      <div class="p-6">
        <div class="mb-8">
          <div class="flex justify-between items-center">
            <div class="flex gap-x-2 items-center text-color-primary-500">
              <span class=""><i class="fas fa-book text-sm"></i></span>
              <p class="text-sm font-semibold">Kampus Mengajar</p>
            </div>
            <span>
              <span class=""><i class="fas fa-chevron-right text-xs"></i></span>
            </span>
          </div>
          <p class="text-base mt-1">
            SDN 6 Telaga Biru Kota Gorontalo
          </p>
          <p class="text-sm mt-1 text-slate-500">
            Semester Ganjil 2023/2024
          </p>
          <div class="mt-3 flex flex-col gap-y-1">
            <span class="text-sm mt-1 font-semibold">
              MITRA/Guru Pamong :
            </span>
            <p class="uppercase text-sm">
              Suryato Bilal Bil Halal
            </p>
          </div>
          <div class="mt-3 flex flex-col gap-y-1">
            <p class="text-sm mt-1 font-semibold">
              DPL :
            </p>
            <p class="uppercase text-sm">
              Ali Bin Abi Thalib
            </p>
          </div>

        </div>
        <div class="flex items-center gap-4 font-semibold pb-4">
          <span class=""><i class="fas fa-hourglass-half text-base"></i></span>
          <p class="text-sm">2 Logbook menunggu disetujui</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-span-8 w-full flex flex-col gap-y-2">
    <div class="p-8 bg-white w-full rounded-xl broder border-gray-200 shadow ">
      <div class="flex justify-between">
        <div class="flex flex-col gap-y-1">
          <div class="flex gap-x-2 items-center text-color-danger-500">
            <span class=""><i class="fas fa-marker text-sm"></i></span>
            <p class="text-sm font-semibold">Belum Dibuat</p>
          </div>
          <p class="font-semibold">16 - 20 Agu 2021</p>
          <p class="text-sm text-slate-500">Minggu Ke-1</p>
        </div>
        <div class="flex gap-x-2">
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">S</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
              <i class="fas fa-check text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">S</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">R</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">K</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">J</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
        </div>
      </div>
      <hr class="mt-4 mb-4">
      <div class="flex flex-col justify-center items-start">
        <button type="button"
          class="text-white h-full bg-color-primary-500 hover:bg-color-primary-600 focus:ring-4 focus:ring-color-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
          Lengkapi Laporan Harian
        </button>
        <p class="text-sm text-slate-500">Laporan mingguan dapat di isi ketika laporan harian sudah lengkap</p>
      </div>
    </div>
    <div class="p-8 bg-white w-full rounded-xl broder border-gray-200 shadow">
      <div class="flex justify-between">
        <div class="flex flex-col gap-y-1">
          <div class="flex gap-x-2 items-center text-color-danger-500">
            <span class=""><i class="fas fa-marker text-sm"></i></span>
            <p class="text-sm font-semibold">Belum Dibuat</p>
          </div>
          <p class="font-semibold">16 - 20 Agu 2021</p>
          <p class="text-sm text-slate-500">Minggu Ke-1</p>
        </div>
        <div class="flex gap-x-2">
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">S</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
              <i class="fas fa-check text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">S</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">R</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">K</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
          <div class="flex flex-col items-center justify-center">
            <span class="font-semibold text-slate-500">J</span>
            <span
              class=" inline-flex items-center justify-center w-12 h-12 text-sm font-semibold text-slate-800 bg-gray-300 rounded-full ">
              <i class="fas fa-exclamation text-lg"></i>
            </span>
          </div>
        </div>
      </div>
      <hr class="mt-4 mb-4">
      <div class="flex flex-col justify-center items-start">
        <button type="button"
          class="text-white h-full bg-color-primary-500 hover:bg-color-primary-600 focus:ring-4 focus:ring-color-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
          Lengkapi Laporan Harian
        </button>
        <p class="text-sm text-slate-500">Laporan mingguan dapat di isi ketika laporan harian sudah lengkap</p>
      </div>
    </div>
  </div>
</section>
@endsection