<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 dark:text-gray-200 leading-tight">
            {{ __('Rejected Application List') }}
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
                <div class="d-flex justify-content-end mb-3">
                    <form action="{{ route('ho.personnel.denied') }}" method="get">
                        <input type="text" placeholder="Search Name..." name="search"
                            class="rounded bg-slate-300 border-1 border-slate-700 focus:border-transparent" />
                        <button type="submit" class="ml-3 bg-green-500 text-white rounded p-2 px-3"><i
                                class="fa-solid fa-magnifying-glass"></i> Search</button>
                    </form>

                </div>
                <div>
                    @if (request()->filled('search'))
                        <p class=" text-lg text-blue-500 mb-3">Search results for: <span class="uppercase font-bold text-lg">{{ request()->query('search') }}</span></p>
                    @endif
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table stripe align-middle hover table-bordered">
                        <thead>
                            <tr>
                                <th class="border">CID #</th>
                                <th class="border">Name</th>
                                <th class="border">Level</th>
                                <th class="border">Branch</th>
                                <th class="border">Application Date</th>
                                <th class="border">Contact No</th>
                                <th class="border">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($denieds as $denied)
                                <tr>
                                    <td>{{ $denied->depositor_id }}</td>
                                    <td>{{ $denied->depositor->lname }}, {{ $denied->depositor->fname }}
                                        {{ $denied->depositor->mname }}</td>
                                    <td> <span
                                            class="text-sky-600 bg-sky-200 border-1 border-sky-500 rounded p-1">{{ $denied->level->name }}
                                        </span><span
                                            class="text-red-600 ml-3 bg-red-200 border-1 border-red-500 p-1 px-2 rounded">{{ $denied->status->status_name }}
                                            <i class="fa-solid fa-circle-xmark ml-1"></i></span>
                                    </td>
                                    <td>{{ $denied->depositor->branch->branch_name }}</td>
                                    <td>{{ $denied->created_at }}</td>
                                    <td>{{ $denied->depositor->contact_number }}</td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#resetDep"
                                            data-id="{{ $denied->id }}" id="resetBtn" class="btn btn-primary"><i
                                                class="fa-solid fa-rotate"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $denieds->onEachSide(1)->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- for verification of depositor --}}
    <div class="modal fade" id="resetDep" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue-500">
                    <h1 class="modal-title text-white font-lg font-bold">
                        Reset Application</h1>
                    <button type="button" style="font-size:2em; color:white" class="close" data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="" method="POST" id="resetForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body py-3 px-2">
                        <div>Are you sure you want to reset the application ?</div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary text-white">
                            Reset</button>
                    </div>
                </form>
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
                /*  $('#myTable').DataTable({
                      "columnDefs": [{
                          "className": "dt-center",
                          "targets": "_all"
                      }],
                      "lengthMenu": [5, 10, 20, 50],
                      "order": [0, "asc"]
                  });*/

                $(document).on('click', '#resetBtn', function() {
                    const id = $(this).attr('data-id')

                    $('#resetForm').attr('action',
                        "{{ route('ho.personnel.reset.application', ['id' => 'RECORD_ID']) }}"
                        .replace('RECORD_ID', id))
                })

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
