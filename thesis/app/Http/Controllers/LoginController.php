<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Validator;
use Alert;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'email'          =>  'required',
            'password'      =>  'required',
        ],
        [
            'email.required'        =>  'Email Required',
            'password.required'     =>  'Password Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password')])) {
            //if(Auth::user()){
                return redirect()->route('dashboard.index');
            //}else{
            //    Alert::error('Warning', 'Login Credentials Not Found');
            //    return redirect()->back();
            //}
        }else{
            Alert::error('Warning', 'Login Credentials Not Found');
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
