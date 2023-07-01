<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlineApplicationRequest;
use App\Models\DepositorModel;
use App\Models\GuardianModel;
use App\Models\OfficerModel;
use App\Models\RefferalModel;
use App\Models\TransactionModel;
use App\Models\UploadedFileModel;
use App\Notifications\OnlineApplicationNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;

class OnlineRegistrationController extends Controller
{

    public function index()
    {
        $level = auth()->user()->user_type_id;
        $searchItem = request()->search;


        if ($level == 2) {
            $transactions = TransactionModel::where('level_id', $level - 1)
                ->where('status_id', '1')
                ->whereHas('depositor', function ($query) use ($searchItem) {
                    $query->where('fullname', 'LIKE', '%' . str_replace(' ', '%', $searchItem) . '%');
                })
                ->paginate(5);

            $transactions->load(['depositor', 'depositor.branch', 'status', 'level']);
        } else if ($level == 3) {
            $officer = OfficerModel::where('uid', auth()->user()->id)->first();
            $officer_branch = $officer->branch_id;
            $depositorIds = DepositorModel::where('branch_id', 4)->pluck('id')->toArray();


            $transactions = TransactionModel::where('level_id', $level - 1)
                ->where('status_id', '2')
                ->whereHas('depositor', function ($query) use ($officer_branch) {
                    $query->where('branch_id', $officer_branch);
                })
                ->whereHas('depositor', function ($query) use ($searchItem) {
                    $query->where('fullname', 'LIKE', '%' . str_replace(' ', '%', $searchItem) . '%');
                })
                ->paginate(5);

            //->whereHas('depositor', function ($query) use ($officer_branch) {
            //    $query->where('branch_id', $officer_branch);
            //})


            $transactions->load(['depositor', 'depositor.branch', 'status', 'level']);
        } else if ($level == 4) {
            $transactions = TransactionModel::whereHas('depositor', function ($query) use ($searchItem) {
                $query->where('fullname', 'LIKE', '%' . str_replace(' ', '%', $searchItem) . '%');
            })
                ->paginate(5);
            $transactions->load(['depositor:id,fname,mname,lname,branch_id,contact_number', 'depositor.branch', 'status', 'level']);
        }

        return view('pages.transaction.ols.index', compact('transactions'));
    }



    public function store(OnlineApplicationRequest $request)
    {

        $validatedData = $request->validated();
        $fullname = $request->input('depositor.fname') . " " . $request->input('depositor.mname') . " " . $request->input('depositor.lname');
        $refferal = RefferalModel::create($validatedData['referral']);
        $depositor = DepositorModel::create($validatedData['depositor']);
        $guardian = GuardianModel::create($validatedData['guardian']);
        $file_upload = UploadedFileModel::create($validatedData['uploaded_file']);

        $depositor->fullname = $fullname;
        $depositor->referral_id = $refferal->id;
        $depositor->uploaded_file_id = $file_upload->id;
        $depositor->save();

        $guardian->depositor_id = $depositor->id;
        $guardian->save();

        $transaction = new TransactionModel();
        $transaction->depositor_id = $depositor->id;
        $transaction->level_id = '1';
        $transaction->status_id = '1';
        $transaction->save();

        //   $transaction->searchable();
        $receipent =  DepositorModel::find($depositor->id);
        //sending email notification
        $content = [
            'sentence_1' => 'Please be informed that your application is now on process for verification by our OLS officer. 
           We will notify you if your application is verified.',
            'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
            'phone_no' => '09**********',
            'level' => 'Online Services'
        ];

        Notification::send($receipent, new OnlineApplicationNotification($content));

        return back()->with('success', 'Your Online Application is on the process. Please Check your Email for updates. Thank you!');
    }


