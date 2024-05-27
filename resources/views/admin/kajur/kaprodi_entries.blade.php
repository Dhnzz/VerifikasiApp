@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex flex-col pt-44 pb-20 px-4 lg:px-12 gap-4">
  <div class="flex justify-between lg:flex-row flex-col lg:items-center gap-y-4">
    <h1 class="text-xl font-semibold">Dosen</h1>
    {{-- <x-button_md color="primary" onclick="location.href='{{ route('admin.dosen.create') }}';"
      class="inline-flex gap-x-2 items-center">
      <span><i class="fas fa-plus"></i></span>
      Tambah
    </x-button_md> --}}
  </div>
  <div class="gap-4 w-full text-sm bg-white p-6 rounded-xl" id="wrapper">
    <table id="table_config" class="">
      <thead>
        <tr>
          <th>NO</th>
          <th>NIDN</th>
          <th>Nama</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
            @php
                $i = 1;
            @endphp
        @foreach ( $users as $value => $user)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $user->credential }}</td>
          <td>
           {{$user->Dosen->name}}
          </td>
          <td>
            @switch($user->role)
                @case('dosen')
                    <span class="text-xs bg-gray-500 text-white px-2 py-1 rounded-full ml-2">Dosen</span>
                @break
              @case('kaprodi')
                @switch($user->Dosen->prodi)
                  @case('si')
                      <span class="text-xs bg-yellow-500 text-white px-2 py-1 rounded-full ml-2">Kaprodi SI</span>
                  @break
      
                  @case('pti')
                    <span class="text-xs bg-yellow-700 text-white px-2 py-1 rounded-full ml-2">Kaprodi PTI</span>
                    @break  
                    
                    @default
                    <span class="text-xs bg-yellow-900 text-white px-2 py-1 rounded-full ml-2">Kaprodi</span>
                @endswitch
              @break  
            @endswitch
          </td>
          <td>
            <x-button_sm class="inline-flex items-center gap-x-2" onclick="modalOpen({{ $value }})">
              <span><i class="fas fa-pencil-alt"></i></span>Pilih Kaprodi
            </x-button_sm>
            <div id="{{ 'modal'. $value }}"
              class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/30 hidden">
              <div class="max-w-lg w-full p-6 rounded-xl overflow-hidden bg-white">
                <div class="w-full inline-flex items-center justify-between">
                  <p class="text-lg font-semibold">{{$user->dosen->name}}</p>
                  <button id="close-modal" class="px-3 py-1.5 rounded-lg hover:bg-slate-100 text-slate-800"
                    onclick="closeModal({{ $value }})">
                    <i class="fas fa-times text-lg"></i>
                  </button>
                </div>
                <div class="mt-4">
                  <form action="{{ route('kajur.kaprodi.select', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
                    <div class="">
                    <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                      Pilih Progam Studi
                    </label>
                      <select type="text" placeholder="Prodi" name="prodi"
                        class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs ">
                        <option value="">Program Studi</option>
                        <option value="si" {{($user->Dosen->prodi == 'si'?'selected':'')}}>Sistem Informasi</option>
                        <option value="pti" {{($user->Dosen->prodi == 'pti'?'selected':'')}}>Pendidikan Teknologi Informasi</option>
                      </select>
                    </div>
                    <x-button_sm color="primary" class="mt-2" type="submit">
                      Kirim
                    </x-button_sm>
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

  function modalOpen(data) {
    // console.log(data)
    const modal = document.getElementById(`modal`+data);
    // console.log(modal);
    modal.classList.remove('hidden');
    modal.classList.add('flex')
  }
  function closeModal(data) {
    const modal = document.getElementById(`modal`+data)
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }
</script>
@endsection