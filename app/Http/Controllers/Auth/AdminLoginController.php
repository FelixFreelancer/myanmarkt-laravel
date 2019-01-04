<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin');
        // why don't use like it.
    }


    public function showLoginForm() {
        return view('auth.admin-login');
    }
    public function loginFunction (Request $request) {
        //validate login form
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);
        //what's that below.
        if (Auth::guard('admin')->attempt(['email'     => $request->email,'password'  => $request->password], $request->remember)){
            return redirect()->intended(route('admin'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