    public function show($id)
    {
        $transaction = TransactionModel::findOrFail($id);
        //  $transaction->load('depositor', 'depositor.branch', 'depositor.branch_location');
        $guardian = GuardianModel::where('depositor_id', $transaction->depositor->id)->first();

        return view('pages.transaction.ols.show-depositor', compact('transaction', 'guardian', 'id'));
    }


    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $depositor = DepositorModel::findOrFail($id);
        $depositor->fname = $request->depositor['fname'];
        $depositor->mname = $request->depositor['mname'];
        $depositor->lname = $request->depositor['lname'];
        $depositor->suffix = $request->depositor['suffix'];
        $depositor->birth_date = $request->depositor['birth_date'];
        $depositor->contact_number = $request->depositor['contact_number'];
        $depositor->gender = $request->depositor['gender'];
        $depositor->home_address = $request->depositor['home_address'];
        $depositor->email_add = $request->depositor['email_add'];
        $depositor->save();

        $guardian = GuardianModel::where('depositor_id', $id)->first();
        $guardian->g_fname = $request->guardian['g_fname'];
        $guardian->g_mname = $request->guardian['g_mname'];
        $guardian->g_lname = $request->guardian['g_lname'];
        $guardian->g_suffix = $request->guardian['g_suffix'];
        $guardian->g_birth_date = $request->guardian['g_birth_date'];
        $guardian->g_gender = $request->guardian['g_gender'];
        $guardian->g_civil_status = $request->guardian['g_civil_status'];
        $guardian->g_member_or_not = $request->guardian['g_member_or_not'];
        $guardian->g_depositor_relation = $request->guardian['g_depositor_relation'];
        $guardian->g_home_address = $request->guardian['g_home_address'];
        $guardian->g_present_address = $request->guardian['g_present_address'];
        $guardian->g_contact_num = $request->guardian['g_contact_num'];
        $guardian->g_email_add = $request->guardian['g_email_add'];
        $guardian->save();

        $transaction = TransactionModel::where('depositor_id', $id)->first();
        // $transaction->searchable();

        $officer = OfficerModel::where('uid', auth()->user()->id)->first();
        //sending email notification
        $content = [
            'sentence_1' => 'Please be informed that your application has been <strong>UPDATED</strong> by our officer. 
           If this is a mistake. Please call or text the contact numbers provided below.<br><br><br>Updated By : <strong>' .
                strtoupper($officer->fname) . ' ' . strtoupper($officer->mname) . ' ' . strtoupper($officer->lname) . '</strong> <br> Time of update : 
            <strong>' . now() . '</strong>',
            'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
            'phone_no' => '09**********',
            'level' => 'Online Services'
        ];

