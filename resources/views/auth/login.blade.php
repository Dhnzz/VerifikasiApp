@extends('layout.auth')

@section('main')
    <section class="flex h-screen">
        <div class="flex-[1] hidden bg-color-primary-500 lg:flex items-center justify-center">
            <img src="/illustration/Data-report.png" alt="" class="w-80">
        </div>
        <div class="flex-[1] bg-white flex flex-col justify-center items-center gap-y-2">
            <h1 class="text-3xl font-semibold">Selamat Datang!</h1>
            <p class="text-sm">Silahkan Masuk Dengan Akun Yang Terdaftar</p>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('login') }}" method="post" class="max-w-md px-6 w-full mt-4">
                @csrf
                <div class="mb-5">
                    <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        NIM/NIDN</label>
                    <input type="text" id="large-input" name="credential"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-5">
                    <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Password</label>
                    <input type="password" id="large-input" name="password"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex flex-col gap-y-2">
                    <x-button_lg type="submit" color="primary" class="w-full ">
                        Masuk
                    </x-button_lg>
                    <x-button_lg color="danger-outlined" class="w-full ">
                        Daftar
                    </x-button_lg>
                </div>
            </form>
        </div>
    </section>
@endsection
