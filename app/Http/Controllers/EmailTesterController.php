<?php

namespace App\Http\Controllers;

use App\Models\DepositorModel;
use App\Models\OfficerModel;
use App\Notifications\OnlineApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmailTesterController extends Controller
{
    public function for_testing_email()
    {

        $receipent =  DepositorModel::find(1);
        $officer = OfficerModel::where('uid', 2)->first();
        //sending email notification
        $content = [
            'sentence_1' => 'Please be informed that your application is now approved. You are now an official <strong>Youth Savers Club</strong> member.
          <br><br><br>Approved By : <strong>' .
                $officer->fname . ' ' . $officer->mname . ' ' . $officer->lname . '</strong> <br> Remarks : 
            <strong>' . 'hello' . '</strong> <br> Approval Date : <strong>' . now() . '</strong>',
            'sentence_2' => 'If you have questions or other inquiries, you can call or text our Youth Savers Club coordinators
           indicated below or send us message thru our official contact no.',
            'phone_no' => '09**********',
            'level' => 'Online Services'
        ];


        Notification::send($receipent, new OnlineApplicationNotification($content));
    }
}
