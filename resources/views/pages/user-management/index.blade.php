<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-600 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
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
            <div class="col-lg-10 flex justify-end mb-3">
                <a href="#" class="btn bg-blue-600 text-white hover:bg-blue-900 font-bold" data-bs-toggle="modal"
                    data-bs-target="#addUser"><i class="fa-solid fa-user-pen"></i> Add User</a>
            </div>

            <div class="col-lg-10 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="table-responsive">
                    <table id="myTable" class="table stripe align-middle hover table-bordered">
                        <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Name</th>
                                <th class="border">Company ID</th>
                                <th class="border">Branch</th>
                                <th class="border">Type</th>

                                <th class="border">Created On</th>
                                <th class="border">Last Update</th>
                                <th class="border">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($officers as $officer)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td> {{ strtoupper($officer->fname) }} {{ strtoupper($officer->mname) }}
                                        {{ strtoupper($officer->lname) }} </td>
                                    <td> {{ $officer->company_id }} </td>

                                    <td> {{ $officer->branch->branch_name }} </td>

                                    <td><span
                                            class="uppercase p-1 rounded text-blue-600 bg-blue-200 border-1 border-blue-500 ml-3">{{ strtoupper($officer->users->type->type_name) }}</span>
                                        @if (strtolower($officer->users->status->status_name) == 'active')
                                            <span
                                                class="p-1 rounded text-green-600 bg-green-200 border-1 border-green-500 ml-3">{{ strtolower($officer->users->status->status_name) }}
                                                <i class="fa-solid fa-circle-check ml-1"></i></span>
                                        @else
                                            <span
                                                class="p-2 text-sm rounded-full bg-gray-400 text-white ml-3">{{ strtolower($officer->users->status->status_name) }}</span>
                                        @endif

                                    </td>


                                    <td> {{ date('d M Y', strtotime($officer->created_at)) }} </td>
                                    <td class="text-blue-500"> {{ $officer->updated_at->diffForHumans() }} </td>
                                    <td> <a href="#" data-bs-toggle="modal" data-bs-target="#updateUser"
                                            class="btn bg-blue-600 text-white hover:bg-blue-900" id="update_user_btn"
                                            data-id="{{ $officer->id }}"><i class="fa-solid fa-wrench"></i></a>
                                        <a href="#" class="btn bg-red-500 text-white hover:bg-red-900"
                                            data-bs-toggle="modal" data-bs-target="#deleteUser"
                                            data-id="{{ $officer->id }}" id="delete_user_btn"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- for adding user --}}
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue-500">
                    <h1 class="modal-title text-white font-lg font-bold">ADD OFFICER</h1>
                    <button type="button" style="font-size:2em; color:white" class="close" data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="{{ route('user.management.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-3 px-5">
                        <x-label-required for="fname" value="{{ __('Firstname') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="text"
                            name="officer[fname]" placeholder="Enter Firstname" required
                            value="{{ old('officer.fname') }}" />

                        <x-label-required for="mname" value="{{ __('Middlename') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="text"
                            name="officer[mname]" placeholder="Enter Middlename" required
                            value="{{ old('officer.mname') }}" />

                        <x-label-required for="lname" value="{{ __('Lastname') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="text"
                            name="officer[lname]" placeholder="Enter Lastname" required
                            value="{{ old('officer.lname') }}" />

                        <x-label-required for="company_id" value="{{ __('Company ID') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="number"
                            placeholder="Enter Company ID" name="users[company_id]" required
                            value="{{ old('users.company_id') }}" />

                        <x-label-required for="user_type_id" value="{{ __('User Type') }}" />
                        <select name="users[user_type_id]" id="user_type_id" class="form-control mt-1 mb-2 border-black"
                            required>
                            <option value="" disabled="disabled" selected="true">--Select Type--</option>
                            @foreach ($user_types as $user_type)
                                @if ($user_type->id != 1)
                                    <option value={{ $user_type->id }}
                                        {{ old('users.user_type_id') == $user_type->id ? 'selected' : '' }}>
                                        {{ $user_type->type_name }}</option>
                                @endif
                            @endforeach
                        </select>

                        <x-label-required for="user_status_id" value="{{ __('Status') }}" />
                        <select name="users[user_status_id]" id="user_status_id"
                            class="form-control mt-1 mb-2 border-black" required>
                            <option value="" disabled="disabled" selected="true">--Select Status--</option>
                            @foreach ($status as $user_stat)
                                <option value={{ $user_stat->id }}
                                    {{ old('users.user_status_id') == $user_stat->id ? 'selected' : '' }}>
                                    {{ $user_stat->status_name }}</option>
                            @endforeach
                        </select>

                        <x-label-required for="branch_id" value="{{ __('Branch') }}" />
                        <select name="officer[branch_id]" id="branch_id" class="form-control mt-1 mb-2 border-black"
                            required>
                            <option value="" disabled="disabled" selected="true">--Select Branch--</option>
                            @foreach ($branchs as $branch)
                                <option value={{ $branch->id }}
                                    {{ old('officer.branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}</option>
                            @endforeach
                        </select>

                        <x-label-required for="password" value="{{ __('Password') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="password"
                            name="users[password]" required value="{{ old('users.password') }}" />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary text-white" id="btnAddProd"> Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- for updating user --}}
    <div class="modal fade" id="updateUser" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-green-600">
                    <h1 class="modal-title text-white font-lg font-bold">UPDATE OFFICER</h1>
                    <button type="button" style="font-size:2em; color:white" class="close"
                        data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="" method="POST" id="update_form">
                    @method('PUT')
                    @csrf
                    <div class="modal-body py-3 px-5">
                        <x-label-required for="fname" value="{{ __('Firstname') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="text" id="u_fname"
                            name="officer[fname]" placeholder="Enter Firstname" required
                            value="{{ old('officer.fname') }}" />

                        <x-label-required for="mname" value="{{ __('Middlename') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="text" id="u_mname"
                            name="officer[mname]" placeholder="Enter Middlename" required
                            value="{{ old('officer.mname') }}" />

                        <x-label-required for="lname" value="{{ __('Lastname') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="text" id="u_lname"
                            name="officer[lname]" placeholder="Enter Lastname" required
                            value="{{ old('officer.lname') }}" />

                        <x-label-required for="company_id" value="{{ __('Company ID') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="number"
                            id="u_company_id" placeholder="Enter Company ID" name="users[company_id]" required
                            value="{{ old('users.company_id') }}" />

                        <x-label-required for="user_type_id" value="{{ __('User Type') }}" />
                        <select name="users[user_type_id]" id="u_user_type_id"
                            class="form-control mt-1 mb-2 border-black" required>
                            <option value="" disabled="disabled" selected="true">--Select Type--</option>
                            @foreach ($user_types as $user_type)
                                @if ($user_type->id != 1)
                                    <option value={{ $user_type->id }}
                                        {{ old('users.user_type_id') == $user_type->id ? 'selected' : '' }}>
                                        {{ $user_type->type_name }}</option>
                                @endif
                            @endforeach
                        </select>

                        <x-label-required for="user_status_id" value="{{ __('Status') }}" />
                        <select name="users[user_status_id]" id="u_user_status_id"
                            class="form-control mt-1 mb-2 border-black" required>
                            <option value="" disabled="disabled" selected="true">--Select Status--</option>
                            @foreach ($status as $user_stat)
                                <option value={{ $user_stat->id }}
                                    {{ old('users.user_status_id') == $user_stat->id ? 'selected' : '' }}>
                                    {{ $user_stat->status_name }}</option>
                            @endforeach
                        </select>

                        <x-label-required for="branch_id" value="{{ __('Branch') }}" />
                        <select name="officer[branch_id]" id="u_branch_id"
                            class="form-control mt-1 mb-2 border-black" required>
                            <option value="" disabled="disabled" selected="true">--Select Branch--</option>
                            @foreach ($branchs as $branch)
                                <option value={{ $branch->id }}
                                    {{ old('officer.branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}</option>
                            @endforeach
                        </select>

                        <x-label-required for="password" value="{{ __('Password') }}" />
                        <input class="mt-1 mb-2 rounded-lg form-control border-black" type="password"
                            name="users[password]" required value="{{ old('users.password') }}" />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-success text-white" id="btnAddProd"> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- delete record --}}
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-red-600">
                    <h1 class="modal-title text-white font-lg font-bold">DELETE OFFICER</h1>
                    <button type="button" style="font-size:2em; color:white" class="close"
                        data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="" method="POST" id="delete_form">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body py-3 px-2 text-center">
                        Are you sure you want to delete this user? this is ireversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gray-500 text-white hover:bg-gray-500"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-red-600 hover:bg-red-800 text-white" id="btnAddProd">
                            Delete</button>
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
                $('#myTable').DataTable({
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                    "lengthMenu": [5, 10, 20, 50],
                });


                /*=========================================================
                =========== button for updating the user =====================
                =========================================================*/
                $(document).on('click', '#update_user_btn', function() {
                    const uid = $(this).attr('data-id')
                    $.ajax({
                        type: "get",
                        url: "{{ route('user.management.get-user') }}",
                        data: {
                            'id': uid
                        },

                        success: function(response) {

                            $('#u_fname').val(response.officer.fname)
                            $('#u_lname').val(response.officer.lname)
                            $('#u_mname').val(response.officer.mname)
                            $('#u_company_id').val(response.officer.company_id)
                            $('#u_user_type_id').val(response.user.user_type_id)
                            $('#u_user_status_id').val(response.user.user_status_id)
                            $('#u_branch_id').val(response.officer.branch_id)
                            $('#update_form').attr('action',
                                "{{ route('user.management.update', ['id' => 'RECORD_ID']) }}"
                                .replace('RECORD_ID', response.officer.id))
                        }
                    });
                })

                /*=========================================================================
                =================== button for deleting user ===========================
                =========================================================================*/
                $(document).on('click', '#delete_user_btn', function() {
                    const id = $(this).attr('data-id')
                    $('#delete_form').attr('action',
                        "{{ route('user.management.delete', ['id' => 'RECORD_ID']) }}"
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
