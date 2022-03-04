<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;
use Auth;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function view_finance_report(){
        return view('admin.reports.finance-report');
    }

    public function print_finance_report(){
        $user = Auth::user()->organization_id;
        $date_from = Request::get('date_from');
        $date_to = Request::get('date_to');

        $orgincomes = \App\Org_income::where('org_id',$user)
            ->where('date','>=',$date_from)
            ->where('date','<=',$date_to)
            ->where('status',1)
            ->orderBy('date','DESC')
            ->get();

        $orgexpenses = \App\Org_expense::where('org_id',$user)
            ->where('date','>=',$date_from)
            ->where('date','<=',$date_to)
            ->where('status',1)
            ->orderBy('date','DESC')
            ->get();


        // $orgincomes = \App\Org_income::where('date','>=',$date_from)
        //     ->where('date','<=',$date_to)
        //     ->orderBy('date','DESC')
        //     ->get();

        // $orgexpenses = \App\Org_expense::where('date','>=',$date_from)
        //     ->where('date','<=',$date_to)
        //     ->orderBy('date','DESC')
        //     ->get();

        return View('admin.pdf.finance', compact('orgincomes','orgexpenses','user','date_to','date_from'));
    }
}
