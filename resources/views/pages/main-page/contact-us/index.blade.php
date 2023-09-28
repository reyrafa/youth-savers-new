@extends('pages.main-page.layout.main-page-layout')

@section('content')
    <div class="mt-3 ml-2 mr-2 lg:ml-5 lg:mr-5">
        <div class="mb-3 text-base lg:text-3xl tracking-wide font-bold text-green-600">Contacts</div>
        <div class="mb-32">
            <div>Want to know about your branch? <a href="https://orointegrated.coop/feedback/branch-locator/" target="_blank"
                    class="text-blue-400 text-decoration-underline">Click me!</a></div>
            <div class="mt-3"><a href="https://www.facebook.com/oic.ysclabcoop"
                    class="text-sm mr-2 btn bg-blue-400 text-white hover:bg-blue-500" target="_blank"><i
                        class="fa-brands fa-facebook"></i><span class="ml-2">FB Page</span></a>

            </div>
            <div class="mt-3"> <a href="https://www.instagram.com/oic_ysc/" target="_blank"
                    class="mr-2 btn bg-rose-400 text-white hover:bg-rose-500 text-sm"><i
                        class="fa-brands fa-instagram"></i><span class="ml-2">IG Page</span></a></div>
        </div>
    </div>
@endsection

@push('styles')
@endpush
