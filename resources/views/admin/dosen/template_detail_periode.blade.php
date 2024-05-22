@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl min-h-screen mx-auto grid grid-cols-12 py-44 px-4 lg:px-12 gap-4">
  <div class="col-span-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="col-span-12">
      <div class="flex gap-x-2 items-center text-color-primary-500">
        <span class=""><i class="fas fa-book text-lg"></i></span>
        <p class="text-lg font-semibold">asdasdas</p>
      </div>
    </div>
    <form action="" class="mt-4 col-span-12 flex gap-x-4">
      <label for="username" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white sr-only">Masukan
        Nama
        Pengguna</label>
      <input type="text" id="username" name="search" placeholder="Cari Nama Mahasiswa, Nim"
        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
      <button type="submit"
        class="px-5 py-2.5 w-fit text-sm font-medium text-white inline-flex items-center bg-color-primary-500 rounded-lg text-center ">
        <span class=""><i class="fas fa-search text-lg "></i></span>
      </button>
    </form>
  </div>

  <div class="lg:col-span-4 col-span-12">

    <div class="max-h-[42rem] overflow-y-auto flex flex-col">
      <div
        class="relative overflow-visible bg-white p-6 rounded-xl w-full flex items-center gap-x-4 border border-slate-200 shadow-sm hover:border-color-primary-500 hover:bg-slate-50 transition-all duration-300"
        onclick="">
        <div class="w-16 rounded-full">
          <img src="/avatar/placeholder.jpg" alt="" class="rounded-full">
        </div>
        <div>
          <p class="font-semibold text-sm">Nama Mahasiswa</p>
          <p class="text-sm">531421003</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Kolom kanan dengan detail peserta -->
  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4">
    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm" onclick="showPesertaDetail({{ $item->id }})">
      <div class="col-span-12 inline-flex justify-between items-center">
        <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
          <p class="text-xl font-semibold">Mohamad Rafiq Daud</p>
        </div>
      </div>
      <div class="col-span-12 detailContainer flex flex-col">
        <div class="col-span-12 mt-4 flex flex-col gap-y-2">
          <div class="flex flex-col">
            <span class="text-xs text-slate-500">NIM : </span>
            <p class="text-sm">541341243</p>
          </div>
          <div class="flex flex-col">
            <span class="text-xs text-slate-500">Waktu Periode : </span>
            <p class="text-sm">14 Agu 2023 - 31 Des 2023 <span class="text-slate-500">(1 bulan)</span></p>
          </div>
        </div>
        <hr class="col-span-12 mt-4">
        <div class="col-span-12 mt-4 ">
          <div id="detail_mahasiswa" class="flex flex-col gap-y-4"></div>
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
        function showPesertaDetail(pesertaId) {
            // Menggunakan AJAX untuk mengambil detail peserta dari server
            $.ajax({
                type: 'GET',
                url: '/dashboard/pamong/get-peserta/' + pesertaId,
                success: function(response) {
                    // Memperbarui konten di sebelah kanan dengan detail peserta yang baru
                    $('#detail_mahasiswa').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
</script>
@endsection