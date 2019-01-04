<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helper\Layer2222Helper;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = DB::select('select * from categories order by level');

        return view('admin.category', compact('categories'));
    }

    public function addCategory()
    {
        $categories = DB::select('select * from categories order by level');

        return view('admin.add-category', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:255|unique:categories',
        ]);

        $data['name'] = $request->name;

       //if ($request->order)$data['category_order'] = $request->order;
        ////////////////////////////////////////////
        // if the parent category isn't, generate it.
        ////////////////////////////////////////////
        if ($request->level) {
            // get max level value
            $next_parent_level = Layer2222Helper::getNextLayer($request->level);
            $level_cur_max_value = DB::select('SELECT MAX(level) AS curmax FROM categories WHERE level > ? AND level < ?', [$request->level, $next_parent_level]);

            //$level_cur_max_value = DB::table('categories')->max('level')
            //                       ->whereBetween('level',[intval($request->level), intval($request->level+$maxLayer-1)]);

            if ($level_cur_max_value[0]->curmax) {
                $data['level'] = Layer2222Helper::getNextLayer($level_cur_max_value[0]->curmax);
            } else {
                $data['level'] = Layer2222Helper::firstChildLevel($request->level);
            }
            DB::table('categories')->insert($data);
            return 0;
        } else {
            $main_category_max_level = DB::select('SELECT MAX(level) AS curmax FROM categories WHERE level');
            $new_main_category_level = (intdiv($main_category_max_level[0]->curmax, 1000000) * 1000000) + 1000000;
            $data['level'] = $new_main_category_level;
            DB::table('categories')->insert($data);
            $max_id = DB::table('categories')->max('id');

            return 0;
        }


//       if ($validator->passes()) {
//           Session::flash('message', 'New Category Added Successfully.');
//           return redirect('admin/categories');
//       }


        return redirect()->back()->with('message', 'Category Slug Must Be Unique.');
    }

    public function editCategory($id)
    {
        $current_category = DB::table('categories')->where('id', $id)->first();
        $current_category_layer = Layer2222Helper::getCurrentLayer($current_category->level);
        if ($current_category_layer == 0) {
            $categories = DB::select('select * from categories order by level');
            return view('admin.edit-category', compact('current_category', 'categories'));
        } else {
            $categories = DB::select('select * from categories order by level');
            $edit_category = DB::table('categories')->where('id', $id)->first();

            $parent_layer = Layer2222Helper::getParentLayer($edit_category->level);

            return view('admin.edit-category', compact('categories', 'parent_layer', 'edit_category'));
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:255|unique:categories',
        ]);

        ////////////////////////////////////////////
        // if the parent category isn't, generate it.
        ////////////////////////////////////////////
        $data['name'] = $request->name;
        if ($request->level) {

            $current_category_level = DB::table('categories')->where('id', $id)->first();
            $get_current_category_parent_level = Layer2222Helper::getParentLevel($current_category_level->level);
            $data['level'] = $request->level;
            if ($data['level'] == $get_current_category_parent_level) {
                DB::table('categories')->where('id', $id)->update(['name' => $data['name']]);
                return 0;
            } else {
                $next_parent_level = Layer2222Helper::getNextLayer($request->level);
                $level_cur_max_value = DB::select('SELECT MAX(level) AS curmax FROM categories WHERE level > ? AND level < ?', [$request->level, $next_parent_level]);

                if ($level_cur_max_value[0]->curmax) {
                    $data['level'] = Layer2222Helper::getNextLayer($level_cur_max_value[0]->curmax);
                } else {
                    $data['level'] = Layer2222Helper::firstChildLevel($request->level);
                }
                DB::table('categories')->where('id', $id)->update($data);
                return 0;
            }
        } else {
            $main_category_max_level = DB::select('SELECT MAX(level) AS curmax FROM categories WHERE level');
            $new_main_category_level = (intdiv($main_category_max_level[0]->curmax, 1000000) * 1000000) + 1000000;
            $data['level'] = $new_main_category_level;
            DB::table('categories')->where('id', $id)->update($data);
            return 0;
        }


//       if ($validator->passes()) {
//           Session::flash('message', 'New Category Added Successfully.');
//           return redirect('admin/categories');
//       }


        return redirect()->back()->with('message', 'Category Slug Must Be Unique.');
    }

    public function deleteCategory($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        $delete_fields_ids = DB::select('select * from categories_fields where category_id= ?', [$id]);
        if ($delete_fields_ids) {
            foreach ($delete_fields_ids as $delete_fields_id) {
                $result = DB::table('categories_fields_option')->where('field_id', $delete_fields_id->id)->delete();
            }
            $result = DB::table('categories_fields')->where('category_id', $id)->delete();

        }
        return redirect('/admin/categories');
    }

    public function getSubCategory(Request $request)
    {
        $categories = DB::table('categories')->get();
        $main_category = "";
        $sub_categories_main_category = [];
        foreach ($categories as $category){
            if ($category->id == $request->main_category_id){
                $main_category = $category ;
            }
        }
        foreach ($categories as $category) {
            $category_main_level = Layer2222Helper::getMainLayerLevel($category->level);
            if ($category_main_level == $main_category->level){
                $sub_categories_main_category[] = $category;
            }
        }

        return response()->json(['response' => $sub_categories_main_category]);
    }

}
