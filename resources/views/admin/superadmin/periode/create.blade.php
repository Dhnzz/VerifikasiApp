@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex flex-col items-center py-48 px-4 lg:px-12 gap-4">
  <div class="w-full p-6 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Buka Periode Baru</p>
    </div>
    <div class="mt-6">
      <form action="" class="grid grid-cols-12 w-full gap-4">
        <div class="col-span-12">
          <label for="nama_periode" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Periode
          </label>
          <input type="text" name="name" id="nama_periode" placeholder="Masukan Nama Periode"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
        </div>
        <div class="col-span-12">
          <label for="deskripsi_periode" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Deskripsi Periode
          </label>
          <textarea name="deskripsi" id="deskripsi_periode" placeholder="Masukan Deskripsi Periode"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs"></textarea>
        </div>
        <div class="col-span-12 lg:col-span-6">
          <label for="tanggal_mulai" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Tanggal Mulai Periode
          </label>
          <input type="date" name="tgl_mulai" id="tanggal_mulai" placeholder="Tanggal Mulai Periode"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
        </div>
        <div class="col-span-12 lg:col-span-6">
          <label for="tanggal_berakhir" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Tanggal Berakhir Periode
          </label>
          <input type="date" name="tgl_akhir" id="tanggal_berakhir" placeholder="Tanggal Berakhir Periode"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
        </div>
        <div class="col-span-12 flex items-center gap-x-2 mt-4">
          <label for="jumlah_kegiatan" class="block text-xs xl:text-sm text-gray-900 dark:text-white">
            Jumlah Kegiatan :
          </label>
          <input type="number" max="100" name="jumlah_kegiatan" id="jumlah_kegiatan" placeholder="Jumlah"
            class="block p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs"
            oninput="updateKegiatan()" />
        </div>
        <div id="kegiatan-container" class="col-span-12">
          <!-- Dynamic activities will be appended here -->
        </div>
        <x-button_md color="primary" class="w-full col-span-12">
          Kirim
        </x-button_md>
      </form>
    </div>
  </div>
</section>
<script>
  // Open/close detail sections
  function openDetails(element, event) {
    const detailContainer = element.nextElementSibling;
    event.preventDefault();

    if (detailContainer.classList.contains('hidden')) {
      detailContainer.classList.remove('hidden');
      detailContainer.classList.add('flex');
    } else {
      detailContainer.classList.remove('flex');
      detailContainer.classList.add('hidden');
    }
  }

  // Update activities based on the input number
  function updateKegiatan() {
    const jumlahKegiatan = parseInt(document.getElementById('jumlah_kegiatan').value);
    const kegiatanContainer = document.getElementById('kegiatan-container');
    kegiatanContainer.innerHTML = '';

    for (let i = 1; i <= jumlahKegiatan; i++) {
      const kegiatanDiv = document.createElement('div');
      kegiatanDiv.className = 'mb-4';
      kegiatanDiv.innerHTML = `
        <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
          <button class="flex justify-between" onclick="openDetails(this, event)">
            <p class="font-semibold">Kegiatan ${i}</p>
            <span><i class="fas fa-chevron-down text-sm"></i></span>
          </button>
          <div class="detailContainer flex flex-col hidden">
            <div class="mb-4">
              <label for="nama_kegiatan${i}" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                Nama Kegiatan
              </label>
              <input type="text" name="nama_kegiatan${i}" id="nama_kegiatan${i}" placeholder="Masukan Nama Kegiatan"
                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
            </div>
            <div class="mb-4">
              <label for="deskripsi_kegiatan${i}" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                Deskripsi Kegiatan
              </label>
              <textarea name="deskripsi_kegiatan${i}" id="deskripsi_kegiatan${i}" placeholder="Deskripsi Kegiatan"
                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs"></textarea>
            </div>
            <div class="mb-4">
              <div class="inline-flex justify-between items-end w-full mb-4">
                <label for="berkas_kegiatan${i}_1" class="block mb-2 font-semibold text-gray-900 dark:text-white">
                  Berkas
                </label>
                <x-button_sm color="primary" class="col-span-12 w-fit" onclick="addBerkas(${i}, event)">
                  <span><i class="fas fa-plus"></i></span>
                </x-button_sm>
              </div>
              <div id="berkas-container${i}"berkas-container class="flex flex-col ">
                  <!-- Berkas sections will be added here -->
              </div>
              
            </div>
          </div>
        </div>
      `;
      kegiatanContainer.appendChild(kegiatanDiv);
    }
  }

  // Add berkas dynamically
  function addBerkas(activityIndex, event) {
    event.preventDefault();
    const berkasContainer = document.getElementById(`berkas-container${activityIndex}`);
    const berkasCount = berkasContainer.children.length + 1;

    const berkasDiv = document.createElement('div');
    berkasDiv.className = 'berkas mb-4';
    berkasDiv.innerHTML = `
    <div  class=" p-6 bg-white rounded-xl flex flex-col gap-y-4">
      <button class="flex justify-between" onclick="openDetails(this, event)">
        <p class="font-semibold">Berkas ${berkasCount}</p>
        <span><i class="fas fa-chevron-down text-sm"></i></span>
      </button>
      <div class="detailContainer flex flex-col hidden">
        <div class="mb-4">
          <label for="nama_berkas${activityIndex}_${berkasCount}" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Berkas
          </label>
          <input type="text" name="nama_berkas${activityIndex}_${berkasCount}" id="nama_berkas${activityIndex}_${berkasCount}" placeholder="Masukan Nama Berkas"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
        </div>
        <div class="mb-4">
          <label for="template_berkas${activityIndex}_${berkasCount}" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Template Berkas
          </label>
          <input type="file" name="template_berkas${activityIndex}_${berkasCount}" id="template_berkas${activityIndex}_${berkasCount}" placeholder="Template Berkas"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
        </div>
      </div>
    </div>
    `;
    berkasContainer.appendChild(berkasDiv);
  }
</script>
@endsection