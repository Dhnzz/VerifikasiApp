@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center pt-44 pb-20 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Nama Periode</p>
    </div>
    <div class="mt-12">
      <form action="{{route('admin.periode.store')}}" method="post" class=" w-full grid grid-cols-12 gap-4">
        @csrf
        <div class="mb-4 col-span-12">
          <label for="nama_periode" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Periode
          </label>
          <input id="nama_periode" name="name" placeholder="nama periode"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <div class="mb-4 col-span-12">
          <label for="deksripsi_periode" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Deskripsi Periode
          </label>
          <textarea id="deksripsi_periode" name="deskripsi" placeholder="deksripsi periode"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs "></textarea>
        </div>
        <div class="mb-4 col-span-6">
          <label for="tanggal_mulai" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Tanggal Mulai
          </label>
          <input type="date" max="100" id="tanggal_mulai" name="tanggal_mulai" placeholder="tanggal mulai"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <div class="mb-4 col-span-6">
          <label for="tanggal_berakhir" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Tanggal Berakhir
          </label>
          <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" placeholder="tanggal berakhir"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <div class="mb-4 col-span-12">
          <label for="template_berkas" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Template Berkas
          </label>
          <select id="template_berkas" name="template_berkas_id" placeholder="template berkas"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" style="height: 100%;">
            <option value="">Pilih Template</option>
            @foreach ($template_berkas as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <x-button_md color="primary" class="w-full col-span-12" type="submit">
          Kirim
      </x-button_md>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
         $('#template_berkas').select2({
             placeholder: "Cari Template",
             allowClear: true,
             padding: 'resolve',
         });
     });
</script>
@endsection