        Notification::send($depositor, new OnlineApplicationNotification($content));
        return redirect()->route('ols.transaction.index')->with('success', 'Application Updated Successfully.');
    }

    public function print($id)
    {
        $transaction = TransactionModel::findOrFail($id);
        $guardian = GuardianModel::where('depositor_id', $transaction->depositor->id)->first();

        $image = base64_encode(file_get_contents(public_path('/img/oicLogo.png')));

        $signature = base64_encode(Storage::get('public/uploads/signature/' . $transaction->uploaded_files->signature_img));
        $identification = base64_encode(Storage::get('public/uploads/valid_id/' . $transaction->uploaded_files->identification_img));

        $birthcert = base64_encode(Storage::get('public/uploads/bcertificate/' . $transaction->uploaded_files->birth_cert_img));


        $reciept = base64_encode(Storage::get('public/uploads/receipt/' . $transaction->uploaded_files->receipt_img));

        $pdf = Pdf::loadView('pages.transaction.ols.print', [
            'transaction' => $transaction, 'identification' => $identification,
            'birthcert' => $birthcert, 'reciept' => $reciept, 'signature' => $signature,
            'image' => $image, 'guardian' =>  $guardian
        ]);
        return $pdf->stream('youthSaversClub.pdf');
    }

    public function verify(Request $req, $id)
    {
        $transaction = TransactionModel::findOrFail($id);
        $officer = OfficerModel::where('uid', auth()->user()->id)->first();
        (auth()->user()->user_type_id == '2') ? $transaction->increment('level_id') : $transaction->level_id = 2;
        $transaction->increment('status_id');

        if (auth()->user()->user_type_id == '2 ') {
            $transaction->verified_by = $officer->id;
            $transaction->verified_at = now();
        } else if (auth()->user()->user_type_id == '3') {
            $transaction->approved_by = $officer->id;
            $transaction->approved_at = now();
        }

        $transaction->remarks = $req->remarks;
        $transaction->save();
        // $transaction->searchable();
        $receipent =  DepositorModel::find($transaction->depositor_id);

        //sending email notification
        $content = (auth()->user()->user_type_id == '2') ? [
            'sentence_1' => 'Please be informed that your application is <strong>VERIFIED</strong> by our OLS officer and
             waiting to be approve by our new accounts officer. 
           We will notify you if your application is totaly approved.<br><br><br>Verified By : <strong>' .
                strtoupper($officer->fname) . ' ' . strtoupper($officer->mname) . ' ' . strtoupper($officer->lname) . '</strong> <br> Remarks : 
            <strong>' . strtoupper($transaction->remarks) . '</strong> <br> Verification Date : <strong>' . now() . '</strong>',
            'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
            'phone_no' => '09**********',
            'level' => 'Online Services'
        ] :
            [
                'sentence_1' => 'Please be informed that your application is now <strong>APPROVED</strong>. You are now an official <strong>YOUTH SAVERS CLUB</strong> member.
          <br><br><br>Approved By : <strong>' .
                    strtoupper($officer->fname) . ' ' . strtoupper($officer->mname) . ' ' . strtoupper($officer->lname) . '</strong> <br> Remarks : 
            <strong>' . strtoupper($transaction->remarks) . '</strong> <br> Approval Date : <strong>' . now() . '</strong>',
                'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
                'phone_no' => '09**********',
                'level' => 'Online Services'
            ];

        Notification::send($receipent, new OnlineApplicationNotification($content));

        $message = (auth()->user()->user_type_id == '2') ? 'Application is verified successfully' : 'Application is approved successfully';
        return redirect()->route('ols.transaction.index')->with('success', $message);
    }

    public function disapproved_application(Request $req, $id)
    {
        $transaction = TransactionModel::findOrFail($id);
        $officer = OfficerModel::where('uid', auth()->user()->id)->first();

        $transaction->status_id = '4';
        $transaction->disapproved_by = $officer->id;
        $transaction->disapproved_at = now();
        $transaction->remarks = $req->remarks;
        $transaction->save();
        // $transaction->searchable();
        $receipent =  DepositorModel::find($transaction->depositor_id);

        //sending email notification
        $content = [
            'sentence_1' => 'Please be informed that your application is <strong>REJECTED</strong> by our OLS officer because of the following reasons:
                <br><br><br>Rejected By : <strong>' .
                strtoupper($officer->fname) . ' ' . strtoupper($officer->mname) . ' ' . strtoupper($officer->lname) . '</strong> <br> Remarks : 
            <strong>' . strtoupper($transaction->remarks) . '</strong>',
            'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
            'phone_no' => '09**********',
            'level' => 'Online Services'
        ];

        Notification::send($receipent, new OnlineApplicationNotification($content));
        return redirect()->route('ols.transaction.index')->with('success', 'Application is rejected successfully');
    }

    public function denied()
    {
        $searchItem = request()->search;
        $denieds = TransactionModel::orderBy('depositor_id', 'asc')
            ->where('status_id', 4)
            ->whereHas('depositor', function ($query) use ($searchItem) {
                $query->where('fullname', 'LIKE', '%' . str_replace(' ', '%', $searchItem) . '%');
            })
            ->paginate(5);

       // $denieds->appends(['search' => request()->input('search')]);

        $denieds->load(['depositor:id,fname,mname,lname,branch_id,contact_number', 'depositor.branch:id,branch_name', 'status', 'level']);
        return view('pages.youth-report.denied', compact('denieds'));
    }

    public function reset(Request $req, $id)
    {

        $transaction = TransactionModel::findOrFail($id);
        $transaction->level_id = 1;
        $transaction->status_id = 1;
        $transaction->save();
        return back()->with('success', 'Application Reset Successfully!');
    }
}
