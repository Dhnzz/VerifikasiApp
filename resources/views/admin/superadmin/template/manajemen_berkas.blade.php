@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center py-44 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">{{$data->name}}</p>
    </div>
    <div class="mt-4">
      <form action="{{ route('itemberkas.store') }}" method="post" class="w-full">
        @csrf
        <div class="mb-4">
          <div class="inline-flex justify-between items-end w-full mb-4">
            <label for="berkas_kegiatan" class="block mb-2 font-semibold text-gray-900 dark:text-white">
              Berkas
            </label>
            <x-button_sm color="primary" class="col-span-12 w-fit" onclick="addBerkas(event)">
              <span><i class="fas fa-plus"></i></span>
            </x-button_sm>
          </div>
          <div id="berkas-container" class="flex flex-col gap-y-4">
            <!-- Berkas sections will be added here -->
            @foreach ($data->itemBerkas as $item)
            <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
              <button class="flex justify-between" onclick="openDetails(this, event)">
                <p class="font-semibold">Berkas ${berkasCount}</p>
                <span><i class="fas fa-chevron-down text-sm"></i></span>
              </button>
              <div class="detailContainer flex flex-col hidden">
                <div class="mb-4">
                  <label for="nama_berkas" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                    Nama Berkas
                  </label>
                  <input type="text" name="{{($data->itemBerkas->count() > 0 ? '' : 'name[]')}}" id="nama_berkas${berkasCount}" placeholder="Masukan Nama Berkas"
                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" disable value="{{$item->name}}" />
                  <input type="hidden" name="template_berkas_id[]" id="nama_berkas${berkasCount}" value="{{$data->id}}" />
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <x-button_md color="primary" class="w-full col-span-12" type="submit">
          Kirim
        </x-button_md>
      </form>
    </div>
  </div>
</section>
<script>
  let berkasCount = 0;

  function addBerkas(event) {
    event.preventDefault();
    berkasCount++;

    const berkasContainer = document.getElementById('berkas-container');

    const berkasDiv = document.createElement('div');
    berkasDiv.className = 'berkas mb-4';
    berkasDiv.innerHTML = `
    <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
      <button class="flex justify-between" onclick="openDetails(this, event)">
        <p class="font-semibold">Berkas ${berkasCount}</p>
        <span><i class="fas fa-chevron-down text-sm"></i></span>
      </button>
      <div class="detailContainer flex flex-col hidden">
        <div class="mb-4">
          <label for="nama_berkas" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Berkas
          </label>
          <input type="text" name="name[]" id="nama_berkas${berkasCount}" placeholder="Masukan Nama Berkas"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
          <input type="hidden" name="template_berkas_id[]" id="nama_berkas${berkasCount}" value="{{$data->id}}" />
        </div>
      </div>
    </div>
    `;
    berkasContainer.appendChild(berkasDiv);
  }

  function openDetails(button, event) {
    event.preventDefault();
    const detailContainer = button.nextElementSibling;
    detailContainer.classList.toggle('hidden');
  }
</script>
@endsection