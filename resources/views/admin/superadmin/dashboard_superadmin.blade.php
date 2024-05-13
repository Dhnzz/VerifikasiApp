@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex flex-col py-20 px-4 lg:px-12 gap-4">
  <div class="grid grid-cols-12 gap-4">
    <div
      class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
      <div class="flex flex-col gap-y-1">
        <p class="text-sm font-semibold uppercase">Mahasiswa</p>
        <span class="text-4xl font-semibold ">3</span>
      </div>
      <i class="fas fa-graduation-cap text-4xl"></i>
    </div>
    <div
      class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
      <div class="flex flex-col gap-y-1">
        <p class="text-sm font-semibold uppercase">Dosen</p>
        <span class="text-4xl font-semibold ">3</span>
      </div>
      <i class="fas fa-users text-4xl"></i>
    </div>
  </div>
</section>
@endsection