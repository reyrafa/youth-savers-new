<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Youth Savers Club Application</title>

</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .row {
        display: flex;
    }

    .column {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
    }

    #orologo {
        width: 11rem;
        margin-bottom: 0.75rem;
    }

    .justify-center {
        justify-content: center;
    }

    .text-center {
        text-align: center;
    }


    table {
        width: 100%;
        margin-top: 5rem;

        border-spacing: 0;
        border: 1px solid black;

    }

    tr,
    td {
        border-spacing: 0;
    }


    .uppercase {
        text-transform: uppercase;
    }

    .border-top {
        border-top: 1px solid black;
    }

    .border-bottom {
        border-bottom: 1px solid black;
    }

    .border-left {
        border-left: 1px solid black;
    }

    .border {
        border: 1px solid black;
    }

    .border-right {
        border-right: 1px solid black;
    }

    .border-right-name {
        position: relative;
        padding: 5px;
    }

    .border-right-name::before {
        content: "";
        position: absolute;
        left: 0;
        top: 2.5%;
        height: 15px;
        width: 4px;
        background-color: black;
        transform: translateY(-50%);
    }

    tr.header {
        background-color: #b8b8b8;


    }

    td {
        padding: 2px;
    }

    .p-4 {
        padding: 1rem;
    }

    .font-bold {
        font-weight: 700;
    }

    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .text-center {
        text-align: center;
    }

    .text-xl {
        font-size: 1.25rem;
        line-height: 1.75rem;
    }

    .ml-4 {
        margin-left: 2rem;
    }

    .colspan-1-5 {
        grid-column: span 1.5;
    }

    .hidden {
        display: none;
    }

    .text-white {
        color: white;
    }

    .text-base {
        font-size: 1rem;
        line-height: 1.5rem;
    }

    .page-break {
        page-break-after: always;
    }

    .imgDoc {

        width: 15rem;
        height: 20rem;
    }

    .imgDocSig {

        width: 15rem;
        height: 5rem;
    }

    .imgDocGcash {

        width: 50px;
        height: 20px;
    }

    .imgDocBirth {
        width: 36rem;
        height: 60rem;
    }

    .underline-bottom {
        border-bottom: 1px solid black;
        padding-top: 3px;
    }

    .text-xs {
        font-size: 0.75rem;
        line-height: 1rem;
    }

    .font-serif {
        font-family: serif;
    }
</style>

