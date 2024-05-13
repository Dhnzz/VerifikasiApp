@props(['color' => 'primary'])

@php
$colorClasses = [
'primary' => 'text-white bg-color-primary-500 hover:bg-color-primary-600 focus:ring-4 focus:ring-color-primary-400',
'warning' => 'text-white bg-color-warning-500 hover:bg-color-warning-600 focus:ring-4 focus:ring-color-warning-400',
'success' => 'text-white bg-color-success-500 hover:bg-color-success-600 focus:ring-4 focus:ring-color-success-400',
'danger' => 'text-white bg-color-danger-500 hover:bg-color-danger-600 focus:ring-4 focus:ring-color-danger-400',
'info' => 'text-white bg-color-info-500 hover:bg-color-info-600 focus:ring-4 focus:ring-color-info-400',
'primary-dark' => 'text-slate-800 bg-color-primary-500 hover:bg-color-primary-600 focus:ring-4 focus:ring-color-primary-400',
'warning-dark' => 'text-slate-800 bg-color-warning-500 hover:bg-color-warning-600 focus:ring-4 focus:ring-color-warning-400',
'success-dark' => 'text-slate-800 bg-color-success-500 hover:bg-color-success-600 focus:ring-4 focus:ring-color-success-400',
'danger-dark' => 'text-slate-800 bg-color-danger-500 hover:bg-color-danger-600 focus:ring-4 focus:ring-color-danger-400',
'info-dark' => 'text-slate-800 bg-color-info-500 hover:bg-color-info-600 focus:ring-4 focus:ring-color-info-400',
// tambahkan definisi warna lain di sini sesuai kebutuhan Anda
];

$class = $colorClasses[$color] ?? 'text-slate-800 bg-white hover:bg-gray-100';
@endphp

<button type="button" {{ $attributes->merge(['class' => 'px-5 py-3 text-base font-medium text-center rounded-xl ' . $class]) }}>
    {{ $slot }}
</button>