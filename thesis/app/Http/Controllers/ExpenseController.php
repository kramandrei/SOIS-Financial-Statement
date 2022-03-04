<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;

class ExpenseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $data = \App\Expense::query()->select(['id','name'])->where('isActive',0)->get();
        if (Request::ajax()) {
            return Datatables::of($data)
            ->addColumn('action', function($data){
                $btn = 
                '<center>
                    <span data-toggle="tooltip" data-placement="top" title="Edit Expense Entry">
                        <a data-bs-target="#edit'.$data->id.'" data-bs-toggle="modal" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span data-toggle="tooltip" data-placement="top" title="Delete Expense Entry">
                        <a data-bs-target="#delete'.$data->id.'" data-bs-toggle="modal" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                        </a>
                    </span>
                </center>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.expenses.index',compact('data'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'              =>  'required|unique:expenses',
        ],
        [
            'name.required'     =>  'Expense Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Expense::create(Request::all());
        Alert::success('Success', 'Expense Entry Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $expense = \App\Expense::find($id);
        $validator = Validator::make(Request::all(), [
            'name'              =>  "required|unique:incomes,name,$expense->id,id",
        ],
        [
            'name.required'     =>  'Expense Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $expense->update(Request::all());
        Alert::success('Success', 'Expense Entry Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $expense = \App\Expense::find($id);
        $expense->update([
            'isActive'      =>      '1',
        ]);

        Alert::success('Success', 'Expense Entry Deleted Successfully');
        return redirect()->back();
    }
}
