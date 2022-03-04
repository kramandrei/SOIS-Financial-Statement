<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;

class IncomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $data = \App\Income::query()->select(['id','name','user_id'])->where('isActive',0)->get();
        if (Request::ajax()) {
            return Datatables::of($data)
            ->addColumn('action', function($data){
                $btn = 
                '<center>
                    <span data-toggle="tooltip" data-placement="top" title="Edit Income Entry">
                        <a data-bs-target="#edit'.$data->id.'" data-bs-toggle="modal" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span data-toggle="tooltip" data-placement="top" title="Delete Income Entry">
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
        return view('admin.incomes.index',compact('data'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'              =>  'required|unique:incomes',
        ],
        [
            'name.required'     =>  'Income Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Income::create(Request::all());
        Alert::success('Success', 'Income Entry Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $income = \App\Income::find($id);
        $validator = Validator::make(Request::all(), [
            'name'              =>  "required|unique:incomes,name,$income->id,id",
        ],
        [
            'name.required'     =>  'Income Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $income->update(Request::all());
        Alert::success('Success', 'Income Entry Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $income = \App\Income::find($id);
        $income->update([
            'isActive'      =>      '1',
        ]);

        Alert::success('Success', 'Income Entry Deleted Successfully');
        return redirect()->back();
    }
}
