<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-amber-600 dark:text-gray-200 leading-tight">
                <a href="{{ route('ols.transaction.index') }}"
                    class="btn bg-orange-400 border-1 border-orange-600 text-orange-100 mr-4 hover:bg-orange-600 hover:text-lg hover:text-orange-100"
                    style="transform: scale(1.2); width: 50px; height: 40px;"><i
                        class="fa-solid fa-hand-point-left"></i></a>
                {{ __('DEPOSITOR INFORMATION') }} <span
                    class="ml-5 py-2 px-4 text-sm bg-purple-200 border-1 border-purple-500 text-purple-600 rounded-full">{{ strtoupper(auth()->user()->type->type_name) }}</span>
            </h2>
            <div class="flex items-end">
                @if (auth()->user()->user_type_id != '4')
                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifyDep" data-id="{{ $transaction->id }}"
                        id="verifyBtn"
                        class="btn bg-blue-700 text-lg mr-3 text-white hover:bg-blue-900 hover:text-lg">{{ auth()->user()->user_type_id == 2 ? 'Verify' : 'Approve' }}
                        <i class="fa-solid fa-thumbs-up"></i></a>
                @endif
                @if (auth()->user()->user_type_id == '2')
                    <a href="#" data-bs-toggle="modal" data-bs-target="#disappDep"
                        data-id="{{ $transaction->id }}" id="disappBtn"
                        class="btn text-lg mr-3 bg-red-700 text-white hover:bg-red-900 hover:text-lg">Reject
                        <i class="fa-solid fa-face-frown"></i></a>
                @endif

                <a href=" {{ route('ols.transaction.print', ['id' => $id]) }}" target="_blank"
                    class="btn bg-teal-600 text-white font-bold text-lg hover:bg-teal-900">Print <i
                        class="fa-solid fa-print"></i></a>

            </div>
        </div>
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

            <div class="col-lg-10 bg-gray-300 overflow-hidden shadow-xl sm:rounded-lg px-5 mb-5 py-4">

                <form action=" {{ route('ols.transaction.update.application', ['id' => $transaction->depositor_id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mt-9">
                        <div class="col-lg-12">
                            <div class="bg-green-900 p-2 rounded-lg mb-4">
                                <span class="text-xl text-white font-extrabold uppercase">Personal Information</span>
                            </div>
                        </div>
                        {{-- personal information --}}
                        <div class="col-lg-3">
                            <x-label-required for="fname" value="{{ __('Firstname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="depositor[fname]" placeholder="Enter Firstname" required
                                value="{{ $transaction->depositor->fname }}" />
                        </div>
                        <div class="col-lg-3">
                            <x-label-required for="mname" value="{{ __('Middlename') }}" />
                            <input class="mt-1 uppercase rounded-lg form-control border-black" type="text"
                                name="depositor[mname]" placeholder="Enter Middlename" required
                                value="{{ $transaction->depositor->mname }}" />


                        </div>
                        <div class="col-lg-4">
                            <x-label-required for="lname" value="{{ __('Lastname') }}" />
                            <input class="mt-1 uppercase rounded-lg form-control border-black" type="text"
                                name="depositor[lname]" placeholder="Enter Lastname" required
                                value="{{ $transaction->depositor->lname }}" />


                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label for="suffix" value="{{ __('Suffix') }}" />
                            <select name="depositor[suffix]" id="" class="form-control mt-1 border-black">
                                <option value="">suffix</option>
                                <option value="Sr" @if ($transaction->depositor->suffix == 'Sr') {{ 'selected' }} @endif>Sr
                                </option>
                                <option value="Jr" @if ($transaction->depositor->suffix == 'Jr') {{ 'selected' }} @endif>Jr
                                </option>
                                <option value="II" @if ($transaction->depositor->suffix == 'II') {{ 'selected' }} @endif>II
                                </option>
                                <option value="III" @if ($transaction->depositor->suffix == 'III') {{ 'selected' }} @endif>III
                                </option>
                                <option value="IV" @if ($transaction->depositor->suffix == 'IV') {{ 'selected' }} @endif>IV
                                </option>
                                <option value="V" @if ($transaction->depositor->suffix == 'V') {{ 'selected' }} @endif>V
                                </option>
                                <option value="VI" @if ($transaction->depositor->suffix == 'VI') {{ 'selected' }} @endif>VI
                                </option>
                                <option value="VII" @if ($transaction->depositor->suffix == 'VII') {{ 'selected' }} @endif>
                                    VII
                                </option>
                                <option value="VIII" @if ($transaction->depositor->suffix == 'VIII') {{ 'selected' }} @endif>
                                    VIII</option>
                            </select>


                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="birth_date" value="{{ __('Birth Date') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="date" id="birth_date"
                                name="depositor[birth_date]" required value="{{ $transaction->depositor->birth_date }}"
                                min="{{ now()->subYears(17)->format('Y-m-d') }}"
                                max="{{ now()->subYears(7)->format('Y-m-d') }}" />

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="contact_number" value="{{ __('Contact Number') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="number"
                                name="depositor[contact_number]" placeholder="Enter Contact number" required
                                value="{{ $transaction->depositor->contact_number }}"
                                onKeyPress="if(this.value.length==11) return false;" />


                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="gender" value="{{ __('Gender') }}" />
                            <select name="depositor[gender]" id="" class="form-control mt-1 border-black"
                                required>
                                <option value="" disabled="disabled" selected="true">-- Sex --</option>
                                <option value="Male" @if ($transaction->depositor->gender == 'Male') {{ 'selected' }} @endif>
                                    Male</option>
                                <option value="Female" @if ($transaction->depositor->gender == 'Female') {{ 'selected' }} @endif>
                                    Female</option>

                            </select>

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="branch_loc_id" value="{{ __('Branch Location') }}" />
                            <input class="mt-1 rounded-lg uppercase bg-white form-control border-black"
                                disabled="disabled" value="{{ $transaction->branch_loc->location }}" />
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="branch_id" value="{{ __('Branch') }}" />
                            <input class="mt-1 rounded-lg uppercase bg-white form-control border-black"
                                disabled="disabled" value="{{ $transaction->branch->branch_name }}" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <x-label-required for="home_address" value="{{ __('Home Address') }}" />
                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="depositor[home_address]" placeholder="Enter Address" required
                                value="{{ $transaction->depositor->home_address }}" />
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="email_add" value="{{ __('Email') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="text"
                                name="depositor[email_add]" placeholder="Enter Email" required
                                value="{{ $transaction->depositor->email_add }}" />
                        </div>


                        {{-- guardian information --}}
                        <div class="col-lg-12 mb-4">
                            <span
                                class="text-xl text-white block font-bold p-2 uppercase rounded-lg bg-green-900">Guardian
                                Information</span>
                        </div>
                        <div class="col-lg-3">
                            <x-label-required for="g_fname" value="{{ __('Firstname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="guardian[g_fname]" placeholder="Enter Firstname" required
                                value="{{ $guardian->g_fname }}" />

                        </div>
                        <div class="col-lg-3">
                            <x-label-required for="g_mname" value="{{ __('Middlename') }}" />


                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="guardian[g_mname]" placeholder="Enter Middlename" required
                                value="{{ $guardian->g_mname }}" />

                        </div>
                        <div class="col-lg-4">
                            <x-label-required for="g_lname" value="{{ __('Lastname') }}" />
                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="guardian[g_lname]" placeholder="Enter Lastname" required
                                value="{{ $guardian->g_lname }}" />
                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label for="g_suffix" value="{{ __('Suffix') }}" />


                            <select name="guardian[g_suffix]" id="" class="form-control mt-1 border-black">
                                <option value="">suffix</option>
                                <option value="Sr" @if ($guardian->g_suffix == 'Sr') {{ 'selected' }} @endif>
                                    Sr</option>
                                <option value="Jr" @if ($guardian->g_suffix == 'Jr') {{ 'selected' }} @endif>
                                    Jr</option>
                                <option value="II" @if ($guardian->g_suffix == 'II') {{ 'selected' }} @endif>
                                    II</option>
                                <option value="III" @if ($guardian->g_suffix == 'III') {{ 'selected' }} @endif>
                                    III</option>
                                <option value="IV" @if ($guardian->g_suffix == 'IV') {{ 'selected' }} @endif>
                                    IV</option>
                                <option value="V" @if ($guardian->g_suffix == 'V') {{ 'selected' }} @endif>
                                    V</option>
                                <option value="VI" @if ($guardian->g_suffix == 'VI') {{ 'selected' }} @endif>
                                    VI</option>
                                <option value="VII" @if ($guardian->g_suffix == 'VII') {{ 'selected' }} @endif>
                                    VII</option>
                                <option value="VIII" @if ($guardian->g_suffix == 'VIII') {{ 'selected' }} @endif>
                                    VIII</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="g_birth_date" value="{{ __('Birth Date') }}" />
                            <input class="mt-1 rounded-lg form-control border-black" type="date"
                                name="guardian[g_birth_date]" required value="{{ $guardian->g_birth_date }}" />


                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="g_gender" value="{{ __('Gender') }}" />

                            <select name="guardian[g_gender]" id="" class="form-control mt-1 border-black"
                                required>
                                <option value="" disabled="disabled" selected="true">-- Sex --</option>
                                <option value="Male" @if ($guardian->g_gender == 'Male') {{ 'selected' }} @endif>
                                    Male</option>
                                <option value="Female" @if ($guardian->g_gender == 'Female') {{ 'selected' }} @endif>
                                    Female</option>

                            </select>

                            </select>
                        </div>

                        <div class="col-lg-2 mb-4">
                            <x-label-required for="g_civil_status" value="{{ __('Civil Status') }}" />

                            <select name="guardian[g_civil_status]" id="g_civil_status"
                                class="form-control mt-1 border-black ">
                                <option value="" selected="true" disabled="disabled">Civil Status*</option>
                                <option value="Single" {{ $guardian->g_civil_status == 'Single' ? 'selected' : '' }}>
                                    Single</option>
                                <option value="Married"
                                    {{ $guardian->g_civil_status == 'Married' ? 'selected' : '' }}>Married
                                </option>
                                <option value="Separated"
                                    {{ $guardian->g_civil_status == 'Separated' ? 'selected' : '' }}>Separated
                                </option>
                                <option value="Widowed"
                                    {{ $guardian->g_civil_status == 'Widowed' ? 'selected' : '' }}>Widowed
                                </option>
                            </select>

                        </div>
                        <div class="col-lg-2 mb-4">
                            <x-label-required for="g_member_or_not" value="{{ __('Member?') }}" />
                            <select name="guardian[g_member_or_not]" id=""
                                class="form-control mt-1 border-black ">
                                <option value="" selected="true" disabled="disabled">-- select --</option>
                                <option value="Yes" {{ $guardian->g_member_or_not == 'Yes' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="No" {{ $guardian->g_member_or_not == 'No' ? 'selected' : '' }}>No
                                </option>

                            </select>


                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="g_depositor_relation" value="{{ __('Relation') }}" />
                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="guardian[g_depositor_relation]" placeholder="Enter Relation" required
                                value="{{ $guardian->g_depositor_relation }}" />


                        </div>
                        <div class="col-lg-6 mb-4">
                            <x-label-required for="g_home_address" value="{{ __('Home Address') }}" />


                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="guardian[g_home_address]" placeholder="Enter Home Address" required
                                value="{{ $guardian->g_home_address }}" />


                        </div>
                        <div class="col-lg-6 mb-4">
                            <x-label-required for="g_present_address" value="{{ __('Present Address') }}" />
                            <input class="mt-1 rounded-lg form-control border-black uppercase" type="text"
                                name="guardian[g_present_address]" placeholder="Enter Present Address" required
                                value="{{ $guardian->g_present_address }}" />


                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="g_contact_num" value="{{ __('Contact Number') }}" />

                            <input class="mt-1 rounded-lg form-control border-black" type="number"
                                name="guardian[g_contact_num]" placeholder="Enter Contact Number" required
                                value="{{ $guardian->g_contact_num }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="g_email_add">Email (<span class="text-blue-500">Not
                                    Required</span>)
                            </x-label>

                            <input class="mt-1 rounded-lg form-control border-black" type="email"
                                name="guardian[g_email_add]" placeholder="Enter Email Address"
                                value="{{ $guardian->g_email_add }}" />


                        </div>

                        {{-- referral information --}}
                        <div class="col-lg-12 mb-4">
                            <span
                                class="text-xl text-white block font-bold p-2 rounded-lg bg-green-900 uppercase">Referral
                                Information</span>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="r_fname" value="{{ __('Firstname') }}" />
                            <input class="mt-1 rounded-lg bg-white form-control border-black" disabled="disabled"
                                value="{{ $transaction->referral->r_fname }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="r_mname" value="{{ __('Middlename') }}" />
                            <input class="mt-1 rounded-lg bg-white form-control border-black" disabled="disabled"
                                value="{{ $transaction->referral->r_mname }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label for="r_lname" value="{{ __('Lastname') }}" />
                            <input class="mt-1 rounded-lg bg-white form-control border-black" disabled="disabled"
                                value="{{ $transaction->referral->l_fname }}" />

                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="r_branch_id" value="{{ __('Branch') }}" />
                            <input class="mt-1 rounded-lg bg-white form-control border-black" disabled="disabled"
                                value="{{ $transaction->referral_branch->branch_name }}" />
                        </div>

                        {{-- scanned documents --}}
                        <div class="col-lg-12 mb-4">
                            <span class="text-xl text-white block font-bold p-2 rounded-lg bg-green-900 uppercase">
                                Documents</span>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="signature_img">Scanned Signature
                            </x-label-required>

                            <a href="{{ asset('storage/uploads/signature/' . $transaction->uploaded_files->signature_img) }}"
                                target="_blank">
                                <img class="mt-2 w-1/4"
                                    src="{{ asset('storage/uploads/signature/' . $transaction->uploaded_files->signature_img) }}"
                                    alt="signature"></a>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="identification_img">Scanned Valid ID
                            </x-label-required>
                            <a href="{{ asset('storage/uploads/valid_id/' . $transaction->uploaded_files->identification_img) }}"
                                target="_blank">
                                <img class="mt-2 w-1/4"
                                    src="{{ asset('storage/uploads/valid_id/' . $transaction->uploaded_files->identification_img) }}"
                                    alt="iD"></a>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="birth_cert_img">Scanned Birth Certificate
                            </x-label-required>
                            <a href="{{ asset('storage/uploads/bcertificate/' . $transaction->uploaded_files->birth_cert_img) }}"
                                target="_blank">
                                <img class=" w-1/4 mt-2"
                                    src="{{ asset('storage/uploads/bcertificate/' . $transaction->uploaded_files->birth_cert_img) }}"
                                    alt="iD"></a>
                        </div>
                        <div class="col-lg-3 mb-4">
                            <x-label-required for="birth_cert_img">Payment
                            </x-label-required>
                            <a href="{{ asset('storage/uploads/receipt/' . $transaction->uploaded_files->receipt_img) }}"
                                target="_blank">
                                <img class=" w-1/4 mt-2"
                                    src="{{ asset('storage/uploads/receipt/' . $transaction->uploaded_files->receipt_img) }}"
                                    alt="iD"></a>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="bg-green-600 hover:bg-green-800 rounded py-2 px-5 text-white"
                                type="submit" id="">
                                Update Application
                            </button>
                        </div>
                    </div>
                </form>
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
                    <button type="button" style="font-size:2em; color:white" class="close"
                        data-bs-dismiss="modal">
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
                        <button type="submit" class="btn bg-primary text-white" id="btnAddProd">
                            {{ auth()->user()->user_type_id == '2' ? 'Verify' : 'Approve' }}</< /button>
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

    @push('style')
        <style>

        </style>
    @endpush
    @push('script')
        <script>
            $(document).ready(function() {


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
