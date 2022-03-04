<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $data = \App\User::orderBy('email')->where('isActive',0)->get();

        if (Request::ajax()) {
            return Datatables::of($data)
            ->addColumn('roles', function($data){
                return $data->role->role;
            })

            ->addColumn('orgs', function($data){
                if($data->organization_id == NULL){
                    $orgs = 'N/A';
                }else{
                    $orgs = $data->organization->organization_acronym;
                }
                return $orgs;
            })

            ->addColumn('action', function($data){
                $btn = 
                '<center>
                    <span data-toggle="tooltip" data-placement="top" title="Edit User Entry">
                        <a href="'.action('UserController@edit',$data->id).'" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span data-toggle="tooltip" data-placement="top" title="Delete User Entry">
                        <a data-bs-target="#delete'.$data->id.'" data-bs-toggle="modal" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                        </a>
                    </span>
                    <span data-toggle="tooltip" data-placement="top" title="Reset Password Entry">
                        <a data-bs-target="#reset'.$data->id.'" data-bs-toggle="modal" class="btn btn-secondary btn-sm">
                        <i class="fa fa-retweet"></i>
                        </a>
                    </span>
                </center>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.users.index',compact('data'));
        
    }

    public function create(){
        $orgs = \App\Organization::orderBy('organization_name')
            ->get()
            ->pluck('organization_name','organization_id');
        $roles = \App\Role::orderBy('role')
            ->get()
            ->pluck('role','role_id');
        return view('admin.users.create',compact('orgs','roles'));

    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'fullname'          =>  'required',
            'name'              =>  'required|unique:users',
            'email'             =>  'required|unique:users',
            'role_id'           =>  'required',
            'password'          =>  'required',
        ],
        [
            'fullname.required'         =>  'Full Name Required',
            'name.required'             =>  'Username Required',
            'email.required'            =>  'Email Required',
            'role_id.required'          =>  'Please Select User Role',
            'password.required'         =>  'Password Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(Request::get('organization_id') != NULL){
            $org = Request::get('organization_id');
        }else{
            $org = NULL;
        }

        $user_id = \App\User::create([
            'fullname'              =>          Request::get('fullname'),
            'name'                  =>          Request::get('name'),
            'email'                 =>          Request::get('email'),
            'role_id'               =>          Request::get('role_id'),
            'organization_id'       =>          $org,
            'password'              =>          \Hash::make(preg_replace('/\s+/', '',Request::get('password'))),
        ])->id;


        Alert::success('Success', 'User Created Successfully');
        return redirect()->back();
    }

    public function edit($id){
        $user = \App\User::find($id);
        $orgs = \App\Organization::orderBy('organization_name')
            ->get()
            ->pluck('organization_name','organization_id');
        $roles = \App\Role::orderBy('role')
            ->get()
            ->pluck('role','role_id');
        return view('admin.users.edit',compact('orgs','roles','user'));

    }

    public function update($id){
        $user = \App\User::find($id);
        $validator = Validator::make(Request::all(), [
            'fullname'          =>  'required',
            'name'              =>  "required|unique:users,name,$user->id,id",
            'email'             =>  "required|unique:users,email,$user->id,id",
            'role_id'           =>  'required',
        ],
        [
            'fullname.required'         =>  'Full Name Required',
            'name.required'             =>  'Username Required',
            'email.required'            =>  'Email Required',
            'role_id.required'          =>  'Please Select User Role',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(Request::get('organization_id') != NULL){
            $org = Request::get('organization_id');
        }else{
            $org = NULL;
        }

        $user->update([
            'fullname'              =>          Request::get('fullname'),
            'name'                  =>          Request::get('name'),
            'email'                 =>          Request::get('email'),
            'role_id'               =>          Request::get('role_id'),
            'organization_id'       =>          $org,
        ]);


        Alert::success('Success', 'User Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $user = \App\User::find($id);
        $user->update([
            'isActive'      =>      '1',
        ]);

        Alert::success('Success', 'User Deleted Successfully');
        return redirect()->back();
    }

    public function reset($id){
        $user = \App\User::find($id);
        $user->update([
            'password'      =>      \Hash::make(preg_replace('/\s+/', '',$user->email)),
        ]);

        Alert::success('Success', 'User Password Reset Successfully');
        return redirect()->back();
    }
}
