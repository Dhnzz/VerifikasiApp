@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center py-32 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Laporan Senin</p>
      <p class="text-sm text-slate-500">24 Agu 2024</p>
    </div>
    <div class="mt-12">
      <form action="" class=" w-full">
        <div class="mb-4">
          <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Deskripsi Kegiatan
          </label>
          <textarea id="deskripsi" placeholder="Deskripsi Kegiatan"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
          </textarea>
        </div>
        <div class="mb-4">
          <label for="rencana" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Rencana Kegiatan
          </label>
          <textarea id="rencana" placeholder="Rencana Kegiatan Kegiatan"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
          </textarea>
        </div>
        <div class="mb-4">
          <label for="persentase" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Persentase Pencapaian
          </label>
          <input type="number" max="100" id="persentase" placeholder="Persentase Pencapaian"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <div class="mb-4">
          <label for="hambatan" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Hambatan Dalam Kegiatan
          </label>
          <textarea id="hambatan" placeholder="Hambatan Kegiatan"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
          </textarea>
        </div>
        <div class="mb-4">
          <label for="solusi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Rencana Solusi
          </label>
          <textarea id="solusi" placeholder="Rencana Solusi"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
          </textarea>
        </div>
        <x-button_md color="primary" class="w-full">
          Kirim
        </x-button_md>
      </form>
    </div>
  </div>
</section>
@endsection