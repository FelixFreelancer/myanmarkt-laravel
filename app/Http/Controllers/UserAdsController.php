<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helper\Layer2222Helper;
use Auth;
use File;

class UserAdsController extends Controller
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

            $currentLayer = Layer2222Helper::getCurrentLayer($category->level);
            if ($currentLayer == 0) {
                $main_categories[$key] = $category;
            }
        }
        $login_user_info = Auth::user()->id;

        $user_ads = DB::table('user_ads')->where('user_id', $login_user_info)->orderBy('id')->get();
        $user_ads_images = [];
        $category_names = [];
        foreach ($user_ads as $key => $user_ads_one) {
            $user_ads_images[$key] = DB::table('user_ads_images')->where('ads_id', $user_ads_one->id)->first();
            $ads_categories[$key] = DB::table('categories')->where('id', $user_ads_one->category_id)->get();
        }

        return view('user-ads', compact('main_categories', 'categories', 'user_ads', 'user_ads_images', 'ads_categories'));
    }

    public function editUserAds($ads_id)
    {
        $user_ads = DB::table('user_ads')->where('id', $ads_id)->first();
        $user_ads_images = DB::table('user_ads_images')->where('ads_id', $ads_id)->get();

        $post_input_fields = DB::table('categories_fields')->where('category_id', $user_ads->category_id)->get();
        print_r($post_input_fields); exit;
        $input_options = DB::table('categories_fields_option')->get();
        $categories = DB::table('categories')->get();
        $current_category_level = 0;
        foreach ($categories as $category) {
            if ($category->id == $user_ads->category_id) {
                $current_category_level = $category->level;
            }
        }
//        $parent_catgory_level = $category_parent_level;
        $main_category_level    = Layer2222Helper::getMainLayerLevel($current_category_level);
        $parent_category_level  = Layer2222Helper::getParentLevel($current_category_level);
        //get parent category
        foreach ($categories as $category) {
            if ($category->level == $parent_category_level) {
                $parent_category = $category;
            }
            if ($category->level == $main_category_level) {
                $main_category = $category;
            }
            if ($category->id == $user_ads->category_id) {
                $current_category = $category;
            }
        }

        foreach ($post_input_fields as $key => $post_input_field) {
            foreach ($input_options as $input_option) {
                if ($input_option->field_id == $post_input_field->id) {
                    $post_input_fields[$key]->options[] = $input_option;
                }
            }
        }
        //input fields values
        $fields_values = DB::table('post_fields_values')->where('post_id', $ads_id)->get();

//        print_r($fields_values); exit;
        if ($main_category_level == $parent_category_level) {
            return view('user-ads-edit', compact('post_input_fields', 'main_category', 'current_category', 'fields_values', 'user_ads', 'user_ads_images'));

        } else {
            return view('user-ads-edit', compact('post_input_fields', 'main_category', 'parent_category_level', 'parent_category', 'current_category', 'fields_values', 'user_ads', 'user_ads_images'));

        }
//        return view('user-ads-edit');
    }

    public function updateUserAds(Request $request)
    {
        $input_field_ids    = $request->input_field_id;
        $option_field_ids    = $request->option_field_id;
        $input_field_values  = $request->input_field_value;

        // ads main table insert
        $user_ads['category_id']        = $request->category_id;
        $user_ads['ads_main_name']      = $request->ads_main_name;
        $user_ads_id                    = $request->user_ads_id;
        $user_ads['user_id']            = Auth::user()->id;

        $user_ads_images = $request->ads_images;
        $user_ads_images = explode('|', $user_ads_images);

        // update user ads table
        DB::table('user_ads')->where('id', $user_ads_id)->update($user_ads);

        // update user ads image table

        foreach ($user_ads_images as $user_ads_image){
            DB::table('user_ads_images')->insert(['ads_id' => $user_ads_id, 'ads_image' => $user_ads_image]);
        }
//        print_r($input_field_values);exit;
        foreach($input_field_ids as $key=>$input_field_id){
            $input_data['post_id']          = $user_ads_id;
            $input_data['field_id']         = $input_field_id;
            $input_data['field_value']      = $input_field_values[$key];

            // if field has option tags,
            if (gettype($input_data['field_value']) == 'array') {
                foreach($input_data['field_value'] as $key => $input_data_option){

                    $result = DB::table('post_fields_values')->where([['option_field_id', $option_field_ids[$key]], ['post_id', $user_ads_id], ['field_id', $input_field_id]])->update(
                        ['post_id' => $user_ads_id, 'field_id' => $input_field_id, 'field_value' =>$input_data_option]);
                }
            }else {
                DB::table('post_fields_values')->where([['post_id', $user_ads_id], ['field_id', $input_field_id]])->update($input_data);
            }
        }

        return 0;

    }

    public function deleteImage(Request $request)
    {
        $result = DB::table('user_ads_images')->where([['ads_id', $request->user_ads_id], ['ads_image', $request->imageName]])
                ->delete();
        $delete_file = public_path('upload/').$request->imageName;
        File::delete($delete_file);
        if ($result) return 0;
    }

    public function deleteAds(Request $request)
    {
        $result1 = DB::table('user_ads')->where('id' , $request->ads_id)->delete();
        $delete_files = DB::table('user_ads_images')->where('ads_id', $request->ads_id)->get();
        foreach($delete_files as $delete_file){
            $delete_file_name = public_path('upload/').$delete_file->ads_image;
            File::delete($delete_file_name);
        }
        $result2 = DB::table('user_ads_images')->where('ads_id', $request->ads_id)->delete();
        $result3 = DB::table('post_fields_values')->where('post_id', $request->ads_id)->delete();
        if ($result1 && $result2 && $result3) return 0;
    }

}
