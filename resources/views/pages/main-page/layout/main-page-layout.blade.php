<x-guest-layout>
    <div class="body" id="navBar">
        <nav x-data="{ open: false }" class="w-full h-3/4 nav-bar">
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
                            <x-nav-main href="{{ route('home') }}" class="link" :active="request()->routeIs('home')">
                                {{ __('Home') }}
                            </x-nav-main>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="{{ route('about_us') }}" class="link" :active="request()->routeIs('about_us')">
                                {{ __('About Us') }}
                            </x-nav-main>
                        </div>



                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">

                            <div class="relative">
                                <button id="dropdownButton"
                                    class="dropdown-button flex items-center text-base link font-medium text-white">
                                    {{ __('Products') }}
                                    <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 14l6-6H4l6 6z" />
                                    </svg>
                                </button>
                                <div id="dropdown" style="z-index: 3"
                                    class="absolute right-0 mt-2 px-2 py-2 w-48 bg-orange-400 rounded-md shadow-lg hidden">
                                    <x-nav-main href="{{route('savings')}}"
                                        class="w-full px-4 py-2 text-sm hover:rounded hover:bg-orange-200">Savings
                                    </x-nav-main>
                                    <x-nav-main href="#"
                                        class="w-full px-4 py-2 text-sm hover:rounded hover:bg-orange-200">Insurance
                                    </x-nav-main>

                                </div>
                            </div>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <div class="relative">
                                <button id="dropdownButtonServices"
                                    class="dropdown-buttonServices flex items-center text-base link font-medium text-white">
                                    {{ __('Services') }}
                                    <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 14l6-6H4l6 6z" />
                                    </svg>
                                </button>
                                <div id="dropdownServices" style="z-index: 3"
                                    class="absolute left-0 mt-2 px-2 py-2 w-48 bg-orange-400 rounded-md shadow-lg hidden">
                                    <x-nav-main href="{{route('downloadable_forms')}}"
                                        class="w-full px-4 py-2 text-sm hover:rounded hover:bg-orange-200">Downloadable
                                        Forms</x-nav-main>
                                    <x-nav-main href="{{route('online_application')}}"
                                        class="w-full px-4 py-2 text-sm hover:rounded hover:bg-orange-200">Online
                                        Membership</x-nav-main>

                                </div>
                            </div>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href=" {{ route('contact_us') }}" class="link" :active="request()->routeIs('contact_us')">
                                {{ __('Contact Us') }}
                            </x-nav-main>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex navbar">
                            <x-nav-main href="#" class="link" :active="request()->routeIs('ho.personnel.denied')">
                                {{ __('Benefits') }}
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
                        <x-responsive-nav-link href="/" :active="request()->routeIs('home')">
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('about_us') }}" :active="request()->routeIs('about_us')">
                            {{ __('About Us') }}
                        </x-responsive-nav-link>
                        <div class="border-top border-gray-200 dark:border-gray-600"></div>
                        <div class="font-medium text-gray-600">Products</div>
                        <x-responsive-nav-link href="{{route('savings')}}">
                            {{ __('Savings') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="" :active="request()->routeIs('dashboard')">
                            {{ __('Insurance') }}
                        </x-responsive-nav-link>
                        <div class="border-top border-gray-200 dark:border-gray-600"></div>
                        <div class="font-medium text-gray-600">Services</div>
                        <x-responsive-nav-link href="{{route('downloadable_forms')}}" :active="request()->routeIs('downloadable_forms')">
                            {{ __('Downloadable Forms') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('Online Membership') }}
                        </x-responsive-nav-link>
                        <div class="border-top border-gray-200 dark:border-gray-600"></div>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('Contact Us') }}
                        </x-responsive-nav-link>
                        <div class="border-top border-gray-200 dark:border-gray-600"></div>
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')">
                            {{ __('Benefits') }}
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
        @yield('content')
    </div>

    @include('pages.main-page.layout.footer')

    @stack('styles')

    @push('style')
        <style id="dynamic-style">
            * {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                box-sizing: border-box;
            }

            .nav-bar {
                background-color: #F36C3C;
                padding-bottom: 5px;

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

            .navbar .link.active:hover::before {
                width: 0%;
            }

            .loading {
                opacity: 0;
                transform: translateY(500px);
            }

            .loading.loaded {
                opacity: 1;
                transform: translateY(0px);
            }
        </style>
    @endpush


    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdownButton = document.querySelector('#dropdownButton');

                const dropdown = document.querySelector('#dropdown');



                dropdownButton.addEventListener('click', function() {
                    dropdown.classList.toggle('hidden');
                });


                document.addEventListener('click', function(event) {
                    const targetElement = event.target;
                    if (!targetElement.closest('#dropdownButton')) {
                        dropdown.classList.add('hidden');
                    }
                });

                const dropdownButtonServices = document.querySelector('#dropdownButtonServices')
                const dropdownServices = document.querySelector('#dropdownServices')

                dropdownButtonServices.addEventListener('click', function() {
                    dropdownServices.classList.toggle('hidden');
                })

                document.addEventListener('click', function(event) {
                    const targetElementServices = event.target;
                    if (!targetElementServices.closest('#dropdownButtonServices')) {
                        dropdownServices.classList.add('hidden')
                    }
                })

            });

            var typed = new Typed('#typed', {
                stringsElement: '#typed-strings',
                smartBackspace: true,
                typeSpeed: 20,
                startDelay: 500,
                backSpeed: 20,
                shuffle: false,
                backDelay: 700,
                fadeOutClass: 'typed-fade-out',
                fadeOutDelay: 500,

                loop: true,
                loopCount: Infinity,
                showCursor: true,
                cursorChar: '|',
            });
            window.onload = function() {
                var element = document.getElementById('HomeTitle');
                element.classList.add('loaded');
                document.body.classList.add('loaded');
                var nav = document.getElementById('navBar');
                nav.classList.add('loaded');
            };

            $(document).ready(function() {

            });



            // for the modal terms and condition

            const openModalButton = document.getElementById('openModal');
            const modal = document.getElementById('myModal');
            const closeModalButton = document.getElementById('closeModal');

            openModalButton.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            closeModalButton.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            modal.addEventListener('click', (event) => {
                // Prevent modal from closing when clicking inside the modal
                event.stopPropagation();
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        </script>
    @endpush
</x-guest-layout>
