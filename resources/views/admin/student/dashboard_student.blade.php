@extends('layout.admin')

@section('main')
    <section class="max-w-screen-xl mx-auto min-h-screen grid grid-cols-12 py-44 px-4 lg:px-12 gap-4">
        <div class="lg:col-span-4 col-span-12  w-full ">
            <div class="p-6 bg-white flex gap-4 items-center rounded-xl shadow-sm border border-slate-200">
                <div class=" relative w-fit">
                    <img src="/avatar/placeholder.jpg" alt="" class="w-20 rounded-full object-cover">
                    <button
                        class="absolute right-0 bottom-0 inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-gray-800 bg-white hover:bg-slate-100 shadow-md border border-slate-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                        <i class="fas fa-pencil-alt text-xs"></i>
                    </button>
                </div>
                <div class="flex flex-col ">
                    <p class="font-semibold text-base uppercase">{{ $data->name }} </p>
                    <span class="text-xs text-slate-500">{{ $data->user->credential }}</span>
                    <span class="text-slate-500 text-sm">{{ ucWords($data->user->role) }}</span>
                </div>
            </div>

            @if ($dosen != null)
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow mt-4 p-6">
                    <div class="col-span-12 ">
                        <span class="text-xs text-slate-500">Dosen Verifikator : </span>
                        <h4 class="font-semibold text-lg">
                            {{ $data->dosen->name }}
                            <br>
                            <span class="text-sm text-slate-500">( {{ $data->dosen->user->credential }} )</span>
                        </h4>
                    </div>
                    <div class="flex flex-col mt-1">
                        <p class="text-sm"></p>
                    </div>
                    {{-- <div class="my-4">
                <hr>
                <a class="inline-flex underline text-color-primary-500 font-semibold items-center gap-x-2 py-4">
                    <span><i class="fas fa-file"></i></span>
                    <p>Lengkapi Berkas</p>
                </a>
            </div> --}}
                </div>
            @elseif ($dosen == null)
                {{-- kalau belum terdaftar dalam periode apapun --}}
                <div
                    class="mt-4 relative overflow-visible bg-white p-6 rounded-xl w-full border border-color-danger-500 shadow-sm transition-all duration-300 ">
                    <div class="flex items-start">
                        <div class="">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                                <i class="fas fa-exclamation"></i>
                            </span>
                        </div>

                        <p class="text-sm font-semibold text-color-danger-500">Kamu Belum Mendaftar Dalam Periode, Daftar
                            Terlebih
                            Dahulu</p>
                    </div>
                </div>
            @endif

        </div>
        @if ($registered->count() > 0)
            <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4 ">
                @foreach ($registered as $item => $value)
                    <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
                        <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
                            <span class=""><i class="fas fa-book text-xl"></i></span>
                            <p class="text-xl font-semibold">{{ $value->name }} - nama template berkas</p>
                        </div>
                        <div class="col-span-12 detailContainer flex flex-col">
                            <div class="col-span-12 mt-4 flex flex-col gap-y-2">
                                <div class="flex flex-col">
                                    <span class="text-xs text-slate-500">Lama Periode : </span>
                                    <p class="text-sm">
                                        {{ \Carbon\Carbon::parse($value->tgl_mulai)->locale('id')->isoFormat('D MMMM YYYY') .
                                            ' - ' .
                                            \Carbon\Carbon::parse($value->tgl_berakhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        <span
                                            class="text-slate-500">({{ round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($value->tgl_berakhir), false)) }}
                                            hari)</span>
                                    </p>
                                    </p>
                                </div>
                            </div>
                            <hr class="col-span-12 mt-4">
                            <div class="col-span-12 mt-4 flex flex-col gap-y-4">
                                @php
                                    $mahasiswaBerkasId = \App\Models\MahasiswaBerkas::where([
                                        'mahasiswa_id' => $data->id,
                                        'item_berkas_id' => $value->id,
                                    ])->first();
                                @endphp
                                @foreach ($value->templateBerkas->itemBerkas as $berkas)
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <p class="text-sm font-semibold text-color-primary-500 underline">
                                            {{ $berkas->name }}</p>
                                    </div>
                                @endforeach

                                {{-- beken bgini kalo depe berkas dia tolak --}}
                                <div class="flex items-center">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                                        <i class="fas fa-exclamation"></i>
                                    </span>
                                    <p class="text-sm font-semibold text-color-primary-500 underline">{{ $berkas->name }}
                                    </p>
                                </div>
                                <hr>
                                {{-- kalo depe template s ta upload samua, depe status jadi menunggu periode berikutnya --}}
                                <div
                                    class="p-4 bg-color-success-100 border border-color-success-500 text-sm rounded-xl inline-flex gap-x-2 w-full">
                                    <div class="">
                                        <span
                                            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>
                                    <div class="">
                                        <p>Seluruh dokumen berkas dalam periode ini telah berhasil diverifikasi, silahkan
                                            tunggu
                                            periode selanjutnya</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="grid grid-cols-12 p-6 bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="col-span-12">
                        <p class="text-lg font-semibold ">Lengkapi Dokumen</p>
                    </div>
                    <hr class="col-span-12 mt-4">
                    <div class="col-span-12 mt-4 text-sm">
                        <p>Lengkapi berkas dokumen yang dibutuhkan untuk mendaftar dalam periode ini. Berkas dokumenmu akan
                            tersimpan dengan aman.</p>
                    </div>
                    <div class="p-2 mt-4 col-span-12">
                        <div
                            class="p-4 bg-color-warning-100 border border-color-warning-500 rounded-xl inline-flex gap-x-2 w-full">
                            <div class="">
                                <span
                                    class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-warning-600 rounded-full ">
                                    <i class="fas fa-exclamation"></i>
                                </span>
                            </div>
                            <div class="">
                                <p>Pastikan untuk mengupload dokumen sesuai ketentuan</p>
                                <ul class="list-disc px-4 text-sm mt-1">
                                    <li>Dokumen harus dengan format PDF</li>
                                    <li>Pastikan telah mereview berkas sebelum mensumbit berkas</li>
                                    <li>Kesalahan pada data dokumen dapat berakibat penolakan</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-12 mt-4 flex flex-col gap-y-4">
                        @foreach ($value->templateBerkas->itemBerkas as $berkas => $value)
                            @php
                                $mahasiswaBerkasId = \App\Models\MahasiswaBerkas::where([
                                    'mahasiswa_id' => $data->id,
                                    'item_berkas_id' => $value->id,
                                ])->first();
                            @endphp
                            <div>
                                <p class="font-semibold">{{ $value->name }} </p>
                                <p class="text-sm">Unggah {{ $value->name }} kamu dalam format PDF dengan ukuran maksimal
                                    2MB</p>
                                <a href="{{ asset('storage/') }}"></a>
                            </div>
                            <form action="{{ route('mahasiswa.berkas_mahasiswa.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input
                                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                    type="file" name="file" value="{{ $mahasiswaBerkasId->berkas }}">
                                <input type="text" name="mahasiswa_id" value="{{ $data->id }}">
                                <input type="text" name="mahasiswa_name" value="{{ $data->name }}">
                                <input type="text" name="item_berkas_id" value="{{ $value->id }}">
                                <x-button_md color="success" type="submit" class="mt-2 inline-flex items-center gap-x-2">
                                    <span><i class="fas fa-check"></i></span>
                                    <p>Kirim</p>
                                </x-button_md>
                            </form>
                        @endforeach
                    </div>
                    <hr class="mt-4 col-span-12">
                </div>
            </div>
        @elseif ($registered->count() == 0)
            <div class="lg:col-span-8 col-span-12 w-full flex flex-col gap-y-4 max-h-[40rem] overflow-y-auto">
                @if ($periode->count() == 0)
                    <div
                        class="mt-4 relative overflow-visible bg-white p-6 rounded-xl w-full border border-color-danger-500 shadow-sm transition-all duration-300 ">
                        <div class="flex items-start">
                            <div class="">
                                <span
                                    class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                                    <i class="fas fa-exclamation"></i>
                                </span>
                            </div>

                            <p class="text-sm font-semibold text-color-danger-500">Belum Ada Periode Dibuka</p>
                        </div>
                    </div>
                @elseif ($periode->count() > 0)
                    @foreach ($periode as $item => $value)
                        <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">

                            <div class="col-span-12 inline-flex justify-between items-center">
                                <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
                                    <span class=""><i class="fas fa-book text-xl"></i></span>
                                    <p class="text-xl font-semibold">{{ $value->name }}</p>
                                </div>
                            </div>
                            <div class="col-span-12 detailContainer flex flex-col ">
                                <div class="col-span-12 mt-4 flex flex-col gap-y-2">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-slate-500">Lama Periode : </span>
                                        <p class="text-sm">
                                            {{ \Carbon\Carbon::parse($value->tgl_mulai)->locale('id')->isoFormat('D MMMM YYYY') .
                                                ' - ' .
                                                \Carbon\Carbon::parse($value->tgl_berakhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            <span
                                                class="text-slate-500">({{ round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($value->tgl_berakhir), false)) }}
                                                hari)</span>
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-span-12 mt-4">
                            <div class="col-span-12 mt-4">
                                <p class="font-semibold">Pilih Template Berkas</p>
                            </div>
                            <div class="col-span-12 mt-4 flex flex-col gap-y-4">
                                <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4 w-full">
                                    <button class="flex justify-between" onclick="openDetails(this, event)">
                                        <p class="font-semibold">Nama Template Berkas</p>
                                        <span><i class="fas fa-chevron-down text-sm"></i></span>
                                    </button>

                                    <div class="detailContainer flex flex-col gap-y-2 hidden">
                                        <div>
                                            <p>Daftar Berkas Dalam Template :</p>
                                        </div>
                                        @foreach ($periode as $item => $value)
                                            @foreach ($value->templateBerkas->itemBerkas as $itemBerkas)
                                                <div class="inline-flex items-center mt-2">
                                                    <div class="">
                                                        <span
                                                            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                    </div>
                                                    <p class="font-semibold">{{ $itemBerkas->name }}</p>
                                                </div>
                                            @endforeach
                                            <hr class="mt-2">
                                            <form
                                                action="{{ route('mahasiswa.periode.daftar', [$data->id, $periode[$item]->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <x-button_md type="submit" color="primary"
                                                    class="w-fit mt-2">Daftar</x-button_md>
                                            </form>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif

    </section>
    <script>
        function openDetails(button, event) {
            event.preventDefault();
            const detailContainer = button.nextElementSibling;
            detailContainer.classList.toggle('hidden');
        }
    </script>
@endsection
