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
                    <p class="text-sm font-semibold uppercase">Mahasiswa</p>
                    <span class="text-4xl font-semibold ">{{ $jumlahMahasiswa }}</span>
                </div>
                <i class="fas fa-graduation-cap text-4xl"></i>
            </div>
            <div
                class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Dosen</p>
                    <span class="text-4xl font-semibold ">{{ $jumlahDosen }}</span>
                </div>
                <i class="fas fa-users text-4xl"></i>
            </div>

            <div
                class="col-span-3 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Mahasiswa SI</p>
                    <span class="text-2xl font-semibold ">{{ $mahasiswaSI }}</span>
                </div>
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
            <div
                class="col-span-3 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Mahasiswa PTI</p>
                    <span class="text-2xl font-semibold ">{{ $mahasiswaPTI }}</span>
                </div>
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
            <div
                class="col-span-3 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Kaprodi Dosen SI</p>
                    <span
                        class="text-xs font-semibold ">{{ $dosenSi == null ? 'Kaprodi SI Belum Ditambahkan' : $dosenSi['name'] }}</span>
                </div>
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div
                class="col-span-3 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="text-sm font-semibold uppercase">Kaprodi Dosen PTI</p>
                    <span
                        class="text-xs font-semibold ">{{ $dosenPti == null ? 'Kaprodi PTI Belum Ditambahkan' : $dosenPti['name'] }}</span>
                </div>
                <i class="fas fa-users text-2xl"></i>
            </div>
        </div>
    </section>
@endsection
