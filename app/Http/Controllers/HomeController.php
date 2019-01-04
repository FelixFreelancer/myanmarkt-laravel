<?php

namespace App\Http\Controllers;

use App\Helper\Layer2222Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->orderBy('level')->get();
        $main_categories = [];
        foreach ($categories as $key=>$category) {
//            print_r(gettype($category->level));
            //echo "<br>";
            $currentLayer = Layer2222Helper::getCurrentLayer($category->level);
            if ($currentLayer == 0 ){
                $main_categories[$key] = $category;
            }
        }

//        print_r($categories);
//        exit;
        return view('index', compact('main_categories', 'categories'));
    }
}
