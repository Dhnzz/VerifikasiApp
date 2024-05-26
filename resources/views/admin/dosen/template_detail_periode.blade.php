@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl min-h-screen mx-auto grid grid-cols-12 py-44 px-4 lg:px-12 gap-4">
  <div class="col-span-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="col-span-12">
      <div class="flex gap-x-2 items-center text-color-primary-500">
        <span class=""><i class="fas fa-book text-lg"></i></span>
        <p class="text-lg font-semibold">{{ $periode->name }}</p>
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
    @foreach ($dosen->Mahasiswa as $mahasiswa)
        
    <div class="max-h-[42rem] overflow-y-auto flex flex-col hover:cursor-pointer">
      <div
      class="relative overflow-visible bg-white p-6 rounded-xl w-full flex items-center gap-x-4 border border-slate-200 shadow-sm hover:border-color-primary-500 hover:bg-slate-50 transition-all duration-300"
        onclick="showPesertaDetail({{ $mahasiswa->id }})">
        <div class="w-16 rounded-full">
          <img src="/avatar/placeholder.jpg" alt="" class="rounded-full">
        </div>
        <div>
          <p class="font-semibold text-sm">{{ $mahasiswa->name }}</p>
          <p class="text-sm">{{ $mahasiswa->user->credential }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Kolom kanan dengan detail peserta -->
  <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4 " id="detail_mahasiswa" >
    
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
                url: '/dosen/get-peserta/' + pesertaId,
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