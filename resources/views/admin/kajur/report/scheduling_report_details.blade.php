@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen grid grid-cols-12 py-44 px-4 lg:px-12 gap-4">
  <div class="lg:col-span-4 col-span-12 w-full">
    <div class="p-6 bg-white flex gap-4 items-center rounded-xl shadow-sm border border-slate-200">
      <div class="relative w-fit">
        <img src="/avatar/placeholder.jpg" alt="" class="w-20 rounded-full object-cover">
        <button
          class="absolute right-0 bottom-0 inline-flex items-center justify-center w-6 h-6 text-sm font-semibold text-gray-800 bg-white hover:bg-slate-100 shadow-md border border-slate-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
          <i class="fas fa-pencil-alt text-xs"></i>
        </button>
      </div>
      <div class="flex flex-col">
        <p class="font-semibold text-base uppercase">Rafiq</p>
        <span class="text-xs text-slate-500">531421003</span>
        <span class="text-slate-500 text-sm">Mahasiswa</span>
      </div>
    </div>
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow mt-4 p-6">
      <div class="col-span-12">
        <span class="text-xs text-slate-500">Dosen Verifikator : </span>
        <h4 class="font-semibold text-lg">
          ical
          <br>
          <span class="text-sm text-slate-500">531421002</span>
        </h4>
      </div>
    </div>
  </div>

  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4">

    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
      <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
        <span class=""><i class="fas fa-book text-xl"></i></span>
        <p class="text-xl font-semibold">Nama Periode - Nama Tempalte Berkas</p>
      </div>
      <div class="col-span-12 detailContainer flex flex-col">
        <div class="col-span-12 mt-4 flex flex-col gap-y-2">
          <div class="flex flex-col">
            <span class="text-xs text-slate-500">Lama Periode : </span>
            <p class="text-sm">
              12 Sept 2023 - 12 sept 20223
              <span class="text-slate-500">(2
                hari)</span>
            </p>
          </div>
        </div>
        <hr class="col-span-12 mt-4">
        <div class="flex flex-col gap-y-2 mt-4">
          <div class="inline-flex items-center p-4 bg-slate-100  justify-between w-full rounded-md">
            <p class="font-semibold ">
              Nama Berkas 1
            </p>
            <x-button_md color="primary" onclick="modalOpen()">
              <span>
                <i class="fas fa-eye"></i>
              </span>
              Lihat Berkas
            </x-button_md>
            <div id="modal"
              class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/30 hidden">
              <div class="max-w-2xl w-full p-6 rounded-xl h-[80vh] overflow-hidden">
                <div class="w-full inline-flex items-center justify-between text-white">
                  <p class="text-lg font-semibold">Nama Berkas</p>
                  <button id="close-modal" class="px-3 py-1.5 rounded-lg hover:bg-slate-500 text-white"
                    onclick="closeModal()">
                    <i class="fas fa-times text-lg"></i>
                  </button>
                </div>
                <embed src="" type="" class="mt-4 w-full h-full">
              </div>
            </div>
          </div>
          <div class="inline-flex items-center p-4 bg-slate-100  justify-between w-full rounded-md">
            <p class="font-semibold ">
              Nama Berkas 2
            </p>
            <x-button_md color="primary">
              <span>
                <i class="fas fa-eye"></i>
              </span>
              Lihat Berkas
            </x-button_md>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function modalOpen() {
        const modal = document.getElementById(`modal`);
        modal.classList.remove('hidden');
        modal.classList.add('flex')
    }

    function closeModal() {
        const modal = document.getElementById(`modal`)
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

</script>
@endsection