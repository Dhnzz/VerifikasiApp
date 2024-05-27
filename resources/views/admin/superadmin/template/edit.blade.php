@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center pt-44 pb-20 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Edit Data Template</p>
    </div>
    <div class="mt-4">
      <form action="{{route('kajur.template.update', $tmpBerkas->id)}}" method="post" class=" w-full">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="name" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Template
          </label>
          <input type="text" placeholder="Nama Template" name="name"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " value="{{ $tmpBerkas->name }}" />
        </div>
        <x-button_md color="primary" class="w-full col-span-12" type="submit">
          Kirim
        </x-button_md>
      </form>
    </div>
  </div>
</section>
@endsection