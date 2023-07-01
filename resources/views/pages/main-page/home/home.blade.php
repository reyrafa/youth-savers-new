<x-guest-layout>
    <div class="body">
        <nav x-data="{ open: false }" class="w-full h-3/4">
            <!-- Primary Navigation Menu -->
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center mt-3 ml-3">
                        <a href="/">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

                    <!-- Navigation Links -->


                    <div class="hidden sm:-my-px sm:ml-10 sm:flex sm:mr-32">
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="#" class="link" :active="request()->routeIs(['ols.transaction.index', 'ols.transaction.show.depositor'])">
                                {{ __('Home') }}
                            </x-nav-main>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="#" class="link" :active="request()->routeIs(['ols.transaction.index', 'ols.transaction.show.depositor'])">
                                {{ __('About Us') }}
                            </x-nav-main>
                        </div>



                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="#" class="link" :active="request()->routeIs(['ols.transaction.index', 'ols.transaction.show.depositor'])">
                                {{ __('Products') }}
                            </x-nav-main>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="#" class="link" :active="request()->routeIs('ho.personnel.denied')">
                                {{ __('Services') }}
                            </x-nav-main>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="#" class="link" :active="request()->routeIs('ho.personnel.denied')">
                                {{ __('Contact Us') }}
                            </x-nav-main>
                        </div>

                    </div>


                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>


                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link href="/" :active="request()->routeIs('dashboard')">
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('About Us') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('Products') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('Services') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('Contact Us') }}
                        </x-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="shrink-0 mr-3">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </div>
                            @endif


                        </div>

                        <div class="mt-3 space-y-1">




                        </div>
                    </div>
                </div>
        </nav>
    </div>

    <div class=" h-80 bg-slate-700">
        <div class="py-4 text-white flex ml-52">
            <div class="w-36 mr-10">
                <div class="border-b-2 border-indigo-500">{{ __('Contact Info') }}</div>
            </div>
            <div class="w-36">
                <div class="border-b-2 border-indigo-500">{{ __('Links') }}</div>
            </div>
        </div>
    </div>
    @push('style')
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                box-sizing: border-box;
            }

            .body {
                background-repeat: no-repeat;
                width: 100%;
                height: 100vh;
                background-image: url('{{ asset('img/background3.jpg') }}');
                background-size: cover;
            }

            .navbar .link {
                position: relative;
            }

            .navbar .link::before {
                content: '';
                position: absolute;
                top: 100%;
                left: 0;
                width: 0;
                height: 2px;
                background: #fff;
                transition: .3s;
            }

            .navbar .link:hover::before {
                width: 100%;
            }
        </style>
    @endpush
    @push('script')
        <script>
            $(document).ready(function() {

            });
        </script>
    @endpush
</x-guest-layout>