<body>
    @php
        $isJPEG = true; // Set this variable based on your logic
    @endphp
    <div class="row justify-center text-center">

        <img src="data:image/png;base64, {{ $image }}" alt="oiclogo" id="orologo">
        <div>ORO INTEGRATED COOPERATIVE</div>
        <div>{{ date('M d Y', strtotime($transaction->created_at)) }}</div>
        <div>{{ $transaction->branch->branch_name }}</div>

    </div>

    <table class="">
        <tbody>
            <tr class="header uppercase">
                <td colspan="7" class="border-right p-4 font-bold">A. Personal information</td>

            </tr>
            <tr class="text-xs text-center uppercase">

                <td colspan="1" class="border-top border-right">(last name)</td>
                <td colspan="3" class="border-top border-right">(first name)</td>
                <td colspan="2" class="border-top border-right">(middle name)</td>
                <td class="border-top">(suffix)</td>
            </tr>
            <tr class="text-sm font-bold text-center uppercase">
                <td class="border-right" colspan="1">{{ $transaction->depositor->lname }}</td>
                <td class="border-right" colspan="3">{{ $transaction->depositor->fname }}</td>
                <td class="border-right" colspan="2">{{ $transaction->depositor->mname }}</td>
                <td class="">{{ $transaction->depositor->suffix }}</td>

            </tr>
            <tr class="text-xs text-center uppercase">

                <td colspan="1" class="border-top border-right">Age</td>
                <td colspan="1" class="border-top border-right">date of birth (yyyy/mm/dd)</td>
                <td colspan="1" class="border-top border-right">sex</td>
                <td colspan="4" class="border-top">Contact no</td>

            </tr>
            <tr class="text-center text-sm font-bold uppercase">
                @php
                    $birthdate = $transaction->depositor->birth_date;
                    $today = new DateTime();
                    $diff = $today->diff(new DateTime($birthdate));
                    $age = $diff->y;
                @endphp
                <td colspan="1" class="border-right">{{ $age }}</td>
                <td colspan="1" class="border-right">{{ $transaction->depositor->birth_date }}</td>
                <td colspan="1" class="border-right">{{ $transaction->depositor->gender }}</td>
                <td colspan="4" class="">{{ $transaction->depositor->contact_number }}</td>
            </tr>
            <tr class="text-xs text-center uppercase">

                <td colspan="3" class="border-top border-right">email</td>
                <td colspan="2" class="border-top border-right">branch location</td>
                <td colspan="2" class="border-top">branch</td>


            </tr>
            <tr class="text-sm font-bold text-center">
                <td class="border-right" colspan="3">{{ $transaction->depositor->email_add }}</td>
                <td class="border-right" colspan="2">{{ $transaction->branch_loc->location }}</td>
                <td class=" uppercase" colspan="2">{{ $transaction->branch->branch_name }}</td>


            </tr>
            <tr class="text-xs text-center uppercase">

                <td colspan="7" class="border-top">home address</td>



            </tr>
            <tr class="text-sm font-bold text-center uppercase">
                <td class="" colspan="7">{{ $transaction->depositor->home_address }}</td>


            </tr>

            <tr class="header uppercase">
                <td colspan="7" class="border-right border-top p-4 font-bold">B. guardian information</td>

            </tr>

            <tr class="text-xs text-center uppercase">

                <td colspan="1" class="border-top border-right">(last name)</td>
                <td colspan="3" class="border-top border-right">(first name)</td>
                <td colspan="2" class="border-top border-right">(middle name)</td>
                <td class="border-top">(suffix)</td>
            </tr>
            <tr class="text-sm font-bold text-center uppercase">
                <td class="border-right" colspan="1">{{ $guardian->g_lname }}</td>
                <td class="border-right" colspan="3">{{ $guardian->g_fname }}</td>
                <td class="border-right" colspan="2">{{ $guardian->g_mname }}</td>
                <td class="">{{ $guardian->g_suffix }}</td>

            </tr>

            <tr class="text-xs text-center uppercase">
                <td colspan="1" class="border-top border-right">Relation</td>
                <td colspan="1" class="border-top border-right">date of birth (yyyy/mm/dd)</td>
                <td colspan="1" class="border-top border-right">sex</td>
                <td colspan="1" class="border-top border-right">member?</td>
                <td colspan="3" class="border-top">civil status</td>
            </tr>

            <tr class="text-center text-sm font-bold uppercase">
                <td colspan="1" class="border-right">{{ $guardian->g_depositor_relation }}</td>
                <td colspan="1" class="border-right">{{ $guardian->g_birth_date }}</td>
                <td colspan="1" class="border-right">{{ $guardian->g_gender }}</td>
                <td colspan="1" class="border-right">{{ $guardian->g_member_or_not }}</td>
                <td colspan="3" class="">{{ $guardian->g_civil_status }}</td>
            </tr>

            <tr class="text-xs text-center uppercase">
                <td colspan="4" class="border-top border-right">email</td>
                <td colspan="3" class="border-top">Contact no</td>
            </tr>
            <tr class="text-sm font-bold text-center">
                <td class="border-right" colspan="4">{{ $guardian->g_email_add }}</td>
                <td colspan="3" class="">{{ $guardian->g_contact_num }}</td>
            </tr>

            <tr class="text-xs text-center uppercase">
                <td colspan="7" class="border-top">home address</td>

            </tr>
            <tr class="text-sm font-bold text-center uppercase">
                <td class="" colspan="7">{{ $guardian->g_home_address }}</td>

            </tr>

            <tr class="text-xs text-center uppercase">

                <td colspan="7" class="border-top">present address</td>
            </tr>
            <tr class="text-sm font-bold text-center uppercase">

                <td colspan="7" class="">{{ $guardian->g_present_address }}</td>
            </tr>

            <tr class="header uppercase">
                <td colspan="7" class="border-right p-4 font-bold border-top">B. referral information</td>

            </tr>

            <tr class="text-xs text-center uppercase">

                <td colspan="1" class="border-top border-right">(last name)</td>
                <td colspan="3" class="border-top border-right">(first name)</td>
                <td colspan="2" class="border-top border-right">(middle name)</td>
                <td class="border-top">(suffix)</td>
            </tr>
            <tr class="text-sm font-bold text-center uppercase">
                <td class="border-right" colspan="1">{{ $transaction->referral->r_lname }}</td>
                <td class="border-right" colspan="3">{{ $transaction->referral->r_fname }}</td>
                <td class="border-right" colspan="2">{{ $transaction->referral->r_mname }}</td>
                <td class="text-white">hello</td>

            </tr>

            <tr class="header uppercase">
                <td colspan="7" class="border-right p-4 font-bold"></td>

            </tr>
            <tr class="text-sm font-bold text-center uppercase font-serif">
                <td class="" colspan="7"><span
                        class="underline-bottom">{{ $transaction->depositor->lname }},
                        {{ $transaction->depositor->fname }} {{ $transaction->depositor->mname }}</span></td>

            </tr>
            <tr class=" text-xs text-center uppercase font-serif">
                <td class="" colspan="7">Signature over printed name
                </td>


            </tr>
        </tbody>

    </table>

    <div class="page-break"></div>


    <div class="">
        <div style="margin-top:5.25rem">
            <img src="data:image/<?php echo $isJPEG ? 'jpeg' : 'png'; ?>;base64, {{ $identification }}" alt="" class=""
                style="width:15rem; height:23rem">
            <img src="data:image/<?php echo $isJPEG ? 'jpeg' : 'png'; ?>;base64, {{ $reciept }}" alt="" class=""
                style="width:20rem; height:30rem; margin-left: 4.5rem">
            <img src="data:image/<?php echo $isJPEG ? 'jpeg' : 'png'; ?>;base64, {{ $signature }}" alt="" class=""
                style="width:13rem; height:8rem">
            <img src="data:image/<?php echo $isJPEG ? 'jpeg' : 'png'; ?>;base64, {{ $signature }}" alt="" class=""
                style="width:13rem; height:8rem">
            <img src="data:image/<?php echo $isJPEG ? 'jpeg' : 'png'; ?>;base64, {{ $signature }}" alt="" class=""
                style="width:13rem; height:8rem">
        </div>


        <div class="page-break"></div>

        <img src="data:image/<?php echo $isJPEG ? 'jpeg' : 'png'; ?>;base64, {{ $birthcert }}" alt="" style="width:100%; height:100%">


    </div>
</body>

</html>
