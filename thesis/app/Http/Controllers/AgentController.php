<?php

namespace App\Http\Controllers;

use App\Agent;
use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
Use Alert;

class AgentController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    
    public function index(){
        $agent = new Agent;
        $agent->setConnection('agents');
        $data = $agent->query()->select(['id','name','code','isTech'])->get();
        if (Request::ajax()) {
	        return Datatables::of($data)
            ->editColumn('name', function($data){
                if($data->isTech == 1){
                    $name = $data->name.' * ';
                }else{
                    $name = $data->name;
                }

                return $name;
            })
            ->addColumn('action', function($data){
                $btn = 
                '<center>
                    <span data-toggle="tooltip" data-placement="top" title="Edit Agent">
                        <a data-bs-target="#edit'.$data->id.'" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                    </span>
                </center>';
				return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
	    }

        $agents = $agent->query()->select(['id','name','code','isTech'])->get();

    	return view('admin.agents.index',compact('agents'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
		    'name'						=>	'required|unique:agents',
		    'code'						=>	'required|unique:agents',
		],
		[
		    'name.required'     		=>	'Agent Name Required',
		    'code.required'     		=>	'Agent Code Required',
		]);

		if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data =Request::except('isTech');

		if(Request::get('isTech') == 1){
			$isTech = 1;
		}else{
			$isTech = 0;
		}

        $data = Arr::add($data, 'isTech', $isTech);
		Agent::create($data);
        Alert::success('Success', 'Agent Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $agent = Agent::find($id);
		$validator = Validator::make(Request::all(), [
		    'name'						=>	"required|unique:agents,name,$agent->id,id",
		    'code'						=>	"required|unique:agents,code,$agent->id,id",
		],
		[
		    'name.required'     		=>	'Agent Name Required',
		    'code.required'     		=>	'Agent Code Required',
		]);


		if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

		$data =Request::except('isTech');

		if(Request::get('isTech') == 1){
			$isTech = 1;
		}else{
			$isTech = 0;
		}

        $data = Arr::add($data, 'isTech', $isTech);
        $agent->update($data);
        Alert::success('Success', 'Agent Updated Successfully');
        return redirect()->back();
    }
}
