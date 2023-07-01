<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\YSCReportExport;
use App\Models\GuardianModel;
use App\Models\TransactionModel;
use App\Models\TransactionStatusModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class YouthSaversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.youth-report.index');
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function generate(Request $req)
    {
        $stat = $req->reportType;
        $collection = collect();

        if ($stat != 4) {
            TransactionModel::where('status_id', $stat)
                ->with(['depositor', 'depositor.branch', 'status', 'level'])
                ->chunk(1000, function ($results) use ($collection) {
                    $collection->push($results);
                });
            $transactions = $collection->flatten();
            $status = TransactionStatusModel::findOrFail($stat);
        } else {
            $transactions = TransactionModel::all();

            $status = 'ALL REPORT';
        }
        FacadesExcel::store(new YSCReportExport($transactions, $status), 'public/youth-savers-list.xlsx');
      
        
        $downloadLink = asset('storage/youth-savers-list.xlsx');

        // (new YSCReportExport($transactions, $status))->queue('youth-savers-list.xlsx');
        //FacadesSession::flash('success', 'Excel file downloaded successfully.');
        return view('export.download', compact('downloadLink'))->with('success', 'Export Starting');
    }
}
