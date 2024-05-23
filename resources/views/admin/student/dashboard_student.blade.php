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
            <hr class="">
            <x-button_md color="primary" class="mt-4 inline-flex items-center gap-x-2">
                <span><i class="fas fa-file"></i></span>
                <p>Lengkapi Berkas</p>
            </x-button_md>
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
                <p class="text-xl font-semibold">{{ $value->name }}</p>
            </div>
            <div class="col-span-12 detailContainer flex flex-col">
                <div class="col-span-12 mt-4 flex flex-col gap-y-2">
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-500">Deskripsi Periode: </span>
                        <p class="text-sm">{{ $value->deskripsi }}</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-500">Lama Periode : </span>
                        <p class="text-sm">
                            {{ \Carbon\Carbon::parse($value->tgl_mulai)->locale('id')->isoFormat('D MMMM YYYY') .' - '
                            .\Carbon\Carbon::parse($value->tgl_berakhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                            <span class="text-slate-500">({{
                                round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($value->tgl_berakhir),
                                false)) }}
                                hari)</span>
                        </p>
                        </p>
                    </div>
                </div>
                <hr class="col-span-12 mt-4">
                <div class="col-span-12 mt-4 flex flex-col gap-y-4">
                    @foreach ($value->templateBerkas->itemBerkas as $berkas)
                    <div class="flex items-center">
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
                            <i class="fas fa-check"></i>
                        </span>
                        <a href="" class="text-sm font-semibold text-color-primary-500 underline">{{ $berkas->name
                            }}</a>
                    </div>
                    @endforeach
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
                <div>
                    <p class="font-semibold">Curiculum Vitae</p>
                    <p class="text-sm">Unggah CV kamu dalam format PDF dengan ukuran maksimal 2MB</p>
                </div>
                <form action="">
                    <input
                        class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        type="file">
                    <input type="text" name="mahasiswa_id" value="mahasiswa_id" hidden>
                    <x-button_md color="success" class="mt-2 inline-flex items-center gap-x-2">
                        <span><i class="fas fa-check"></i></span>
                        <p>Kirim</p>
                    </x-button_md>
                </form>
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
        {{-- @dd($periode[$item]->name) --}}
        <div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">

            <button class="col-span-12 inline-flex justify-between items-center" onclick="openDetails(this, event)">
                <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
                    <span class=""><i class="fas fa-book text-xl"></i></span>
                    <p class="text-xl font-semibold">{{ $value->name }}</p>
                </div>
                <span><i class="fas fa-chevron-down text-sm"></i></span>
            </button>
            <div class="col-span-12 detailContainer flex flex-col hidden">
                <div class="col-span-12 mt-4 flex flex-col gap-y-2">
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-500">Deskripsi Periode: </span>
                        <p class="text-sm">{{ $value->deskripsi }}</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-500">Lama Periode : </span>
                        <p class="text-sm">
                            {{ \Carbon\Carbon::parse($value->tgl_mulai)->locale('id')->isoFormat('D MMMM YYYY') .' - '
                            .\Carbon\Carbon::parse($value->tgl_berakhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                            <span class="text-slate-500">({{
                                round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($value->tgl_berakhir),
                                false)) }}
                                hari)</span>
                        </p>
                        </p>
                    </div>
                </div>
                <hr class="col-span-12 mt-4">
                <div class="col-span-12 mt-4 flex flex-col gap-y-4">
                    @foreach ($value->templateBerkas->itemBerkas as $berkas)
                    <div class="flex items-center">
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-success-500 rounded-full ">
                            <i class="fas fa-check"></i>
                        </span>
                        <a href="" class="text-sm font-semibold text-color-primary-500 underline">{{ $berkas->name
                            }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <hr class="col-span-12 mt-4">
            <form action="{{ route('mahasiswa.periode.daftar', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="col-span-12 mt-4">
                    <input type="hidden" name="periode_id" value="{{ $periode[$item]->id }}">
                    @foreach ($periode[$item]->templateBerkas->itemBerkas as $item)
                    <input type="text" name="item_berkas_id[]" id="" value="{{ $item->id }}">
                    @endforeach
                    <x-button_md color="primary" type="submit">
                        Daftar
                    </x-button_md>
                </div>
            </form>
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