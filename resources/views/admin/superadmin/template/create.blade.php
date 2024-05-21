@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center py-44 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Tambah Data Template</p>
    </div>
    <div class="mt-4">
      <form action="{{route('template.store')}}" method="post" class=" w-full">
        @csrf
        <div class="mb-4">
          <label for="nama_template" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Template
          </label>
          <input type="text" placeholder="Nama Template" name="name"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <button type="submit" class="w-full col-span-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Kirim
        </button>
      </form>
    </div>
  </div>
</section>
@endsection