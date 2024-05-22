<div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
  <button class="flex justify-between" onclick="openDetails(this, event)">
    <div class="flex items-center">
      <span
        class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-white bg-color-primary-500 rounded-full ">
        <i class="fas fa-exclamation"></i>
      </span>
      <p class="text-sm font-semibold">Surat Keterangan Tidak
        Mampu</p>
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