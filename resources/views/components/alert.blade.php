@props([
    'header' => null,
    'type' => 'info',
    'bordered' => false,
])

@php
    $alerts = [
        'info' => 'flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 ',
        'danger' => 'flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 ',
        'success' => 'flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 ',
        'warning' => 'flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 ',
        'dark' => 'flex items-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 ',
    ];

    $borders = [
        'info' => 'border border-blue-300 dark:border-blue-800',
        'danger' => 'dark:border-red-800 border border-red-300',
        'success' => 'dark:border-green-800 border border-green-300',
        'warning' => 'dark:border-yellow-800 border border-yellow-300',
        'dark' => 'dark:border-gray-600 border border-gray-300',
    ];
@endphp

<div {{ $attributes->merge(['class' => $bordered ? $alerts[$type] . $borders[$type]: $alerts[$type]]) }} role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div>
        @if($header)<span class="font-medium">{{ $header }}</span>@endif {{ $slot }}
    </div>
</div>