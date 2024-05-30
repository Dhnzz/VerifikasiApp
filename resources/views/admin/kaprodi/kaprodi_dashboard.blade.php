@extends('layout.admin')

@section('main')
    <section class="max-w-screen-xl mx-auto min-h-screen flex flex-col py-44 px-4 lg:px-12 gap-4">
      @if (session('success'))
          <div class="bg-green-500 text-white p-4 rounded-md relative" id="notif">
              <p>{{ session('success') }}</p>
              <button class="absolute top-0 right-0 p-2 text-white" onclick="tutupNotifikasi()">Tutup</button>
          </div>
          <script>
              function tutupNotifikasi() {
                  document.querySelector('#notif').style.display = 'none';
              }
          </script>
      @endif
        <div class="grid grid-cols-12 gap-4">
            <div
                class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Berkas Masuk</p>
                    <span class="text-4xl font-semibold ">1</span>
                </div>
                <i class="fas fa-graduation-cap text-4xl"></i>
            </div>
            <div
                class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Berkas Belum Masuk</p>
                    <span class="text-4xl font-semibold ">2</span>
                </div>
                <i class="fas fa-users text-4xl"></i>
            </div>
        </div>
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
                @foreach ($mahasiswa as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->user->credential }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->prodi == 'si' ? 'Sistem Informasi' : ($item->prodi == 'pti' ? 'Pendidikan Teknologi Informasi' : '') }}
                        </td>
                        <td>{{ $item->angkatan }}</td>
                        <td>
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
