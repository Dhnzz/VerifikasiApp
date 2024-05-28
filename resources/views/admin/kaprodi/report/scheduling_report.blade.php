@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex flex-col pt-44 pb-20 px-4 lg:px-12 gap-4">
  <div class="flex justify-between lg:flex-row flex-col lg:items-center gap-y-4">
    <h1 class="text-xl font-semibold">Pengajuan Penjadwalan</h1>
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
       
        <tr>
          @foreach ($mahasiswa as $mahasiswa)
              
          <td>1</td>
          <td>{{ $mahasiswa->User->credential }}</td>
          <td>{{ $mahasiswa->name }}</td>
          <td>{{ $mahasiswa->prodi }}</td>
          <td>{{ $mahasiswa->angkatan }}</td>
          <td>
            <a href="{{ route('kaprodi.report.detail', $mahasiswa->id) }}"><button>detail</button></a>
          </td>
          @endforeach
        </tr>
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