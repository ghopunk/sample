<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginPage extends Controller
{
    //
	
	public function login(Request $request)
    {
		if(!session()->has('url.intended'))
		{
			session(['url.intended' => url()->previous()]);
			//Session::flash('url.intended', url()->previous());
		}
        if( Auth::guard('login')->check() ) {
			//var_dump(url()->previous());
			return redirect()->intended();
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
		$this->validate( $request,[
			'user'   	=> 'required',
			'password'  => 'required'
		]);
		$credentials = [
			'user' 		=> $request->user,
			'password' 	=> $request->password,
		];
		if( Auth::guard('login')->attempt($credentials)){
			return redirect()->intended();
		} else {
			return redirect()->back()->withErrors( "Sorry, the passed username or password is incorrect, try again!" )->withInput();
        }
    }

    public function actionlogout(Request $request)
    {
		Auth::guard('login')->logout();
		return redirect()->intended();
    }
}
