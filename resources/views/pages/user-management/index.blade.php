<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-600 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="flex justify-end">
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Add User</a>
            </div>

            <div class="col-lg-10 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="table-responsive">
                    <table id="myTable" class="table stripe align-middle hover table-bordered">
                        <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">College</th>
                                <th class="border">Date Created</th>
                                <th class="border">Last Update</th>
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
            =========== button for adding college =====================
            =========================================================*/
            $(document).on('click', '.funcBut', function() {
                Swal.fire({
                    title: 'ADD COLLEGE',
                    text: "",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    input: "text",
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Add College',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Please input a college!'
                        }
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        college = result.value
                        $.ajax({
                            type: "post",
                            url: "{!!URL::to('addCollege')!!}",
                            data: {
                                "id": college,
                                _token: '{{csrf_token()}}'
                            },

                            success: function(response) {
                                if (response >= 1) {
                                    Swal.fire({
                                        title: 'There is already a ' + college + '!',
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
                                } else {
                                    Swal.fire({
                                        title: 'College is Added Successfully!',
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

                            }
                        });
                        /* Swal.fire(
                         'Deleted!',
                         'Your file has been deleted.',
                         'success'
                         )
                         $('#tr_'+id).hide(2000);*/
                    }
                })
            })


            /*=========================================================================
            =================== button for updating college ===========================
            =========================================================================*/
            $(document).on('click', '.updateCollegeBtn', function() {
                college = $(this).attr('data-college')
                id = $(this).attr('data-id')

                Swal.fire({
                    title: 'UPDATE COLLEGE',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    input: "text",
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update College',
                    inputValue: college,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Please input a college!'
                        }

                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        college = result.value
                        $.ajax({
                            type: "post",
                            url: "{!!URL::to('updateCollege')!!}",
                            data: {
                                "id": id,
                                'college': college,
                                _token: '{{csrf_token()}}'
                            },

                            success: function(response) {
                                if (response >= 1) {
                                    Swal.fire({
                                        title: 'College should not be the same!',
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
                                } else {
                                    Swal.fire({
                                        title: 'College is Updated Successfully!',
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
                            }
                        });

                    }
                })
            })

            /*=========================================================================
            =================== button for deleting college ===========================
            =========================================================================*/

            $(document).on('click', '.deleteCollege', function() {
                const id = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this! Departments that belong to this college are affected.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "{!!URL::to('deleteCollege')!!}",
                            data: {
                                "id": id,
                                _token: '{{csrf_token()}}'
                            },

                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'College is Deleted Successfully!',
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
                                } else {
                                    Swal.fire({
                                        title: response.message,
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


                            }
                        });

                    }
                })

            })

            /*=================================================================
            ============ success alerts after successfull process ====================
            ==================================================================*/
            var successMessage = '{{ session("success") }}';
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
            ============ pop up error double entry of semester and others ====================
            ==================================================================*/
            var errorMessage = '{{ session("error") }}';
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