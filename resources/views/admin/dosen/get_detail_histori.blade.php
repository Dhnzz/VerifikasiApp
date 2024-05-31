<div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
        <span class=""><i class="fas fa-book text-xl"></i></span>
        <p class="text-xl font-semibold">{{ $mahasiswa->periode->name }}</p>
    </div>
    <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
        <p class="text-xl font-semibold">{{ $mahasiswa->name }}</p>
    </div>
    <div class="col-span-12 detailContainer flex flex-col">
        <div class="col-span-12 mt-4 flex flex-col gap-y-2">
            <div class="flex flex-col">
                <span class="text-xs text-slate-500">Lama Periode : </span>
                <p class="text-sm">
                    {{ \Carbon\Carbon::parse($mahasiswa->periode->tgl_mulai)->locale('id')->isoFormat('D MMMM YYYY') .
                        ' - ' .
                        \Carbon\Carbon::parse($mahasiswa->periode->tgl_berakhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                    <span
                        class="text-slate-500">({{ round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($mahasiswa->periode->tgl_berakhir), false)) }}
                        hari)</span>
                </p>
            </div>
        </div>
        <hr class="col-span-12 mt-4">
        <div class="flex flex-col gap-y-2 mt-4">
            @foreach ($mahasiswa->itemBerkas as $berkas => $berkasId)
                @php
                    $mahasiswaBerkasId = \App\Models\MahasiswaBerkas::where([
                        'mahasiswa_id' => $mahasiswa->id,
                        'item_berkas_id' => $berkasId->id,
                    ])->first();

                    // dd($mahasiswaBerkasId);
                @endphp
                <div class="inline-flex items-center p-4 bg-slate-100  justify-between w-full rounded-md">
                    <p class="font-semibold ">
                        {{$berkasId->name}}
                    </p>
                    <x-button_md color="primary" onclick="modalOpen()">
                        <span>
                            <i class="fas fa-eye"></i>
                        </span>
                        Lihat Berkas
                    </x-button_md>
                    <div id="modal"
                        class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/30 hidden">
                        <div class="max-w-2xl w-full p-6 rounded-xl h-[80vh] overflow-hidden">
                            <div class="w-full inline-flex items-center justify-between text-white">
                                <p class="text-lg font-semibold">{{$mahasiswaBerkasId->berkas}}</p>
                                <button id="close-modal"
                                    class="px-3 py-1.5 rounded-lg hover:bg-slate-500 text-white"
                                    onclick="closeModal()">
                                    <i class="fas fa-times text-lg"></i>
                                </button>
                            </div>
                            <embed src="{{asset('storage/upload/'. $mahasiswaBerkasId->berkas)}}" type="" class="mt-4 w-full h-full">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr class="col-span-12 mt-4">
        <div class="col-span-12 ">
            @if ($mahasiswa->status == '2')
                <div class="col-span-12 mt-4">
                    <form action="{{ route('dosen.mahasiswa.rejectPengajuan') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                        @foreach ($mahasiswa->berkas_mahasiswa as $berkas)
                        <input type="hidden" name="berkas_id[]" value="{{ $berkas->id }}">
                        @endforeach
                        <x-button_md color="danger" type="submit" class="w-full">
                            Batal Pengajuan
                        </x-button_md>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function modalOpen() {
        const modal = document.getElementById(`modal`);
        modal.classList.remove('hidden');
        modal.classList.add('flex')
    }

    function closeModal() {
        const modal = document.getElementById(`modal`)
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>