<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-600 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 py-5 px-5 overflow-hidden shadow-xl sm:rounded-lg">
                Welcome to our Youth Savers Club Application
            </div>
        </div>
    </div>
</x-app-layout>