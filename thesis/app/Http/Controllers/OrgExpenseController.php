<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Auth;
Use Alert;

class OrgExpenseController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->role_id == 1){
            $data = \App\Org_expense::query()->select(['id','date','org_id','expense_id','amount','createdBy','approvedBy','status'])
                ->get();
        }elseif(Auth::user()->role_id == 7 || Auth::user()->role_id == 9){
             $data = \App\Org_expense::query()->select(['id','date','org_id','expense_id','amount','createdBy','approvedBy','status'])
                ->where('org_id',Auth::user()->organization_id)
                ->get();
        }
       
        if (Request::ajax()) {
            return Datatables::of($data)
            ->editColumn('date', function($data){
                return Carbon::parse($data->date)->toFormattedDateString();
            })
            ->editColumn('org_id', function($data){
                return $data->organization->organization_acronym;
            })
            ->editColumn('expense_id', function($data){
                return $data->expense->name;
            })
            ->editColumn('amount', function($data){
                return number_format($data->amount,2);
            })
            ->editColumn('createdBy', function($data){
                return $data->createdUser->fullname;
            })
            ->editColumn('status', function($data){
                if($data->status == 0){
                    $s = 'OPEN';
                }else{
                    $s = 'APPROVED BY '.$data->approvedUser->fullname;
                }
                return $s;
            })
            ->addColumn('action', function($data){
                if($data->status == 0){
                    $btn = 
                    '<center>
                        <span data-toggle="tooltip" data-placement="top" title="Edit Organization Expense Entry">
                            <a href="'.action('OrgExpenseController@edit',$data->id).'" class="btn btn-success btn-sm">
                            <i class="fa fa-edit"></i>
                            </a>
                        </span>
                        <span data-toggle="tooltip" data-placement="top" title="Delete Organization Expense Entry">
                            <a data-bs-target="#delete'.$data->id.'" data-bs-toggle="modal" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                            </a>
                        </span>';
                    if(Auth::user()->role_id == 9){
                        $btn .=
                            '<span data-toggle="tooltip" data-placement="top" title="Approve Organization Expense Entry">
                                    <a data-bs-target="#approve'.$data->id.'" data-bs-toggle="modal" class="btn btn-info btn-sm">
                                <i class="fa fa-thumbs-up"></i>
                                </a>
                            </span>';
                    }
                    
                    $btn .='</center>';
                }else{
                    $btn = '<center>LOCKED</center>';
                }
                

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.org-expenses.index',compact('data'));
    }

    public function create(){
        $expenses = \App\Expense::where('isActive',0)->orderBy('name')->get()->pluck('name','id');
        return view('admin.org-expenses.create',compact('expenses'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'date'              =>  'required',
            'receipt'           =>  'required|mimes:jpg,jpeg,png,gif',
            'expense_id'        =>  'required',
            'amount'            =>  'required',
            'invoice_or'        =>  'required',
            'description'       =>  'required',
        ],
        [
            'date.required'         =>  'Date Required',
            'receipt.required'      =>  'Please Upload Receipt',
            'expense_id.required'   =>  'Please Select Expense Category',
            'amount.required'       =>  'Amount Required',
            'invoice_or.required'   =>  'Invoice / OR Required',
            'description.required'  =>  'Description Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = Request::except('receipt');
        $file = Request::file('receipt');

        if($file != NULL){
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(50).'.'.$extension;
            $file->move(public_path().'/receipts',$fileName);
        }

        $data = Arr::add($data,'receipt',$fileName);
        $data = Arr::add($data,'org_id',Auth::user()->organization_id);
        $data = Arr::add($data,'createdBy',Auth::user()->id);
        \App\Org_expense::create($data);

        Alert::success('Success', 'Organizational Expense Created Successfully');
        return redirect()->back();
    }

    public function edit($id){
        $orgexpense = \App\Org_expense::find($id);
        if(Auth::user()->id == $orgexpense->createdBy){
            $expenses = \App\Expense::where('isActive',0)->orderBy('name')->get()->pluck('name','id');
            return view('admin.org-expenses.edit',compact('expenses','orgexpense'));
        }else{
            Alert::error('Warning', 'You are not allowed to edit');
            return redirect()->back();
        }
    }

    public function update($id){
        $orgexpense = \App\Org_expense::find($id);
        $validator = Validator::make(Request::all(), [
            'date'              =>  'required',
            //'receipt'           =>  'required|mimes:jpg,jpeg,png,gif',
            'expense_id'        =>  'required',
            'amount'            =>  'required',
            'invoice_or'        =>  'required',
            'description'       =>  'required',
        ],
        [
            'date.required'         =>  'Date Required',
           // 'receipt.required'      =>  'Please Upload Receipt',
            'expense_id.required'   =>  'Please Select Expense Category',
            'amount.required'       =>  'Amount Required',
            'invoice_or.required'   =>  'Invoice / OR Required',
            'description.required'  =>  'Description Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = Request::except('receipt');
        $file = Request::file('receipt');

        if($file != NULL){
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(50).'.'.$extension;
            $file->move(public_path().'/receipts',$fileName);
        }else{
            $fileName = $orgexpense->receipt;
        }

        $data = Arr::add($data,'receipt',$fileName);
        $orgexpense->update($data);

        Alert::success('Success', 'Organizational Expense Updated Successfully');
        return redirect()->back();

    }

    public function delete($id){
        $orgexpense = \App\Org_expense::find($id);
        if(Auth::user()->id == $orgexpense->createdBy){
            $orgexpense->delete();
            Alert::success('Success', 'Organizational Expense Deleted Successfully');
            return redirect()->back();
        }else{
            Alert::error('Warning', 'You are not allowed to delete');
            return redirect()->back();
        }
        
    }

    public function approved($id){
        $org_expense = \App\Org_expense::find($id);
        $org_expense->update([
            'isApproved'        =>      1,
            'approvedBy'        =>      Auth::user()->id,
            'status'            =>      1,
        ]);

        Alert::success('Success', 'Organizational Expense Approved Successfully');
        return redirect()->back();
    }
}
