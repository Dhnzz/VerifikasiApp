@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex items-center py-44 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Nama Template</p>
    </div>
    <div class="mt-4">
      <form id="main-form" action="{{ route('mahasiswa.store') }}" method="post" class="w-full">
        @csrf
        <div class="mb-4">
          <div class="inline-flex justify-between items-end w-full mb-4">
            <label for="berkas_kegiatan" class="block mb-2 font-semibold text-gray-900 dark:text-white">
              Berkas Kegiatan
            </label>
            <x-button_sm color="primary" class="col-span-12 w-fit" onclick="addBerkas(event)">
              <span><i class="fas fa-plus"></i></span>
            </x-button_sm>
          </div>
          <div id="berkas-container" class="flex flex-col gap-y-2">
            <!-- Statis berkas section -->
            <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
              <button class="flex justify-between" onclick="openDetails(this, event)">
                <p class="font-semibold">Berkas</p>
                <span><i class="fas fa-chevron-down text-sm"></i></span>
              </button>
              <div class="detailContainer flex flex-col">
                <div class="mb-4">
                  <label for="nama_berkas" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                    Nama Berkas
                  </label>
                  <input type="text" name="nama_berkas[]" id="nama_berkas_statis" placeholder="Masukan Nama Berkas"
                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                </div>
                <div>
                  <x-button_sm color="primary" class="edit-button" id="toggle_modal" onclick="modalOpen()">
                    Aksi
                  </x-button_sm>
                </div>
              </div>
            </div>
            <!-- Dynamic berkas section will be added here -->
          </div>
        </div>
        <x-button_md color="primary" class="w-full col-span-12" type="submit">
          Kirim
        </x-button_md>
      </form>
      {{-- modal --}}
      <div id="modal" class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/25 hidden">
        <div class="max-w-lg w-full p-6 bg-white rounded-xl">
          <div class="w-full inline-flex items-center justify-between">
            <p class="text-lg font-semibold">Berkas 1</p>
            <button id="close-modal" class="px-3 py-1.5 rounded-lg hover:bg-slate-100 text-slate-500"
              onclick="modalOpen()">
              <i class="fas fa-times text-lg"></i>
            </button>
          </div>
          <hr class="mt-4 mb-4">
          <div class="mb-4">
            <form action="">
              <label for="nama_berkas_modal" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                Nama Berkas
              </label>
              <input type="text" name="nama_berkas_modal" id="nama_berkas_modal" placeholder="Masukan Nama Berkas"
                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
            </form>
          </div>
          <hr class="mt-4 mb-4">
          <div class="inline-flex items-center gap-x-2">
            <x-button_md color="primary" type="submit">
              Edit
            </x-button_md>
            <x-button_md color="danger" type="submit">
              Hapus
            </x-button_md>
          </div>
        </div>
      </div>
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
    berkasDiv.id = `berkas${berkasCount}`;
    berkasDiv.innerHTML = `
            <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
              <button class="flex justify-between" onclick="openDetails(this, event)">
                <p class="font-semibold">Berkas</p>
                <span><i class="fas fa-chevron-down text-sm"></i></span>
              </button>
              <div class="detailContainer flex flex-col hidden">
                <div class="mb-4">
                  <label for="nama_berkas" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                    Nama Berkas
                  </label>
                  <input type="text" name="nama_berkas[]" id="nama_berkas${berkasCount}"
                    placeholder="Masukan Nama Berkas"
                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                </div>
                <div>
                  <x-button_sm color="danger" class="" onclick="removeBerkas(${berkasCount}, event)">
                    <i class="fas fa-trash text-sm"></i> Hapus Berkas
                  </x-button_sm>
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

  function removeBerkas(berkasId, event) {
    event.preventDefault();
    const berkasDiv = document.getElementById(`berkas${berkasId}`);
    berkasDiv.remove();
  }

  function toggleEditButton(input) {
    const editButton = input.closest('.detailContainer').querySelector('.edit-button');
    if (input.value) {
      editButton.classList.remove('hidden');
    } else {
      editButton.classList.add('hidden');
    }
  }

  function modalOpen() {
    const modal = document.getElementById('modal');
    modal.classList.toggle('hidden');
  }

</script>
@endsection