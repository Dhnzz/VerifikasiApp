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
  </div>
  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4 max-h-[40rem] overflow-y-auto">
    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
      <button class="col-span-12 inline-flex justify-between items-center" onclick="openDetails(this, event)">
        <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
          <span class=""><i class="fas fa-book text-xl"></i></span>
          <p class="text-xl font-semibold">Perode Praskripsi</p>
        </div>
        <span><i class="fas fa-chevron-down text-sm"></i></span>
      </button>
      <div class="col-span-12 detailContainer flex flex-col hidden">
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
      </div>
      <hr class="col-span-12 mt-4">
      <div class="col-span-12 mt-4">
        <x-button_md color="primary" type="submit">
          Detail 
        </x-button_md>
      </div>
    </div>
  </div>
</section>
<script>
  function openDetails(button, event) {
            event.preventDefault();
            const detailContainer = button.nextElementSibling;
            detailContainer.classList.toggle('hidden');
        }
</script>
@endsection