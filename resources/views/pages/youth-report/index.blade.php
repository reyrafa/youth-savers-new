<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-600 dark:text-gray-200 leading-tight">
            {{ __('Youth Savers List') }} <span
                class="ml-5 py-2 px-4 text-sm bg-green-900 text-white rounded-full">{{ strtoupper(auth()->user()->type->type_name) }}</span>
        </h2>
    </x-slot>
    <div class="container mt-14">

        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="col-lg-10 alert alert-danger mt-4" x-data="{ show: true }" x-show="show">
                    <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}
                    </div>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" @click="show = false"
                        class="absolute top-0 right-0 px-4 py-3 font-bold text-2xl" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="col-lg-10 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="table-responsive">
                    <table id="myTable" class="table stripe align-middle hover table-bordered">
                        <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Name</th>
                                <th class="border">Level</th>
                                <th class="border">Branch</th>
                                <th class="border">Application Date</th>
                                <th class="border">Contact No</th>
                                <th class="border">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                         

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    


    @push('style')
        <style>
            div.dataTables_length select {
                width: 70px;
            }

            div.dataTables_length {
                margin-top: 10px;
                margin-bottom: 20px;

            }

            .dataTables_wrapper .dataTables_paginate {
                margin-top: 15px;
            }
        </style>
    @endpush
    @push('script')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                    "lengthMenu": [5, 10, 20, 50],
                    "order": [0, "asc"]
                });


                /*=================================================================
                ============ success alerts after successfull process ====================
                ==================================================================*/
                var successMessage = '{{ session('success') }}';
                if (successMessage !== '') {
                    Swal.fire({
                        title: successMessage,
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload(true)
                        } else if (result.dismiss === Swal.DismissReason.backdrop) {
                            location.reload(true)
                        }
                    })
                }

                /*=================================================================
                ============ pop up errors  ====================
                ==================================================================*/
                var errorMessage = '{{ session('error') }}';
                if (errorMessage !== '') {
                    Swal.fire({
                        title: errorMessage,
                        icon: 'error',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload(true)
                        } else if (result.dismiss === Swal.DismissReason.backdrop) {
                            location.reload(true)
                        }
                    })
                }

            });
        </script>
    @endpush
</x-app-layout>
