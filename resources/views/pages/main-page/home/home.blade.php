@extends('pages.main-page.layout.main-page-layout')

@section('content')
    <div class="relative">
        <img src="{{ asset('img/backgroundHome.jpg') }}" alt="" style="z-index: 1" class="hidden lg:block">
        <div class="lg:container lg:absolute lg:top-6 lg:left-0 w-full h-full" style="z-index: 2">
            <div class="flex flex-col items-center justify-center h-screen loading transition-transform duration-1000 transform translate-y-100"
                id="HomeTitle">
                <div class="uppercase text-sm lg:text-3xl text-orange-500 font-bold mb-4 antialiased">
                    youth savers club laboratory cooperative
                </div>

                <div
                    class="relative bg-orange-300 rounded border text-orange-900 border-1 shadow-2xl border-orange-900 p-3 w-full lg:w-2/5 h-36">
                    <span class="absolute -top-5 right-0"><img class=" w-8" src="{{ asset('img/pin.png') }}"
                            alt=""></span>
                    <span class="absolute bottom-1 right-3"> <i class="fa-solid fa-circle text-white"
                            style="font-size: 0.5em"></i></span>
                    <span class="absolute bottom-1 left-3"> <i class="fa-solid fa-circle text-white"
                            style="font-size: 0.5em"></i></span>
                    <span class="absolute top-1 left-3"> <i class="fa-solid fa-circle text-white"
                            style="font-size: 0.5em"></i></span>
                    <div id="typed-strings" class=" antialiased">
                        <p>YSC offers a lot of benefits such as <strong>scholarship, trainings, activities, and rewards</strong>.</p>
                        <p>Start your child's financial and social growth now.</p>
                        <p>Start for as low as PHP 150.00 only.</p>
                        <p>Earn a guaranteed interest rate of 2% per annum.</p>
                        <p>Open to all youth with ages between 7 to 17.</p>
                        <p>1 year holding period starting from the date of opening the account.</p>
                        <p>Earn points every time you save and redeem premium items.</p>
                    </div>
                    <div class="mt-4">
                        <span id="typed" class="text-sm lg:text-lg"></span>
                    </div>

                </div>

                <div class="mt-5">
                    <button id="openModal"
                        class="btn bg-orange-400 hover:bg-orange-600 px-5 py-2 border border-1 border-orange-800 shadow-2xl text-white">Apply
                        Now <i class="fa-solid fa-paper-plane ml-3"></i></button>
                </div>
                

              

            </div>

        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <p class="text-center text-md  lg:text-xl mb-3">Terms and Condition</p>
            <a href="{{route('online_application')}}" class="bg-green-300 text-green-700 text-center rounded shadow-xl px-1 lg:px-2 py-1 lg:py-3" style="border:1px solid;  border-color: rgb(21 128 61)">Agree</a>
        </div>
    </div>
    {{-- route('online_application') --}}
@endsection

@push('styles')
    <style>
        body {
            transition: all 3s ease;
            opacity: 0;
        }

        body.loaded {
            opacity: 1;
        }

        /* Styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush
