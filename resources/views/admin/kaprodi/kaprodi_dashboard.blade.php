@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex flex-col py-44 px-4 lg:px-12 gap-4">
  <div class="grid grid-cols-12 gap-4">
    <div
      class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
      <div class="flex flex-col gap-y-1">
        <p class="text-sm font-semibold uppercase">Berkas Masuk</p>
        <span class="text-4xl font-semibold ">1</span>
      </div>
      <i class="fas fa-graduation-cap text-4xl"></i>
    </div>
    <div
      class="col-span-12 lg:col-span-6 p-8 rounded-xl bg-white text-color-primary-500 flex justify-between items-center border border-slate-200 shadow-sm">
      <div class="flex flex-col gap-y-1">
        <p class="text-sm font-semibold uppercase">Berkas Belum Masuk</p>
        <span class="text-4xl font-semibold ">2</span>
      </div>
      <i class="fas fa-users text-4xl"></i>
    </div>
  </div>
</section>
@endsection