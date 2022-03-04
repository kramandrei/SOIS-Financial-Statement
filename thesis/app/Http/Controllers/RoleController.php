<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;


class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $data = \App\Role::query()->select(['role_id','role'])->get();
        if (Request::ajax()) {
            return Datatables::of($data)
            ->addColumn('action', function($data){
                $btn = 
                '<center>
                    <span data-toggle="tooltip" data-placement="top" title="Edit Role Entry">
                        <a data-bs-target="#edit'.$data->role_id.'" data-bs-toggle="modal" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                    </span>
                </center>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.roles.index',compact('data'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'role'              =>  'required|unique:roles',
        ],
        [
            'role.required'     =>  'User Role Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Role::create([
            'role'      =>      Request::get('role'),
        ]);
        Alert::success('Success', 'User Role Entry Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $role = \App\Role::where('role_id',$id)->first();
        $validator = Validator::make(Request::all(), [
            'role'              =>  "required",
        ],
        [
            'role.required'     =>  'User Role Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Role::where('role_id',$id)->update([
            'role'      =>      Request::get('role'),
        ]);

        Alert::success('Success', 'User Role Entry Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $role = \App\Role::where('role_id',$id)->first();
        // $role->update([
        //     'isActive'      =>      '1',
        // ]);

        Alert::success('Success', 'User Role Entry Deleted Successfully');
        return redirect()->back();
    }
}
