<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-600 dark:text-gray-200 leading-tight">
            {{ auth()->user()->user_type_id != 4 ? __('TRANSACTION LIST') : __('YOUTH SAVERS LIST') }}<span
                class="ml-5 py-2 px-4 text-sm bg-purple-200 border-1 border-purple-500 text-purple-600 rounded-full">{{ strtoupper(auth()->user()->type->type_name) }}</span>
        </h2>

    </x-slot>
    <div class="container mt-5 pb-14">

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
            @if (auth()->user()->user_type_id == '4')
                <div class="d-flex justify-content-end col-lg-10">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#reportModal"
                        class="btn rounded-full bg-blue-500 border-1 border-blue-700 mb-3 p-2 text-blue-200 text-lg hover:bg-blue-800 hover:text-blue-100">Generate
                        Report
                        <i class="fa-solid fa-file-arrow-down ml-4"></i></a>
                </div>
            @endif
            <div class="col-lg-10 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="d-flex justify-content-end mb-3">
                    <form action="{{ route('ols.transaction.index') }}" method="get">
                        <input type="text" placeholder="Search Name..." name="search"
                            class="rounded bg-slate-300 border-1 border-slate-700 focus:border-transparent" />
                        <button type="submit" class="ml-3 bg-green-500 text-white rounded p-2 px-3"><i
                                class="fa-solid fa-magnifying-glass"></i> Search</button>
                    </form>

                </div>
                <div>
                    @if (request()->filled('search'))
                        <p class=" text-lg text-blue-500 mb-3">Search results for: <span
                                class="uppercase font-bold text-lg">{{ request()->query('search') }}</span></p>
                    @endif
                </div>

                <div class="table-responsive">
                    <table id="myTable" class="table align-middle hover table-bordered text-gray-700">
                        <thead>
                            <tr class=" bg-indigo-50 uppercase text-sm">
                                <th class="border">CID #</th>
                                <th class="border">Name</th>
                                <th class="border">Level</th>
                                <th class="border">Branch</th>
                                <th class="border">Application Date</th>
                                <th class="border">Contact No</th>
                                <th class="border">Action</th>

                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->depositor->id }}</td>
                                    <td>{{ strtoupper($transaction->depositor->lname) }},
                                        {{ strtoupper($transaction->depositor->fname) }}
                                        {{ strtoupper($transaction->depositor->mname) }}
                                    </td>
                                    <td class="font-bold"><span
                                            class="{{ $transaction->level->name == 'ols'
                                                ? 'text-amber-600 bg-amber-200 border-1 border-amber-500 '
                                                : 'text-cyan-600 bg-cyan-200 border-1 border-cyan-500' }}
                                                {{ 'p-1 rounded' }}">{{ strtoupper($transaction->level->name) }}</span>
                                        <span
                                            class="{{ $transaction->status->status_name == 'pending'
                                                ? 'text-green-600 bg-green-200 border-1 border-green-500 '
                                                : ($transaction->status->status_name == 'verified'
                                                    ? 'text-lime-600 bg-lime-200 border-1 border-lime-500'
                                                    : ($transaction->status->status_name == 'approved'
                                                        ? 'text-blue-600 bg-blue-200 border-1 border-blue-500'
                                                        : 'text-red-600 bg-red-200 border-1 border-red-500')) }} 
                                                {{ 'uppercase p-1 ml-3  rounded' }}">{{ $transaction->status->status_name }}
                                            @if ($transaction->status->status_name == 'pending')
                                                <i class="fa-solid fa-clock ml-1"></i>
                                            @elseif($transaction->status->status_name == 'verified')
                                                <i class="fa-solid fa-circle-check ml-1"></i>
                                            @elseif($transaction->status->status_name == 'approved')
                                                <i class="fa-solid fa-thumbs-up ml-1"></i>
                                            @elseif ($transaction->status->status_name == 'disapproved')
                                                <i class="fa-solid fa-circle-xmark ml-1"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $transaction->depositor->branch->branch_name }}</td>
                                    <td>{{ date('d M Y', strtotime($transaction->created_at)) }}</td>
                                    <td>{{ $transaction->depositor->contact_number }}</td>

                                    <td>

                                        <a href=" {{ route('ols.transaction.show.depositor', ['id' => $transaction->id]) }}"
                                            class="btn text-white bg-emerald-700 hover:bg-green-900 hover:text-white"><i
                                                class="fa-solid fa-eye"></i></a>
                                        @if (auth()->user()->user_type_id != 4)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#verifyDep"
                                                data-id="{{ $transaction->id }}" id="verifyBtn"
                                                class="btn bg-blue-700 text-white hover:bg-blue-900 "><i
                                                    class="fa-solid fa-thumbs-up"></i></a>

                                            @if (auth()->user()->user_type_id == 2)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#disappDep"
                                                    data-id="{{ $transaction->id }}" id="disappBtn"
                                                    class="btn bg-red-700 text-white hover:bg-red-900 "><i
                                                        class="fa-solid fa-thumbs-down"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $transactions->onEachSide(1)->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- for verification of depositor --}}
    <div class="modal fade" id="verifyDep" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue-500">
                    <h1 class="modal-title text-white font-lg font-bold">
                        {{ auth()->user()->user_type_id == '2' ? 'Verify Depositor' : 'Approve Depositor' }}</h1>
                    <button type="button" style="font-size:2em; color:white" class="close" data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="" method="POST" id="verifyForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body py-3 px-2">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="remarks" id="floatingTextarea2"
                                style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Remarks</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary text-white"
                            id="btnAddProd">{{ auth()->user()->user_type_id == '2' ? 'Verify' : 'Approve' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- for disapproving the depositor --}}
    <div class="modal fade" id="disappDep" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-red-700">
                    <h1 class="modal-title text-white font-lg font-bold">Disapprove Depositor</h1>
                    <button type="button" style="font-size:2em; color:white" class="close"
                        data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="" method="POST" id="disapproveForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body py-3 px-2">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="remarks" id="floatingTextarea2"
                                style="height: 100px" required></textarea>
                            <label for="floatingTextarea2">Remarks <span class="text-red-600">*</span></label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-red-500 hover:bg-red-900 text-white" id="btnAddProd">
                            Disapprove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- for report --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-green-700">
                    <h1 class="modal-title text-white font-lg font-bold">Youth Savers Club Reports</h1>
                    <button type="button" style="font-size:2em; color:white" class="close"
                        data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="{{ route('ols.transaction.generate.report') }}" method="POST" id="generateReportForm">
                    @csrf
                    <div class="modal-body py-3 px-2">
                        <x-label-required>Status</x-label-required>
                        <select name="reportType" id="" required class="form-control mt-2 border-black">
                            <option value="" disabled="disabled" selected="true">-- Select Status --
                            </option>
                            <option value="1">pending</option>
                            <option value="2">verified</option>
                            <option value="3">approved</option>
                            <option value="4">all</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-green-500 hover:bg-green-900 text-white">
                            Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="loadingOverlay">
        <img src="{{ asset('img/load.gif') }}" alt="loading" id="loadingSpinner" />
    </div>
    @push('style')
        <style>
            #loadingOverlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                display: none;
            }

            #loadingSpinner {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
    @endpush
    @push('script')
        <script>
            $(document).ready(function() {
                $('#verifyForm').on('submit', function() {
                    $('#loadingOverlay').show();
                });
                $('#disapproveForm').on('submit', function() {
                    $('#loadingOverlay').show();
                });
                $('#generateReportForm').on('submit', function() {
                    $('#loadingOverlay').show();
                });
                /*=========================================================
                =========== button for verification of application =====================
                =========================================================*/
                $(document).on('click', '#verifyBtn', function() {
                    const id = $(this).attr('data-id')

                    $('#verifyForm').attr('action',
                        "{{ route('ols.transaction.verify.depositor', ['id' => 'RECORD_ID']) }}"
                        .replace('RECORD_ID', id))


                })

                /*=========================================================================
                =================== button for disapproving the application ===========================
                =========================================================================*/
                $(document).on('click', '#disappBtn', function() {
                    const id = $(this).attr('data-id')
                    $('#disapproveForm').attr('action',
                        "{{ route('ols.transaction.disapprove.application', ['id' => 'RECORD_ID']) }}"
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
