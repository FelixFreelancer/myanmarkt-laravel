<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryFieldController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function getFieldsIndex(Request $request)
    {
        $categories = DB::table('categories')->orderBy('level')->get();
        if ($request->category_id == 0){
            return view('admin.category-fields', compact('categories'));
        }else {
            $selected_category_id       = DB::table('categories')->where('id', $request->category_id)->first();
            $selected_category_fields   = DB::table('categories_fields')->where('category_id', $selected_category_id->id)->get();
            $selected_category_fields_options = [];
            foreach($selected_category_fields as  $selected_category_field){
                $selected_category_fields_options[] = DB::table('categories_fields_option')->where('field_id', $selected_category_field->id)->get();

            }
//                print_r($selected_category_fields_options);echo '<br>';

//            exit;
            return view('admin.category-fields', compact('categories', 'selected_category_id', 'selected_category_fields', 'selected_category_fields_options'));
        }

    }

    public function postFieldAdd(Request $request)
    {
        if ($request->input_fields_data) {
            $input_fields = $request->input_fields_data;

            foreach ($input_fields as $input_field) {
                $input_field_info['type'] = $input_field['type'];
                $input_field_info['label'] = $input_field['label'];
                $input_field_info['required'] = $input_field['req'];
                DB::insert('insert into categories_fields (category_id, field_type, label, required) 
                                            values (?,?,?,?)', [$request->category_id, $input_field_info['type'], $input_field_info['label'], $input_field_info['required']]);
                $field_max_id = DB::table('categories_fields')->max('id');
                if (isset($input_field['choices'])) {
                    foreach ($input_field['choices'] as $input_option_field) {
                        DB::insert('insert into categories_fields_option (field_id, label)
                                            values (?, ?)', [$field_max_id, $input_option_field['label']]);

                    }
                }
            }
        }
        return 0;
    }

    public function deleteField(Request $request)
    {
        DB::table('categories_fields')->where('id', $request->delete_field_id)->delete();
        DB::table('categories_fields_option')->where('field_id', $request->delete_field_id)->delete();
        return 0;
    }

    public function getEditField(Request $request)
    {
       //$edit_field = DB::table('categories_fields')->where('id', $request->edit_field_id)->get();// object variable
       $edit_field = DB::select('select * from categories_fields where id=?', [$request->edit_field_id]);// array variable
        $edit_field = array_map(function ($value) {
            return (array)$value;
        }, $edit_field);

       print_r(json_encode($edit_field))  ;

    }

    public function postSaveField(Request $request)
    {
        $save_fields_values = $request->save_field_values;
        foreach($save_fields_values as $save_fields_value){
            $save_field = DB::table('categories_fields')->where('id', $request->save_field_id)
                ->update(['field_type' => $save_fields_value['type'], 'label' => $save_fields_value['label'],
                    'required' =>$save_fields_value['req'], 'search_required' => $save_fields_value['search']]);
        }
        return 0;

    }
    //option controller
    public function postAddOptionField(Request $request)
    {
        DB::table('categories_fields_option')->insert(['field_id' => $request->field_id, 'label' => $request->option_label]);
        return 0;
    }

    public function postSaveOptionField(Request $request)
    {
        DB::table('categories_fields_option')->where('id', $request->option_id)
            ->update(['label' => $request->option_label]);
        return 0;
    }

    public function deleteOptionField(Request $request)
    {
        DB::table('categories_fields_option')->where('id', $request->option_id)->delete();
        return 0;
    }
}
