@props(['active'])

@php
$classes = ($active ?? false)
            ? 'dropdown-button flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-md shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 active'
            : 'inline-flex items-center px-1 pt-1 border-transparent text-base font-medium leading-5 text-white hover:text-white focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
