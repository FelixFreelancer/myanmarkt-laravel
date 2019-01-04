<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helper\Layer2222Helper;

class PostAddController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
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

//        print_r($categories);
//        exit;
        return view('post-add', compact('main_categories'));
    }

    public function postCategory()
    {
        return view('post-category');
    }

    public function postSubCategory($category)
    {
        $parent_category = DB::table('categories')->where('id', $category)->first();
        $parent_category_level = Layer2222Helper::getMainLayerLevel($parent_category->level);
        $categories = DB::table('categories')->orderBy('level')->get();
        $child_categories = [];
        foreach ($categories as $key => $category) {
//            print_r(gettype($category->level));
            //echo "<br>";
            $currentLayer = Layer2222Helper::getMainLayerLevel($category->level);
            $current_level = Layer2222Helper::getCurrentLayer($category->level);
            if ($currentLayer == $parent_category_level) {
                $child_categories[] = $category;
            }
        }

        return view('post-category', compact('child_categories', 'parent_category'));

    }

    public function postSubSubCategory($level)
    {
        $main_category_level = Layer2222Helper::getMainLayerLevel($level);
//        $main_category = DB::table('categories')->where('level', $main_category_level)->first();

        $categories = DB::table('categories')->orderBy('level')->get();

        $child_categories = [];
        foreach($categories as $category){
            if ($category->level == $main_category_level) {
                $main_category = $category;
            }
            if ($category->level == $level) {
                $parent_category = $category;
            }
            $current_level = Layer2222Helper::getParentLevel($category->level);
            $next_level = Layer2222Helper::getNextLayer($level);
//            print_r($current_level);
//            echo "<br>";
            if ($current_level >= $level && $current_level < $next_level){
                $child_categories[] = $category;
            }
        }
//        print_r($child_categories);
//        exit;
        return view('post-sub-category', compact('child_categories', 'main_category', 'parent_category'));

    }
}
