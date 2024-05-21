@extends('layout.admin')

@section('main')
<section class="max-w-screen-lg min-h-screen mx-auto flex justify-center items-center py-32 px-4 lg:px-12 gap-4">
  <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
    <div class="w-full flex flex-col items-center">
      <p class="font-semibold text-lg">Edit Data Dosen</p>
      @if (session('error'))
      <div class="bg-red-500 text-white p-4 rounded-md mb-4">
        {{ session('error') }}
      </div>
      @endif
    </div>
    <div class="mt-12">
      <form action="{{route('dosen.update', $data->id)}}" method="post" class=" w-full">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            NIM
          </label>
          <input type="text" placeholder="NIM" name="credential" value="{{$data->user->credential}}"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <div class="mb-4">
          <label for="deskripsi" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
            Nama Mahasiswa
          </label>
          <input type="text" placeholder="Nama Lengkap" name="name" value="{{$data->name}}"
            class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs " />
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full transition duration-300 ease-in-out">
          Simpan
        </button>
      </form>
    </div>
  </div>
</section>
@endsection