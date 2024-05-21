@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex flex-col py-44 px-4 lg:px-12 gap-4">
  <div class="flex justify-between lg:flex-row flex-col lg:items-center gap-y-4">
    <h1 class="text-xl font-semibold">Periode</h1>
    <x-button_md color="primary" onclick="location.href='{{ route('periode.create') }}';" class="inline-flex gap-x-2">
      <span><i class="fas fa-plus"></i></span>
      Tambah
    </x-button_md>
  </div>
  <div class="gap-4 w-full text-sm bg-white p-6 rounded-xl" id="wrapper">
    <table id="table_config" class="">
      <thead>
        <tr>
          <th>NO</th>
          <th>Nama Periode</th>
          <th>Tanggal Mulai Periode</th>
          <th>Tanggal Berakhir Periode</th>
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
          <td>{{ $item->name }}</td>
          <td>{{ $item->tgl_mulai }}</td>
          <td>{{ $item->tgl_berakhir }}</td>
          <td>
            <div class="relative inline-block text-left">
              <button type="button" id="dropdownMenuButton{{ $item->id }}"
                class="inline-flex justify-center items-center w-full rounded-md px-2 py-1 bg-blue-500 text-white hover:bg-blue-600"
                aria-expanded="false" aria-haspopup="true">
                <!-- Tanda tiga titik vertikal (ellipsis) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M4 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm6 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm6 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"
                    clip-rule="evenodd" />
                </svg>
              </button>

              <div id="dropdownMenu{{ $item->id }}"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10"
                role="menu" aria-orientation="vertical" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                <div class="py-1" role="none">
                  <div
                    class="flex items-center gap-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                    role="menuitem">
                    <i class="w-4 h-4 fas fa-info-circle"></i>
                    Detail
                  </div>
                  <div
                    class="flex items-center gap-x-2 px-4 py-2 text-sm text-green-500 hover:bg-gray-100 hover:text-green-700"
                    role="menuitem">
                    <i class="fas fa-pen w-4 h-4"></i>
                    Update
                  </div>
                  <form action="" method="POST" role="none"
                    style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete?')"
                      class="flex w-full gap-x-2 items-center px-4 py-2 text-sm text-red-500 hover:bg-gray-100 hover:text-red-700"
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