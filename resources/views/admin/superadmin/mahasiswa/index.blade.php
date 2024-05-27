@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex flex-col pt-44 pb-20 px-4 lg:px-12 gap-4">
  <div class="flex justify-between lg:flex-row flex-col lg:items-center gap-y-4">
    <h1 class="text-xl font-semibold">Mahasiswa</h1>
    <x-button_md color="primary" onclick="location.href='{{ route('admin.mahasiswa.create') }}';"
      class="inline-flex gap-x-2 items-center">
      <span><i class="fas fa-plus"></i></span>
      Tambah
    </x-button_md>
  </div>
  <div class="gap-4 w-full text-sm bg-white p-6 rounded-xl" id="wrapper">
    <table id="table_config" class="">
      <thead>
        <tr>
          <th>NO</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Program Studi</th>
          <th>Angkatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 1;
        @endphp
        @foreach ($data as $item)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $item->user->credential }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ (($item->prodi == 'si')?'Sistem Informasi':($item->prodi == 'pti'))?'Pendidikan Teknologi Informasi':'' }}</td>
          <td>{{ $item->angkatan }}</td>
          <td>
            <div class="relative inline-block text-left">
              <button type="button" id="dropdownMenuButton{{ $item->id }}"
                class="inline-flex justify-center items-center w-full rounded-md px-2 py-1.5 bg-color-primary-500 text-white hover:bg-color-primary-500"
                aria-expanded="false" aria-haspopup="true">
                <!-- Tanda tiga titik vertikal (ellipsis) -->
                <i class="fas fa-ellipsis-h"></i>
              </button>

              <div id="dropdownMenu{{ $item->id }}"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10"
                role="menu" aria-orientation="vertical" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                <div class="py-1" role="none">
                  <a href="{{ route('admin.mahasiswa.show', $item->id) }}"
                    class="flex items-center gap-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                    role="menuitem">
                    <i class="w-4 h-4 fas fa-info-circle"></i>
                    Detail
                  </a>
                  <a href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                    class="flex items-center gap-x-2 px-4 py-2 text-sm text-green-500 hover:bg-gray-100 hover:text-green-700"
                    role="menuitem">
                    <i class="fas fa-pen w-4 h-4"></i>
                    Update
                  </a>
                  <form action="{{ route('admin.mahasiswa.destroy', $item->id) }}" method="POST" role="none"
                    style="display: inline-block;" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus?')"
                      class="flex w-full items-center gap-x-2 px-4 py-2 text-sm text-color-danger-500 hover:bg-gray-100 hover:text-color-danger-700"
                      role="menuitem">
                      <i class="fas fa-trash w-4 h-4"></i>
                      Delete
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script>
  $(document).ready(function() {
            $('#table_config').DataTable();
        });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('[id^="dropdownMenuButton"]');
            dropdownButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const dropdownId = this.getAttribute('id').replace('dropdownMenuButton', '');
                    const dropdownMenu = document.getElementById('dropdownMenu' + dropdownId);
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    // Menutup semua dropdown yang sedang terbuka
                    document.querySelectorAll('.origin-top-right').forEach(function(dropdown) {
                        dropdown.classList.add('hidden');
                    });

                    if (!isExpanded) {
                        this.setAttribute('aria-expanded', 'true');
                        dropdownMenu.classList.remove('hidden');
                    } else {
                        this.setAttribute('aria-expanded', 'false');
                        dropdownMenu.classList.add('hidden');
                    }

                    // Menghentikan event dari menyebar, memastikan dropdown lainnya tidak terbuka
                    event.stopPropagation();
                });
            });

            // Menutup dropdown saat dokumen diklik
            document.addEventListener('click', function() {
                document.querySelectorAll('.origin-top-right').forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
                dropdownButtons.forEach(function(button) {
                    button.setAttribute('aria-expanded', 'false');
                });
            });
        });
</script>
@endsection