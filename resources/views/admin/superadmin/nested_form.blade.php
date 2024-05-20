@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center py-32 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Laporan Senin</p>
      <p class="text-sm text-slate-500">24 Agu 2024</p>
    </div>
    <div class="mt-12">

      <div class="mt-12">
        <form method="POST" class="w-full grid grid-cols-12 gap-4">
          <div class="col-span-6 flex items-center gap-x-2">
            <label for="deskripsi" class="block text-xs xl:text-sm text-gray-900 dark:text-white">
              Jumlah Kegiatan :
            </label>
            <input type="number" max="100" name="jumlah" id="persentase" placeholder="Jumlah"
              class="block p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs "
              oninput="updateKegiatan()" />
          </div>
          <div id="kegiatan-container" class="col-span-12">

          </div>
          <x-button_md color="primary" class="w-full col-span-12">
            Kirim
          </x-button_md>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
  function updateKegiatan() {
            // Ambil nilai jumlah kegiatan dari input
            var jumlahKegiatan = parseInt(document.getElementById('persentase').value);

            // Ambil kontainer div untuk menempatkan kegiatan
            var kegiatanContainer = document.getElementById('kegiatan-container');

            // Hapus semua kegiatan sebelum menambahkan yang baru
            kegiatanContainer.innerHTML = '';

            // Buat jumlah kegiatan sesuai dengan nilai yang dimasukkan
            for (var i = 1; i <= jumlahKegiatan; i++) {
                var kegiatanDiv = document.createElement('div');
                kegiatanDiv.className = 'mb-4';
                kegiatanDiv.innerHTML = `
                <div class=" p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
                    <button class="flex justify-between" onclick="openDetails(this, event)">
                        <p class="font-semibold">Kegiatan ${i}</p>
                        <span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div class="detailContainer flex flex-col">
                        @csrf
                        <div class="mb-4">
                            <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                Deskripsi Kegiatan
                            </label>
                            <textarea name="deskripsi${i}" id="deskripsi" placeholder="Deskripsi Kegiatan"
                                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="rencana" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                Rencana Kegiatan
                            </label>
                            <textarea name="rencana${i}" id="rencana" placeholder="Rencana Kegiatan Kegiatan"
                                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "></textarea>
                        </div>
                        <div class="mb-4">
                        <label for="jam_mulai" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                            Jam Mulai
                        </label>
                        <input type="time" name="jam_mulai${i}" id="jam_mulai" class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                    </div>

                    <div class="mb-4">
                        <label for="jam_selesai" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                            Jam Selesai
                        </label>
                        <input type="time" name="jam_selesai${i}" id="jam_selesai" class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                    </div>

                        <div class="mb-4">
                            <label for="persentase" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                Persentase Pencapaian
                            </label>
                            <input type="number" max="100" name="persentase${i}" id="persentase"
                                placeholder="Persentase Pencapaian"
                                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
                        </div>
                        <div class="mb-4">
                            <label for="hambatan" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                Hambatan Dalam Kegiatan
                            </label>
                            <textarea name="hambatan${i}" id="hambatan" placeholder="Hambatan Kegiatan"
                                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="solusi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                Rencana Solusi
                            </label>
                            <textarea name="solusi${i}" id="solusi" placeholder="Rencana Solusi"
                                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "></textarea>
                        </div>
                    </div>
                </div>
            `;
                kegiatanContainer.appendChild(kegiatanDiv);
            }
        }
</script>
@endsection