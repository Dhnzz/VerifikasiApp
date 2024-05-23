
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
        <p class="text-sm">{{ date('j M Y',strtotime($peserta->periode->tgl_mulai)) }} - {{ date('j M Y',strtotime($peserta->periode->tgl_berakhir)) }} <span class="text-slate-500">(1 bulan)</span></p>
      </div>
    </div>
    <hr class="col-span-12 mt-4">
    <div class="col-span-12 mt-4 ">
      <div class="flex flex-col gap-y-4">
        @foreach ($peserta->periode->templateBerkas->itemBerkas as $berkas)
            
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
            <x-button_md color="primary" type="submit" class="inline-flex items-center gap-x-2 w-fit">
              <span><i class="fas fa-download"></i></span>
              Download Berkas
            </x-button_md>
            <div class="inline-flex gap-x-2 items-center">
              <x-button_md color="success" type="submit" class="inline-flex items-center gap-x-2">
                <span><i class="fas fa-check"></i></span>
                Approve
              </x-button_md>
              <x-button_md color="danger" type="submit" class="inline-flex items-center gap-x-2">
                <span><i class="fas fa-times"></i></span>
                Tolak
              </x-button_md>
            </div>
          </div>
        </div>
        
        @endforeach
      </div>
    </div>
  </div>
  <hr class="col-span-12 mt-4">
  <div class="col-span-12 mt-4">
    <x-button_md color="primary" type="submit">
      Detail
    </x-button_md>
  </div>
