<div class="grid grid-cols-12 p-10 bg-white rounded-xl border border-slate-200 shadow-sm">
  <div class="col-span-12 inline-flex justify-between items-center">
    <div class="col-span-12 flex gap-x-2 items-center text-color-primary-500">
      <p class="text-xl font-semibold">{{ $peserta->name }}</p>
    </div>
  </div>
  <div class="col-span-12 detailContainer flex flex-col">
    <div class="col-span-12 mt-4 flex flex-col gap-y-2">
      <div class="flex flex-col">
        <span class="text-xs text-slate-500">NIM : </span>
        <p class="text-sm">{{ $peserta->User->credential }}</p>
      </div>
      <div class="flex flex-col">
        <span class="text-xs text-slate-500">Waktu Periode : </span>
        <p class="text-sm">{{ date('j M Y',strtotime($peserta->periode->tgl_mulai)) }} - {{ date('j M
          Y',strtotime($peserta->periode->tgl_berakhir)) }} <span class="text-slate-500">({{
            round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($peserta->periode->tgl_berakhir), false)) }}
            hari )</span></p>
      </div>
    </div>
    <hr class="col-span-12 mt-4">
    <div class="col-span-12 mt-4 ">
      <div class="flex flex-col gap-y-4">
        @foreach ($peserta->itemBerkas as $value => $berkas)
        <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
          <button class="flex justify-between" onclick="openDetails(this, event)">
            <div class="flex items-center">
              <span
                class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-primary-500 rounded-full ">
                <i class="fas fa-exclamation"></i>
              </span>
              <p class="text-sm font-semibold">{{$berkas->name}}</p>
            </div>
            <span><i class="fas fa-chevron-down text-sm"></i></span>
          </button>
          <div class="detailContainer flex items-center justify-between hidden mt-4">
            <x-button_md color="primary" type="submit" class="inline-flex items-center gap-x-2 w-fit"
              onclick="modalOpen(this, {{ $value }})">
              <span><i class="fas fa-eye"></i></span>
              Lihat Berkas
            </x-button_md>
            {{-- modal --}}
            <div id="{{ 'modal' . $value }}"
              class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/30 hidden">
              <div class="max-w-2xl w-full p-6 rounded-xl h-[80vh] overflow-hidden">
                <div class="w-full inline-flex items-center justify-between text-white">
                  <p class="text-lg font-semibold">{{ $berkas->name }}</p>
                  <button id="close-modal" class="px-3 py-1.5 rounded-lg hover:bg-slate-500 text-white"
                    onclick="closeModal({{ $value }})">
                    <i class="fas fa-times text-lg"></i>
                  </button>
                </div>
                <embed src="/sample.pdf" type="" class="mt-4 w-full h-full">
              </div>
            </div>
            @if($peserta->berkas_mahasiswa[$value]->revisi)
            {{-- buatkan jadi tidak ada --}}
            <div class="inline-flex items-center gap-x-1">
              <div class="">
                <span
                  class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-danger-500 rounded-full ">
                  <i class="fas fa-exclamation text-sm"></i>
                </span>
              </div>
              <p class="text-color-danger-500 font-semibold">Berkas Telah Ditolak</p>
            </div>
            @else
            <div class="inline-flex gap-x-2 items-center">
              <form action="{{ route('dosen.berkas.approve') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="periode_id" value="{{ $peserta->periode->id }}">
                <input type="hidden" name="berkas_id" value="{{ $berkas->id }}">
                <input type="hidden" name="mahasiswa_id" value="{{ $peserta->id }}">
                <x-button_md color="success" type="submit" class="inline-flex items-center gap-x-2">
                  <span><i class="fas fa-check"></i></span>
                  Verifikasi
                </x-button_md>
              </form>
              <x-button_md color="danger" type="submit" class="inline-flex items-center gap-x-2"
                onclick="feedBackOpen(this, {{ $value }})">
                <span><i class="fas fa-times"></i></span>
                Tolak
              </x-button_md>
              <div id="{{ 'feedbackmodal'.$value }}"
                class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/30 hidden">
                <div class="max-w-lg w-full p-6 rounded-xl overflow-hidden bg-white">
                  <div class="w-full inline-flex items-center justify-between">
                    <p class="text-lg font-semibold">{{ $berkas->name }}</p>
                    <button id="close-modal" class="px-3 py-1.5 rounded-lg hover:bg-slate-100 text-slate-800"
                      onclick="closeRejectModal({{ $value }})">
                      <i class="fas fa-times text-lg"></i>
                    </button>
                  </div>
                  <div class="mt-4">
                    <form action="{{ route('dosen.berkas.reject') }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="periode_id" value="{{ $peserta->periode->id }}">
                      <input type="hidden" name="berkas_id" value="{{ $berkas->id }}">
                      <input type="hidden" name="mahasiswa_id" value="{{ $peserta->id }}">
                      <div class="">
                        <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                          Kirim Feedback Penolakan
                        </label>
                        <textarea type="text" placeholder="Masukan Catatan Penolakan" name="revisi"
                          class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "></textarea>
                      </div>
                      <x-button_sm color="primary" class="mt-2" type="submit">
                        Kirim
                      </x-button_sm>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @endif

          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>
  <hr class="col-span-12 mt-4">
  <div class="col-span-12 mt-4">
    @if ($peserta->berkas_mahasiswa->every(fn($berkas) => $berkas->status == 1))
    <div class="col-span-12 mt-4">
      <form action="{{ route('dosen.mahasiswa.pengajuan') }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="mahasiswa_id" value="{{ $peserta->id }}">
        <input type="hidden" name="periode_id" value="{{ $peserta->periode->id }}">
        <x-button_md color="success" type="submit">
          PENGAJUAN
        </x-button_md>
      </form>
    </div>
    @endif
  </div>
</div>

<script>
  function modalOpen(value, data) {
    // console.log(data)
    const modal = document.getElementById(`modal`+data);
    // console.log(modal);
    modal.classList.remove('hidden');
    modal.classList.add('flex')
  }

  function closeModal(data) {
    const modal = document.getElementById('modal'+data)
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }

  function feedBackOpen(value, data){
    const modal = document.getElementById('feedbackmodal'+data);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeRejectModal(data) {
    const modal = document.getElementById('feedbackmodal'+data)
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }

</script>