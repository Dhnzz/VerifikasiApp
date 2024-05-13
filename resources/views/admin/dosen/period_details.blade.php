@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl min-h-screen mx-auto grid grid-cols-12 py-32 px-4 lg:px-12 gap-4">
  <div class="col-span-12 grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="col-span-2">
      <img src="/images/avatar/mitra.png" alt="" class="w-16">
    </div>
    <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500 mt-2">
      <span class=""><i class="fas fa-book text-lg"></i></span>
      <p class="text-lg font-semibold">Periode Praskripsi</p>
    </div>
    <div class="col-span-12 mt-4 flex flex-col gap-y-2">
      <div class="flex flex-col">
        <span class="text-xs text-slate-500">Kode Periode: </span>
        <p class="text-sm">541341243</p>
      </div>
      <div class="flex flex-col">
        <span class="text-xs text-slate-500">Lama Periode: </span>
        <p class="text-sm">14 Agu 2023 - 31 Des 2023 <span class="text-slate-500">(5 bulan)</span></p>
      </div>
    </div>
  </div>

  <div class="col-span-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="col-span-12">
      <div class="flex gap-x-2 items-center text-color-primary-500">
        <span class=""><i class="fas fa-book text-lg"></i></span>
        <p class="text-lg font-semibold">Periode Praskripsi</p>
      </div>
    </div>
    <div class="mt-4 col-span-12 flex gap-x-4">
      <label for="username" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white sr-only">Masukan Nama
        Pengguna</label>
      <input type="text" id="username" placeholder="Cari Nama Mahasiswa, Nim"
        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
      <button type="button"
        class="px-5 py-2.5 w-fit text-sm font-medium text-white inline-flex items-center bg-color-primary-500 rounded-lg text-center ">
        <span class=""><i class="fas fa-search text-lg "></i></span>
      </button>
    </div>
  </div>

  <div class="col-span-4">
    <p class="text-sm mb-2 italic">Total Mahasiswa : <span>80</span></p>
    <div class="max-h-[42rem] overflow-y-auto flex flex-col gap-y-2 p-2">
      <div
        class="relative overflow-visible bg-white p-6 rounded-xl w-full flex gap-x-4 border border-slate-200 shadow-sm hover:border-color-primary-500 hover:bg-slate-50 transition-all duration-300">
        <div class="w-16 rounded-full">
          <img src="/avatar/placeholder.jpg" alt="" class="rounded-full">
        </div>
        <div>
          <p class="font-semibold text-sm">Mohamad Rafiq Daud</p>
          <p class="text-sm">531421003</p>
          <div class="flex gap-x-2 items-center text-color-primary-500">
            <span class=""><i class="fas fa-book text-sm"></i></span>
            <p class="text-sm font-semibold">Kampus Mengajar</p>
          </div>
        </div>
      </div>
      <div
        class="relative overflow-visible bg-white p-6 rounded-xl w-full flex gap-x-4 border border-slate-200 shadow-sm hover:border-color-primary-500 hover:bg-slate-50 transition-all duration-300">
        <div class="w-16 rounded-full">
          <img src="/avatar/placeholder.jpg" alt="" class="rounded-full">
        </div>
        <div>
          <p class="font-semibold text-sm">Mohamad Rafiq Daud</p>
          <p class="text-sm">531421003</p>
          <div class="flex gap-x-2 items-center text-color-primary-500">
            <span class=""><i class="fas fa-book text-sm"></i></span>
            <p class="text-sm font-semibold">Kampus Mengajar</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4">
    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
      <div class="col-span-2">
        <img src="/avatar/placeholder.jpg" alt="" class="w-16 rounded-full">
      </div>
      <div class="col-span-12 mt-4">
        <h4 class="font-semibold text-lg">Mohamad Rafiq Daud</h4>
      </div>
      <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500 mt-2">
        <span class=""><i class="fas fa-book text-sm"></i></span>
        <p class="text-sm font-semibold">Periode Praskripsi</p>
      </div>
      <div class="col-span-12 mt-4 flex flex-col gap-y-2">
        <div class="flex flex-col">
          <span class="text-xs text-slate-500">NIM: </span>
          <p class="text-sm">541341243</p>
        </div>
        <div class="flex flex-col">
          <span class="text-xs text-slate-500">Angkatan : </span>
          <p class="text-sm">14 Agu 2023 - 31 Des 2023 <span class="text-slate-500">(5 bulan)</span></p>
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
    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
      <div class="col-span-12 flex flex-col gap-y-2">
        <h4 class="text-xl font-semibold">Lokasi Kegiatan</h4>
        <p class="text-sm">Kamu akan mengikuti kegiatan dari tanggal 14 Agu - 31 Des 2023.</p>
      </div>
    </div>
  </div>
</section>
@endsection