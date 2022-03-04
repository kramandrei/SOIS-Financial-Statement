<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;


class OrganizationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $data = \App\Organization::query()->select(['organization_id','organization_name','organization_acronym'])->get();
        if (Request::ajax()) {
            return Datatables::of($data)
            ->addColumn('action', function($data){
                $btn = 
                '<center>
                    <span data-toggle="tooltip" data-placement="top" title="Edit Organization Entry">
                        <a data-bs-target="#edit'.$data->id.'" data-bs-toggle="modal" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                    </span>
                </center>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.organizations.index',compact('data'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'organization_name'              =>  'required|unique:organizations',
            'organization_acronym'           =>  'required|unique:organizations',
        ],
        [
            'organization_name.required'     =>  'Name Required',
            'organization_acronym.required'  =>  'Acronym Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Organization::create(Request::all());
        Alert::success('Success', 'Organization Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $organization = \App\Organization::where('organization_id',$id)->first();
        $validator = Validator::make(Request::all(), [
            'organization_name'              =>  "required|unique:organizations,organization_name,$organization->id,id",
            'organization_acronym'           =>  "required|unique:organizations,organization_acronym,$organization->id,id",
        ],
        [
            'organization_name.required'     =>  'Name Required',
            'organization_acronym.required'  =>  'Acronym Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Organization::where('organization_id',$id)->update(Request::all());
        Alert::success('Success', 'Organization Updated Successfully');
        return redirect()->back();
    }

}
