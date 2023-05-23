<x-guest-layout>
    @auth
    <div class="flex items-center justify-center h-screen">
        <p class="text-3xl text-red-700">{{strtoupper('You Cannot access this.')}}</p>
    </div>
    @else
    <div class="min-h-screen bg-gray-100 relative">
        <div class="bg-green-600 w-full px-5 py-6">
            <img src="/img/oicLogo.png" class=" w-56" alt="OIC LOGO">
        </div>
        @if ($errors->any())
        <div class="alert alert-danger mt-4 w-52">
            <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="flex justify-center pb-20 pt-10">
            <div class=" w-5/6 h-full p-5 bg-gray-300 rounded-lg shadow-2xl">

                <div class="bg-cyan-500 rounded-lg text-justify p-4 mb-3">
                    <h1 class="text-2xl antialiased font-bold text-green-800 text-center mb-3">Youth Savers Club Online Application</h1>
                    <span class="text-lg font-semibold">Instructions</span>
                    <ul class="list-disc ml-5">
                        <li>Please fill-out all the fillable forms below. (Asterisk (<span class="text-red-900 text-2xl font-bold">*</span>) indicates required field)</li>
                        <li>Note: To qualify for membership, your age must be on range of 7 - 18 years old.</li>
                    </ul>
                </div>

                <div class="bg-cyan-500 p-2 rounded-lg mb-4">
                    <span class="text-xl text-green-800 font-extrabold">Personal Information</span>
                </div>
                <form action="{{route('depositor.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- personal information --}}
                        <div class="col-lg-3">
                            <x-label-required for="fname" value="{{ __('Firstname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="depositor[fname]" placeholder="Enter Firstname" required value="{{ old('depositor.fname') }}" />

                        </div>
                        <div class="col-lg-3">
                            <x-label-required for="mname" value="{{ __('Middlename') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="depositor[mname]" placeholder="Enter Middlename" required value="{{ old('depositor.mname') }}" />

                        </div>
                        <div class="col-lg-4">
                            <x-label-required for="lname" value="{{ __('Lastname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="depositor[lname]" placeholder="Enter Lastname" required value="{{ old('depositor.lname') }}" />

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label for="suffix" value="{{ __('Suffix') }}" />
                            <select name="depositor[suffix]" id="" class="form-control mt-1 border-black">
                                <option value="">suffix</option>
                                <option value="Sr" @if(old('depositor.suffix')=="Sr" ){{'selected'}} @endif>Sr</option>
                                <option value="Jr" @if(old('depositor.suffix')=="Jr" ){{'selected'}} @endif>Jr</option>
                                <option value="II" @if(old('depositor.suffix')=="II" ){{'selected'}} @endif>II</option>
                                <option value="III" @if(old('depositor.suffix')=="III" ){{'selected'}} @endif>III</option>
                                <option value="IV" @if(old('depositor.suffix')=="IV" ){{'selected'}} @endif>IV</option>
                                <option value="V" @if(old('depositor.suffix')=="V" ){{'selected'}} @endif>V</option>
                                <option value="VI" @if(old('depositor.suffix')=="VI" ){{'selected'}} @endif>VI</option>
                                <option value="VII" @if(old('depositor.suffix')=="VII" ){{'selected'}} @endif>VII</option>
                                <option value="VIII" @if(old('depositor.suffix')=="VIII" ){{'selected'}} @endif>VIII</option>
                            </select>

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="birth_date" value="{{ __('Birth Date') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="date" id="birth_date" name="depositor[birth_date]" required value="{{ old('depositor.birth_date') }}" min="{{ now()->subYears(17)->format('Y-m-d') }}" max="{{ now()->subYears(7)->format('Y-m-d') }}" />
                            <span style="color: red; font-size: 10px" id="birth_error" class="ml-2 mt-2 hidden">Opps, Age should be between 7 - 17 years old
                            </span>
                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="contact_number" value="{{ __('Contact Number') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="number" name="depositor[contact_number]" placeholder="Enter Contact number" required value="{{ old('depositor.contact_number') }}" onKeyPress="if(this.value.length==11) return false;" />

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="gender" value="{{ __('Gender') }}" />
                            <select name="depositor[gender]" id="" class="form-control mt-1 border-black" required>
                                <option value="" disabled="disabled" selected="true">-- Sex --</option>
                                <option value="Male" @if(old('gender')=='depositor.Male' ){{'selected'}} @endif>Male</option>
                                <option value="Female" @if(old('gender')=='depositor.Female' ){{'selected'}} @endif>Female</option>

                            </select>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="branch_loc_id" value="{{ __('Branch Location') }}" />
                            <select name="depositor[branch_loc_id]" id="branch_loc_id" class="form-control mt-1 border-black" required>
                                <option value="" disabled="disabled" selected="true">--Select Location--</option>
                                @foreach ($locations as $location)
                                @if ($location->id != 7)
                                <option value={{$location->id}} {{ old('depositor.branch_loc_id')==$location->id ? 'selected' : '' }}>{{$location->location}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="branch_id" value="{{ __('Branch') }}" />
                            <select name="depositor[branch_id]" id="branch_id" class="form-control mt-1 border-black" required>
                                <option value="" disabled="disabled" selected="true">--Select Branch--</option>

                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <x-label-required for="home_address" value="{{ __('Home Address') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="depositor[home_address]" placeholder="Enter Address" required value="{{ old('depositor.home_address') }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="email_add" value="{{ __('Email') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="depositor[email_add]" placeholder="Enter Email" required value="{{ old('depositor.email_add') }}" />

                        </div>


                        {{-- guardian information --}}
                        <div class="col-lg-12 mb-4">
                            <span class="text-xl text-green-800 block font-bold p-2 rounded-lg bg-cyan-500">Guardian Information</span>
                        </div>
                        <div class="col-lg-3">
                            <x-label-required for="g_fname" value="{{ __('Firstname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="guardian[g_fname]" placeholder="Enter Firstname" required value="{{ old('guardian.g_fname') }}" />

                        </div>
                        <div class="col-lg-3">
                            <x-label-required for="g_mname" value="{{ __('Middlename') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="guardian[g_mname]" placeholder="Enter Middlename" required value="{{ old('guardian.g_mname') }}" />

                        </div>
                        <div class="col-lg-4">
                            <x-label-required for="g_lname" value="{{ __('Lastname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="guardian[g_lname]" placeholder="Enter Lastname" required value="{{ old('guardian.g_lname') }}" />

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label for="g_suffix" value="{{ __('Suffix') }}" />
                            <select name="guardian[g_suffix]" id="" class="form-control mt-1 border-black">
                                <option value="">suffix</option>
                                <option value="Sr" @if(old('guardian.g_suffix')=="Sr" ){{'selected'}} @endif>Sr</option>
                                <option value="Jr" @if(old('guardian.g_suffix')=="Jr" ){{'selected'}} @endif>Jr</option>
                                <option value="II" @if(old('guardian.g_suffix')=="II" ){{'selected'}} @endif>II</option>
                                <option value="III" @if(old('guardian.g_suffix')=="III" ){{'selected'}} @endif>III</option>
                                <option value="IV" @if(old('guardian.g_suffix')=="IV" ){{'selected'}} @endif>IV</option>
                                <option value="V" @if(old('guardian.g_suffix')=="V" ){{'selected'}} @endif>V</option>
                                <option value="VI" @if(old('guardian.g_suffix')=="VI" ){{'selected'}} @endif>VI</option>
                                <option value="VII" @if(old('guardian.g_suffix')=="VII" ){{'selected'}} @endif>VII</option>
                                <option value="VIII" @if(old('guardian.g_suffix')=="VIII" ){{'selected'}} @endif>VIII</option>
                            </select>

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="g_birth_date" value="{{ __('Birth Date') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="date" name="guardian[g_birth_date]" required value="{{ old('guardian.g_birth_date') }}" />

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="g_gender" value="{{ __('Gender') }}" />
                            <select name="guardian[g_gender]" id="" class="form-control mt-1 border-black" required>
                                <option value="" disabled="disabled" selected="true">-- Sex --</option>
                                <option value="Male" @if(old('guardian.g_gender')=='Male' ){{'selected'}} @endif>Male</option>
                                <option value="Female" @if(old('guardian.g_gender')=='Female' ){{'selected'}} @endif>Female</option>

                            </select>
                        </div>

                        <div class="col-lg-2 mb-4">
                            <x-label-required for="g_civil_status" value="{{ __('Civil Status') }}" />
                            <select name="guardian[g_civil_status]" id="g_civil_status" class="form-control mt-1 border-black ">
                                <option value="" selected="true" disabled="disabled">Civil Status*</option>
                                <option value="Single" {{ old('guardian.g_civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{  old('guardian.g_civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Separated" {{  old('guardian.g_civil_status') == 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Widowed" {{ old('guardian.g_civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="g_member_or_not" value="{{ __('Member?') }}" />
                            <select name="guardian[g_member_or_not]" id="" class="form-control mt-1 border-black ">
                                <option value="" selected="true" disabled="disabled">-- select --</option>
                                <option value="Yes" {{ old('guardian.g_member_or_not') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{  old('guardian.g_member_or_not') == 'No' ? 'selected' : '' }}>No</option>

                            </select>

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="g_depositor_relation" value="{{ __('Relation') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="guardian[g_depositor_relation]" placeholder="Enter Relation" required value="{{ old('guardian.g_depositor_relation') }}" />

                        </div>
                        <div class="col-lg-6 mb-4">
                            <x-label-required for="g_home_address" value="{{ __('Home Address') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="guardian[g_home_address]" placeholder="Enter Home Address" required value="{{ old('guardian.g_home_address') }}" />

                        </div>
                        <div class="col-lg-6 mb-4">
                            <x-label-required for="g_present_address" value="{{ __('Present Address') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="guardian[g_present_address]" placeholder="Enter Present Address" required value="{{ old('guardian.g_present_address') }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="g_contact_num" value="{{ __('Contact Number') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="number" name="guardian[g_contact_num]" placeholder="Enter Contact Number" required value="{{ old('guardian.g_contact_num') }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="g_email_add">Email (<span class="text-blue-500">Not Required</span>)</x-label>
                            <input class="mt-1 rounded-lg form-control border-black" type="email" name="guardian[g_email_add]" placeholder="Enter Email Address" value="{{ old('guardian.g_email_add') }}" />

                        </div>

                        {{-- referral information --}}
                        <div class="col-lg-12 mb-4">
                            <span class="text-xl text-green-800 block font-bold p-2 rounded-lg bg-cyan-500">Referral Information ( <span class="text-blue-700">Optional</span> )</span>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="r_fname" value="{{ __('Firstname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="referral[r_fname]" placeholder="Enter Firstname" value="{{ old('referral.r_fname') }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="r_mname" value="{{ __('Middlename') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="referral[r_mname]" placeholder="Enter Middlename" value="{{ old('referral.r_mname') }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="r_lname" value="{{ __('Lastname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text" name="referral[r_lname]" placeholder="Enter Lastname" value="{{ old('referral.r_lname') }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="r_branch_id" value="{{ __('Branch') }}" />
                            <select name="referral[r_branch_id]" id="r_branch_id" class="form-control mt-1 border-black">
                                <option value="" disabled="disabled" selected="true">--Select Location--</option>
                                @foreach ($branchs as $branch)

                                <option value={{$branch->id}} {{ old('referral.r_branch_id')==$branch->id ? 'selected' : '' }}>{{$branch->branch_name}}</option>

                                @endforeach
                            </select>
                        </div>

                        {{-- scanned documents --}}
                        <div class="col-lg-12 mb-4">
                            <span class="text-xl text-green-800 block font-bold p-2 rounded-lg bg-cyan-500">Scanned Documents</span>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <x-label-required for="signature_img">Scanned Signature <span class="text-blue-500 ml-2">(Accepts .png, .jpg, .jpeg)</span></x-label-required>
                            <input type="file" accept="image/jpeg, image/png, image/jpg" value="{{ old('uploaded_file.signature_img')}}" class="mt-1" id="signature_img" name="uploaded_file[signature_img]" required />
                        </div>
                        <div class="col-lg-12 mb-4">
                            <x-label-required for="identification_img">Scanned Valid ID <span class="text-blue-500 ml-2">(Accepts .png, .jpg, .jpeg)</span></x-label-required>
                            <input type="file" class="mt-1" id="identification_img" name="uploaded_file[identification_img]" value="{{ old('uploaded_file.identification_img')}}" required>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <x-label-required for="birth_cert_img">Scanned Birth Certificate<span class="text-blue-500 ml-2">(Accepts .png, .jpg, .jpeg)</span></x-label-required>
                            <input type="file" class="mt-1" id="birth_cert_img" name="uploaded_file[birth_cert_img]" value="{{ old('uploaded_file.birth_cert_img')}}" required>
                        </div>

                        {{-- Online Transaction --}}
                        <div class="col-lg-12 mb-3">
                            <span class="text-xl text-green-800 block font-bold p-2 rounded-lg bg-cyan-500">Payment Screenshot</span>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <h2 class="text-green-600 text-lg font-semibold">Gcash Information : <span class="text-blue-800">09*********</span></h2>
                            <h2 class="text-green-600 text-lg font-semibold">Bank Information : <span class="text-blue-800">854 **** ***</span></h2>
                            <p class="mt-3 mb-3">Note : PHP 150.00 - Membership fee</p>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <x-label-required for="receipt_img">Scanned Reciept <span class="text-blue-500 ml-2">(Accepts .png, .jpg, .jpeg)</span></x-label-required>
                            <input type="file" class="mt-1" id="receipt_img" name="uploaded_file[receipt_img]" value="{{ old('uploaded_file.receipt_img')}}" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="bg-green-600 hover:bg-green-800 rounded-full py-2 px-5 text-white" type="submit" id="submit_application">
                                Submit Application
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        //file pond
        // Get a reference to the file input element
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const signature_img = document.querySelector('input[id="signature_img"]');
        const identification_img = document.querySelector('input[id="identification_img"]');
        const birth_cert_img = document.querySelector('input[id="birth_cert_img"]');
        const receipt_img = document.querySelector('input[id="receipt_img"]');

        // Create a FilePond instance
        const pond = FilePond.create(signature_img, {
            acceptedFileTypes: ['image/png, image/jpeg, image/jpg'],
            onaddfile: function(error, file) {
                if (!error) {
                    if (file.fileType !== 'image/png' && file.fileType !== 'image/jpeg' && file.fileType !== 'image/jpg') {

                        const filePondInstance = FilePond.find(signature_img);
                        filePondInstance.removeFile(file.id);
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid File Format',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        return;
                    }

                }
            }
        });

        const pond1 = FilePond.create(identification_img, {
            acceptedFileTypes: ['image/png, image/jpeg, image/jpg'],
            onaddfile: function(error, file) {
                if (!error) {
                    if (file.fileType !== 'image/png' && file.fileType !== 'image/jpeg' && file.fileType !== 'image/jpg') {

                        const filePondInstance = FilePond.find(identification_img);
                        filePondInstance.removeFile(file.id);
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid File Format',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        return;
                    }

                }
            }
        });

        const pond2 = FilePond.create(birth_cert_img, {
            acceptedFileTypes: ['image/png, image/jpeg, image/jpg'],
            onaddfile: function(error, file) {
                if (!error) {
                    if (file.fileType !== 'image/png' && file.fileType !== 'image/jpeg' && file.fileType !== 'image/jpg') {

                        const filePondInstance = FilePond.find(birth_cert_img);
                        filePondInstance.removeFile(file.id);
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid File Format',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        return;
                    }

                }
            }
        })

        const pond3 = FilePond.create(receipt_img, {
            acceptedFileTypes: ['image/png, image/jpeg, image/jpg'],
            onaddfile: function(error, file) {
                if (!error) {
                    if (file.fileType !== 'image/png' && file.fileType !== 'image/jpeg' && file.fileType !== 'image/jpg') {

                        const filePondInstance = FilePond.find(receipt_img);
                        filePondInstance.removeFile(file.id);
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid File Format',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        return;
                    }

                }
            }
        })

        pond.setOptions({
            server: {
                process: '/upload-signature',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                revert: '/upload-signature-revert'

            }
        })

        pond1.setOptions({
            server: {
                process: '/upload-identification',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                revert: '/upload-identification-revert'

            }
        })

        pond2.setOptions({
            server: {
                process: '/upload-bcertificate',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                revert: '/upload-bcertificate-revert'

            }
        })

        pond3.setOptions({
            server: {
                process: '/upload-receipt',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                revert: '/upload-receipt-revert'

            }
        })

        var successMessage = '{{ session("success") }}';
        if (successMessage !== '') {
            Swal.fire({
                title: successMessage,
                icon: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload(true)
                } else if (result.dismiss === Swal.DismissReason.backdrop) {
                    location.reload(true)
                }
            })
        }
        //
        $(document).ready(function() {
            $('#branch_loc_id').on('change', function() {
                $.ajax({
                    type: "get",
                    url: "/get-branch",
                    data: {
                        'id': this.value
                    },
                    success: function(response) {
                        var options = response;
                        // Clear existing options and add new options
                        $('#branch_id').empty();
                        $.each(options, function(index, option) {
                            if (index == 0) {
                                $('#branch_id').append('<option value="0" selected disabled>--Select Branch--</option>');

                            }
                            $('#branch_id').append('<option value="' + option.id + '">' + option.branch_name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log("fails")
                        console.log(JSON.stringify(error))
                    }
                });
            })

            $('#submit_application').on('click', function() {
                const branch = $('#branch_id').val()

                if (branch === null) {
                    event.preventDefault()
                    Swal.fire({
                        position: 'end',
                        icon: 'error',
                        title: 'Please Select a Branch',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })

            $('#birth_date').on('change', function() {
                const birth_date = new Date(this.value)
                const current_date = new Date();

                const minDate = new Date();
                minDate.setFullYear(current_date.getFullYear() - 17);

                const maxDate = new Date();
                maxDate.setFullYear(current_date.getFullYear() - 7);

                if (birth_date < minDate || birth_date > maxDate) {
                    $('#birth_error').show();
                    $('#submit_application').attr('disabled', 'disabled');
                } else {
                    $('#birth_error').hide();
                    $('#submit_application').removeAttr('disabled');
                }

            })

        })
    </script>
    @endpush
    @endauth
</x-guest-layout>