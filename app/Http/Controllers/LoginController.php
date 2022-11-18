<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUser;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();

        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
    }

    if(auth()->attempt(array('email' =>$input['email'], 'password'=> $input['password']))){
        if (auth()->user()->roles_id == 1){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('login')->with('email','email-Address And Password Are Wrong.');
        }
    }
}
