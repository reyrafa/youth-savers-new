<?php

namespace App\Http\Controllers;

use App\Models\DepositorModel;
use App\Notifications\OnlineApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmailTesterController extends Controller
{
    public function for_testing_email(){
       
        $receipent =  DepositorModel::find(2);
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
    }
}
