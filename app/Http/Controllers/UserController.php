<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helper\Layer2222Helper;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editUser()
    {
        $categories = DB::table('categories')->orderBy('level')->get();
        $main_categories = [];
        foreach ($categories as $key => $category) {
//            print_r(gettype($category->level));
            //echo "<br>";
            $currentLayer = Layer2222Helper::getCurrentLayer($category->level);
            if ($currentLayer == 0) {
                $main_categories[$key] = $category;
            }
        }
        $login_user_email = Auth::user()->email;
        $user_info = DB::table('users')->where('email', $login_user_email)->first();

        return view('user-profile', compact('main_categories', 'categories', 'user_info'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->gender       = $request->input('gender');
        $user->age          = $request->input('age');
        $user->city         = $request->input('city');
        if ($request->input('password') !="" ){
            $user->password     = Hash::make($request->input('password'));
        }

        $user->update();
        return redirect('/user/edit');

    }
}
