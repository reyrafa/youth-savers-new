<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlineApplicationRequest;
use App\Models\DepositorModel;
use App\Models\GuardianModel;
use App\Models\RefferalModel;
use App\Models\TransactionModel;
use App\Models\UploadedFileModel;
use App\Notifications\OnlineApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request as FacadesRequest;

class OnlineRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * TO DO 
     * STORE THE APPLICATION 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OnlineApplicationRequest $request)
    {
  
        $validatedData = $request->validated();

        $refferal = RefferalModel::create($validatedData['referral']);
        $depositor = DepositorModel::create($validatedData['depositor']);
        $guardian = GuardianModel::create($validatedData['guardian']);
        $file_upload = UploadedFileModel::create($validatedData['uploaded_file']);
        
        
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

        $receipent =  DepositorModel::find($depositor->id);
         //sending email notification
         $content =[
            'sentence_1' => 'Please be informed that your application is now on process for verification by our OLS officer. 
           We will notify you if your application is verified.' ,
           'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
           'phone_no' => '09**********',
           'level' => 'Online Services'
        ];

    Notification::send($receipent, new OnlineApplicationNotification($content));
        
        return back()->with('success', 'Your Online Application is on the process. Please Check your Email for updates. Thank you!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
