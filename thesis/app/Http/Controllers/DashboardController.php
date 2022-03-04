<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){

        return view('admin.dashboard');
    }

}
