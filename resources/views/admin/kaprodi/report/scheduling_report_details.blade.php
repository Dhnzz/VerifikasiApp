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
        <p class="font-semibold text-base uppercase">{{ $data->name }}</p>
        <span class="text-xs text-slate-500">{{ $data->User->credential }}</span>
        <span class="text-slate-500 text-sm">Mahasiswa</span>
      </div>
    </div>
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow mt-4 p-6">
      <div class="col-span-12">
        <span class="text-xs text-slate-500">Dosen Verifikator : </span>
        <h4 class="font-semibold text-lg">
          {{ $data->Dosen->name }}
          <br>
          <span class="text-sm text-slate-500">{{ $data->Dosen->User->credential }}</span>
        </h4>
      </div>
    </div>
  </div>

  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4">

    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
      <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
        <span class=""><i class="fas fa-book text-xl"></i></span>
        <p class="text-xl font-semibold">{{ $data->periode->name }} - {{ $data->periode->templateBerkas->name }}</p>
      </div>
      <div class="col-span-12 detailContainer flex flex-col">
        <div class="col-span-12 mt-4 flex flex-col gap-y-2">
          <div class="flex flex-col">
            <span class="text-xs text-slate-500">Lama Periode : </span>
            <p class="text-sm">
              {{ date('j M Y', strtotime($data->periode->tgl_mulai)) }} -
              {{ date('j M Y',strtotime($data->periode->tgl_berakhir)) }}
              <span class="text-slate-500">({{ round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($data->periode->tgl_berakhir), false)) }}
                hari )</span>
            </p>
          </div>
        </div>
        <hr class="col-span-12 mt-4">
        <div class="flex flex-col gap-y-2 mt-4">
          @foreach ($data->periode->templateBerkas->itemBerkas as $item)
              
          <div class="inline-flex items-center p-4 bg-slate-100  justify-between w-full rounded-md">
            <p class="font-semibold ">
             {{$item->name}}
            </p>
            <x-button_md color="primary">
              <span>
                <i class="fas fa-eye"></i>
              </span>
              Lihat Berkas
            </x-button_md>
          </div>
          @endforeach

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