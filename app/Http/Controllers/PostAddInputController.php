<?php

namespace App\Http\Controllers;

use App\Helper\Layer2222Helper;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Auth;

class PostAddInputController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $main_category_id = Db::table('categories')->where('level', $request->parent_level)->first();
        $post_input_fields = [];
        $post_input_fields = DB::table('categories_fields')->where('category_id', $main_category_id->id)->get();
        if (sizeof($post_input_fields) == 0) {
            $post_input_fields = DB::table('categories_fields')->where('category_id', $request->child_id)->get();
        }

        $input_options = DB::table('categories_fields_option')->get();
        $categories = DB::table('categories')->get();
        $parent_catgory_level = $request->parent_level;
        $main_category_level = Layer2222Helper::getMainLayerLevel($parent_catgory_level);
        //get parent category
        foreach ($categories as $category) {
            if ($category->level == $parent_catgory_level) {
                $parent_category = $category;
            }
            if ($category->level == $main_category_level) {
                $main_category = $category;
            }
            if ($category->id == $request->child_id) {
                $current_category = $category;
            }
        }

        foreach ($post_input_fields as $key => $post_input_field) {
            foreach ($input_options as $input_option) {
                if ($input_option->field_id == $post_input_field->id) {
                    $post_input_fields[$key]->options[] = $input_option;
                }

            }
//            print_r($post_input_field);
//            echo "<br>";
        }
//        echo $parent_catgory_level ,' ', $main_category_level;exit;

        if ($main_category_level == $parent_catgory_level) {
            return view('post-add-input', compact('post_input_fields', 'main_category_level', 'main_category', 'current_category'));

        } else {
            return view('post-add-input', compact('post_input_fields', 'parent_catgory_level', 'parent_category', 'main_category', 'current_category'));

        }
//        exit;
    }

    public function postImageUpload(Request $request)
    {
        $imageName = request()->post_image->getClientOriginalName();
        request()->post_image->move(public_path('upload'), $imageName);
//        {"initialPreview":["https://placeimg.com/800/460/animals/1"],
//            "initialPreviewAsData":true,
//            "initialPreviewConfig":
//            [{"caption":"Animal-1.jpg","size":732762,"width":"120px","url":"/site/file-delete","key":1}]}
        $uploaded_image_response = new \stdClass();
        $uploaded_image_response->initialPreview = ["http://localhost:8090/upload/".$imageName];
        $uploaded_image_response->initialPreviewAsData = true;
        $uploaded_image_response_config = new \stdClass();
        $uploaded_image_response_config->caption = $imageName;
        $uploaded_image_response_config->url = '/post-add/image-delete';
        $uploaded_image_response_config->key = $imageName;
        $uploaded_image_response->initialPreviewConfig = [$uploaded_image_response_config];
//        print_r(json_encode($uploaded_image_response));
        //echo json_encode($uploaded_image_response);
//        echo "{\"initialPreview\":[\"https://placeimg.com/800/460/animals/1\"],\"initialPreviewAsData\":true,\"initialPreviewConfig\":[{\"caption\":\"Animal-1.jpg\",\"size\":732762,\"width\":\"120px\",\"url\":\"/site/file-delete\",\"key\":1}]}";
        return response()->json(['uploaded' => $imageName]);
    }

    public function postImageDelete(Request $request)
    {
        var_dump($request->input('deleteimage'));
    }

    public function postDataSubmit(Request $request)
    {

        $input_field_ids = $request->input_field_id;
        $input_field_ids = explode(',',$input_field_ids);

        $option_field_ids = $request->option_field_id;
//        print_r($option_field_ids); exit;
        $input_field_values = $request->input_field_value;
        $input_field_values = explode(',',$input_field_values);

        // ads main table insert
        $user_ads['category_id'] = $request->category_id;
        $user_ads['main_category_id'] = $request->main_category_id;
        $user_ads['ads_main_name'] = $request->ads_main_name;
        $user_ads['user_id'] = Auth::user()->id;
        $user_ads['ads_type'] = $request->ads_type;
        //non of selected ads type, default regular
        if(trim($user_ads['ads_type']) == ''){
            $user_ads['ads_type'] = 2;
        }
        //ads_type_label
        $user_ads['ads_type_label'] = "" ;
        switch ($user_ads['ads_type']){
            case 0:
                $user_ads['ads_type_label'] = "featured";
                break;
            case 1:
                $user_ads['ads_type_label'] = "promoted";
                break;
            case 2:
                $user_ads['ads_type_label'] = "regular";
                break;
            case 3:
                $user_ads['ads_type_label'] = "sold";
                break;
            default:
                $user_ads['ads_type_label'] = "regular";
                break;

        }
        //when create data row, get current time
        $now = new DateTime();
        $user_ads['created_at'] = $now->format('Y-m-d H:i:s');
        //upload cv file
        if ($request->file('upload_cv')){
            $cv_fileName = request()->upload_cv->getClientOriginalName();
            request()->upload_cv->move(public_path('upload'), $cv_fileName);
        }

        //user_ads table insert data
        DB::table('user_ads')->insert($user_ads);
        // ads image table insert
        $max_ads_id = DB::table('user_ads')->max('id');

        $user_ads_images = $request->ads_images;
        if ($request->category_id == 243 ){
            DB::table('user_ads_images')->insert(['ads_id' => $max_ads_id, 'ads_image' => 'hiring.png']);
        }else if ($request->category_id == 244){
            DB::table('user_ads_images')->insert(['ads_id' => $max_ads_id, 'ads_image' => 'wanted.png']);
        }
        if (trim($user_ads_images) != "") {
            $user_ads_images = explode('|', $user_ads_images);

            foreach ($user_ads_images as $user_ads_image) {
                DB::table('user_ads_images')->insert(['ads_id' => $max_ads_id, 'ads_image' => $user_ads_image]);
            }
        }


        foreach ($input_field_ids as $key => $input_field_id) {
            $input_data['post_id'] = $max_ads_id;
            $input_data['field_id'] = $input_field_id;
            $input_data['field_value'] = $input_field_values[$key];

            if ($input_data['field_value'] == 'options') {
                $input_data_options = $request->option_field_values;
                print_r($option_field_ids);
                $input_data_options = explode(',', $input_data_options);
                $option_field_ids   = explode(',', $option_field_ids);
                foreach ($input_data_options as $option_key => $input_data_option) {
                    DB::table('post_fields_values')->insert(
                        ['post_id' => $max_ads_id, 'option_field_id' => $option_field_ids[$option_key], 'field_id' => $input_field_id,
                            'field_value' => $input_data_option]);
                }
            } else {
                if (trim($input_data['field_value']) == ''){
                    $input_data['field_value'] = 'null';
                }
                DB::table('post_fields_values')->insert($input_data);
            }
        }

        return  redirect()->back();
//        return 1;
    }
}
