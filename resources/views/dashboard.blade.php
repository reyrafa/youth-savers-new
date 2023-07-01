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
                <div class="mt-5">
                    @foreach ($stats as $status)
                        <div class="flex items-center mb-4">
                            <div class="mr-4">
                                <span class="text-sm font-medium uppercase">{{ $status->status_name }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="w-full bg-gray-200 rounded-full">
                                    <div id="totalcount"
                                        class="{{ $status->status_name == 'pending'
                                            ? 'bg-blue-700'
                                            : ($status->status_name == 'verified'
                                                ? 'bg-green-500'
                                                : ($status->status_name == 'approved'
                                                    ? 'bg-yellow-500'
                                                    : 'bg-red-500')) }} {{ 'text-xs leading-none py-1
                                                                                                text-center text-white
                                                                                                rounded-full
                                                                                                 loading' }}"
                                        style="width: {{ number_format(($status->transactions_count / $totalTransactions) * 100, 2) }}%; animation: progress 0.4s ease-in-out forwards; opacity:0">
                                        <span>{{ number_format(($status->transactions_count / $totalTransactions) * 100, 2) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
    @push('style')
        <style>
            @keyframes progress{
                0%{
                    width: 0;
                    opacity: 1;

                }
                100%{
                    opacity: 1;
                }
            }
        </style>
    @endpush

    @push('script')
        <script>
       
        </script>
    @endpush
</x-app-layout>
