<?php

namespace App\Exports;

use App\Models\TransactionModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class YSCReportExport implements FromView, ShouldAutoSize, WithStyles, ShouldQueue
{
    protected $transactions;
    protected $status;

    public function __construct($transactions, $status)
    {
        $this->transactions = $transactions;
        $this->status = $status;
    }

    public function view(): View
    {

        return view('export.report', ['transactions' => $this->transactions, 'status' => $this->status]);
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 18]],
            2    => ['font' => ['bold' => true, 'size' => 18]],
            4 => ['font' => ['bold' => true]]
        ];
    }
}
