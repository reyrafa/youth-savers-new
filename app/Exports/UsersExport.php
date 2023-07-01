<?php

namespace App\Exports;

use App\Models\DepositorModel;
use App\Models\TransactionModel;
use App\Models\User;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;


class UsersExport implements FromView
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }
   

    public function view() : View{

        return view('export.report', ['transactions' => $this->transactions]);
    }
   
}
