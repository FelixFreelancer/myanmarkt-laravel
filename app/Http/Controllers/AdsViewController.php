<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Helper\Layer2222Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use Carbon\Carbon;

class AdsViewController extends Controller
{
    //
    public function index(Request $request)
    {
        //header menu category
        $categories = DB::table('categories')->orderBy('level')->get();
        $main_categories = [];
        foreach ($categories as $key => $category) {
            $currentLayer = Layer2222Helper::getCurrentLayer($category->level);
            if ($currentLayer == 0) {
                $main_categories[$key] = $category;
            }
        }
        //get current category id
        $current_category_id = $request->category_id;
        //get main category id
        $main_category_id = $request->main_category_id;
        //get main category name, sub category name
        $main_category_name = "";
        $sub_category_name = "";
        foreach ($categories as $category) {
            if ($category->id == $main_category_id) {
                $main_category_name = $category;
            }
            if ($category->id == $current_category_id) {
                $sub_category_name = $category;
            }
        }

        //get ads main category and sub category
        $user_ads_main_category = DB::table('user_ads')->where('main_category_id', $main_category_id)->orderBy('ads_type')
            ->orderByDesc('created_at')->get();
        $user_ads_sub_category_array_featured = [] ;
        $user_ads_sub_category_array_random_featured = [];
        $user_ads_sub_category_array_regular = [];
        $user_ads_main_category_feature_array = [];
        $user_ads_main_category_array_random_featured = [];

        $random_ads_main_array_count = 0;
        $random_ads_sub_array_count = 0;
        foreach ($user_ads_main_category as $user_ad_main_category_one) {
            //std Object class to array
            if ($user_ad_main_category_one->ads_type == "0") {
                $user_ads_main_category_feature_array [] = $user_ad_main_category_one;
            }
            if ($user_ad_main_category_one->category_id == $current_category_id) {
                if ($user_ad_main_category_one->ads_type == "0") {
                    $user_ads_sub_category_array_featured [] = $user_ad_main_category_one;
                } else {
                    //if non-featured....
                    $user_ads_sub_category_array_regular [] = $user_ad_main_category_one;
                }
            }
        }

        //random 4 main category ads
        if (sizeof($user_ads_main_category_feature_array) > 0) {
            if (sizeof($user_ads_main_category_feature_array) >= 4) {
                $random_ads_main_array_count = 4;
            } else {
                $random_ads_main_array_count = sizeof($user_ads_main_category_feature_array);
            }

            $array_rand_index_array = array_rand($user_ads_main_category_feature_array, $random_ads_main_array_count);

            if ($array_rand_index_array > 0){
                foreach ($array_rand_index_array as $array_rand_index) {
                    $user_ads_main_category_array_random_featured[] = $user_ads_main_category_feature_array[$array_rand_index];
//                print_r($user_ads_main_category_array_random_featured->id);
                }
            }else {
                $user_ads_main_category_array_random_featured = $user_ads_main_category_feature_array;
            }
        }
//        print_r($user_ads_main_category_array_random_featured); exit;
        //random 4 sub category ads
        if (sizeof($user_ads_sub_category_array_featured) > 0) {
            if ( sizeof($user_ads_sub_category_array_featured) >= 4) {
                $random_ads_sub_array_count = 4;
            } else {
                $random_ads_sub_array_count = sizeof($user_ads_sub_category_array_featured);
            }
            $sub_category_adsarray_rand_index_array = array_rand($user_ads_sub_category_array_featured, $random_ads_sub_array_count);

            if ($sub_category_adsarray_rand_index_array > 0) {
                foreach ($sub_category_adsarray_rand_index_array as $array_rand_index_sub) {
                    $user_ads_sub_category_array_random_featured[] = $user_ads_sub_category_array_featured[$array_rand_index_sub];
//                    print_r($user_ads_sub_category_array_random_featured);echo '<br>';
                }
            }else {
                $user_ads_sub_category_array_random_featured = $user_ads_sub_category_array_featured;
            }

        }
        //any ads has info. ITEMS => price region, currency,
        $items_fields_ids = DB::table('categories_fields')->where('category_id', $main_category_id)->get();
        //Job hire and want
        $job_hire_fields_ids = []; $job_want_fields_ids = [];
        $job_hire_fields_price_id = 0;
        $job_hire_fields_currency_id = 0;
        $job_hire_fields_region_id = 0;
        $job_want_fields_price_id = 0;
        $job_want_fields_currency_id = 0;
        $job_want_fields_region_id = 0;
        $job_type_ids = []; $job_category_ids = [] ;
        if (! sizeof($items_fields_ids) > 0){
            $items_fields_ids = DB::table('categories_fields')->where('category_id', $current_category_id)->get();
            $job_hire_fields_ids = DB::table('categories_fields')->where('category_id', 243)->get();
            $job_want_fields_ids = DB::table('categories_fields')->Where('category_id', 244)->get();
            foreach($job_hire_fields_ids as $job_hire_fields_id){
                if ($job_hire_fields_id->label == "Salary") $job_hire_fields_price_id = $job_hire_fields_id->id;
                if ($job_hire_fields_id->label == "Kyat") $job_hire_fields_currency_id = $job_hire_fields_id->id;
                if ($job_hire_fields_id->label == "Please select location") $job_hire_fields_region_id = $job_hire_fields_id->id;
                if ($job_hire_fields_id->label == "Job type") $job_type_ids[] = $job_hire_fields_id->id;
                if ($job_hire_fields_id->label == "Job category") $job_category_ids[] = $job_hire_fields_id->id;
            }
            foreach($job_want_fields_ids as $job_want_fields_id){
                if ($job_want_fields_id->label == "Salary expectation") $job_want_fields_price_id = $job_want_fields_id->id;
                if ($job_want_fields_id->label == "Kyat") $job_want_fields_currency_id = $job_want_fields_id->id;
                if ($job_want_fields_id->label == "Please select location") $job_want_fields_region_id = $job_want_fields_id->id;
                if ($job_want_fields_id->label == "Job type") $job_type_ids[] = $job_want_fields_id->id;
                if ($job_want_fields_id->label == "Job category") $job_category_ids[] = $job_want_fields_id->id;
            }
        }
//        print_r($job_want_fields_price_id); exit;
        //all main category values
        $items_fields_price_id = 0;
        $items_fields_currency_id = 0;
        $items_fields_region_id = 0;

        $motors_fields_mileage_id = 0;
        $motors_fields_name_ids = [];
        //for rent and sale subtitle id
        $property_fields_ids_sub1 = [] ; $property_fields_ids_sub2 = [];
        foreach ($items_fields_ids as $items_fields_id) {
            if ($items_fields_id->label == "Price") $items_fields_price_id = $items_fields_id->id;
            if ($items_fields_id->label == "Kyat") $items_fields_currency_id = $items_fields_id->id;
            if ($items_fields_id->label == "Please select location") $items_fields_region_id = $items_fields_id->id;
            if ($items_fields_id->label == "Mileage (in km)") $motors_fields_mileage_id = $items_fields_id->id;
            //motors main name id
            if ($items_fields_id->label == "Make") $motors_fields_name_ids[] = $items_fields_id->id;
            if ($items_fields_id->label == "Model") $motors_fields_name_ids[] = $items_fields_id->id;
            if ($items_fields_id->label == "Year") $motors_fields_name_ids[] = $items_fields_id->id;
            //rent and sale subtitle ids
            if ($items_fields_id->label == "Size") $property_fields_ids_sub1[] = $items_fields_id->id;
            if ($items_fields_id->label == "sq feet") $property_fields_ids_sub1[] = $items_fields_id->id;
            if ($items_fields_id->label == "Bedrooms") $property_fields_ids_sub2[] = $items_fields_id->id;
            if ($items_fields_id->label == "Bathrooms") $property_fields_ids_sub2[] = $items_fields_id->id;

        }
//        print_r($motors_fields_name_ids);exit;
//        exit;
//        print_r($items_fields_region_id); exit;
        //main-category featured random get info
        $ads_main_featured_image_array = [];
        $ads_main_featured_fields_values = [];
        $ads_main_featured_price = [];
        $ads_main_featured_currency = [];
        $ads_main_featured_region = [];
        $ads_main_featured_mileage = [];
        $ads_main_featured_subtitle = [];
        $motors_main_featured_name_array = []; $motors_name_array_index = 0 ;

        //get items field id matched value
        foreach ($user_ads_main_category_array_random_featured as $main_featured_one) {
            //get main category ads image and fields values
//            print_r($main_featured_one->id); echo '<br>';
            $ads_main_featured_image_array[] =      DB::table('user_ads_images')->where('ads_id', $main_featured_one->id)->first();
            $ads_main_featured_fields_values[] =    DB::table('post_fields_values')->where('post_id', $main_featured_one->id)->get();

        }
//        print_r($ads_main_featured_image_array); exit;

        //get main category ads price, region, currency values.
        foreach ($ads_main_featured_fields_values as $key => $ads_main_featured_field_value) {
//            print_r($ads_main_featured_field_value); echo '<br>';
            foreach ($ads_main_featured_field_value as $field_value_one) {
                if ($field_value_one->field_id == $items_fields_price_id){

                    $ads_main_featured_price[] = number_format($field_value_one->field_value) ;
                }
                if ($field_value_one->field_id == $items_fields_currency_id)
                    $ads_main_featured_currency[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $items_fields_region_id)
                    $ads_main_featured_region[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $motors_fields_mileage_id)
                    $ads_main_featured_mileage[] = $field_value_one->field_value;

                //job values
                if ($field_value_one->field_id == $job_hire_fields_price_id || $field_value_one->field_id == $job_want_fields_price_id)
                    $ads_main_featured_price[] = number_format($field_value_one->field_value) ;
                if ($field_value_one->field_id == $job_hire_fields_currency_id || $field_value_one->field_id == $job_want_fields_currency_id)
                    $ads_main_featured_currency[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $job_hire_fields_region_id || $field_value_one->field_id == $job_want_fields_region_id)
                    $ads_main_featured_region[] = $field_value_one->field_value;

                foreach($job_type_ids as $job_type_id){
                    if ($field_value_one->field_id == $job_type_id){
                        $ads_main_featured_subtitle[$key]['sub_title_1'] = $field_value_one->field_value;
                    }
                }
                foreach($job_category_ids as $job_category_id){
                    if ($field_value_one->field_id == $job_category_id){
                        $ads_main_featured_subtitle[$key]['sub_title_2'] = $field_value_one->field_value;
                    }
                }

                //main category featured motors main name
                foreach($motors_fields_name_ids as $motors_main_name_id){
                    if ($field_value_one->field_id == $motors_main_name_id) {
                        $motors_main_featured_name_array [$motors_name_array_index][] = $field_value_one->field_value." ";
                    }

                }

                //main category featured property subtitle
                foreach ($property_fields_ids_sub1 as $property_sub1_id){
                    if ($field_value_one->field_id == $property_sub1_id){
                        $ads_main_featured_subtitle[$key]['sub_title_1'][] = $field_value_one->field_value;
                    }
                }
                foreach ($property_fields_ids_sub2 as $property_sub2_id){
                    if ($field_value_one->field_id == $property_sub2_id){
                        $ads_main_featured_subtitle[$key]['sub_title_2'][] = $field_value_one->field_value;
                    }
                }
            }
            $motors_name_array_index ++;
        }
//        print_r($ads_main_featured_subtitle);exit;
//        var_dump($ads_main_featured_price, $ads_main_featured_currency, $ads_main_featured_region);exit;


        //get sub-category ads price, region, currency values.
        $ads_sub_featured_image_array = [];
        $ads_sub_featured_fields_values = [];
        $ads_sub_featured_price = [];
        $ads_sub_featured_currency = [];
        $ads_sub_featured_region = [];
        $ads_sub_featured_mileage = [];
        $job_type_sub_featured = []; $job_category_sub_featured = [] ;
        $ads_sub_featured_subtitle = [];
        $motors_sub_featured_name_array = []; $motors_sub_name_array_index = 0 ;

        foreach ($user_ads_sub_category_array_random_featured as $sub_featured_one) {
            $ads_sub_featured_image_array[] = DB::table('user_ads_images')->where('ads_id', $sub_featured_one->id)->first();
            $ads_sub_featured_fields_values[] = DB::table('post_fields_values')->where('post_id', $sub_featured_one->id)->get();
        }

        foreach ($ads_sub_featured_fields_values as $key => $ads_sub_featured_field_value) {
//            print_r($ads_main_featured_field_value); echo '<br>';
            foreach ($ads_sub_featured_field_value as $field_value_one) {
                if ($field_value_one->field_id == $items_fields_price_id)
                    $ads_sub_featured_price[] = number_format($field_value_one->field_value) ;
//                if ($field_value_one->field_id == $items_fields_salary_id)
//                    $ads_sub_featured_fields_values[$key]['salary'] = number_format($field_value_one->field_value) ;
                if ($field_value_one->field_id == $items_fields_currency_id)
                    $ads_sub_featured_currency[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $items_fields_region_id)
                    $ads_sub_featured_region[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $motors_fields_mileage_id)
                    $ads_sub_featured_mileage[] = $field_value_one->field_value;
                //job values
                if ($field_value_one->field_id == $job_hire_fields_price_id || $field_value_one->field_id == $job_want_fields_price_id)
                    $ads_sub_featured_price[] = number_format($field_value_one->field_value) ;
                if ($field_value_one->field_id == $job_hire_fields_currency_id || $field_value_one->field_id == $job_want_fields_currency_id)
                    $ads_sub_featured_currency[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $job_hire_fields_region_id || $field_value_one->field_id == $job_want_fields_region_id)
                    $ads_sub_featured_region[] = $field_value_one->field_value;

                foreach($job_type_ids as $job_type_id){
                    if ($field_value_one->field_id == $job_type_id){
                        $ads_sub_featured_subtitle[$key]['sub_title_1'] = $field_value_one->field_value;
                    }
                }
                foreach($job_category_ids as $job_category_id){
                    if ($field_value_one->field_id == $job_category_id){
                        $ads_sub_featured_subtitle[$key]['sub_title_2'] = $field_value_one->field_value;
                    }
                }
                //sub category featured motors main name
                foreach($motors_fields_name_ids as $motors_main_name_id){
                    if ($field_value_one->field_id == $motors_main_name_id) {
                        $motors_sub_featured_name_array [$motors_sub_name_array_index][] = $field_value_one->field_value." ";
                    }

                }
                //sub category featured property subtitle
                foreach ($property_fields_ids_sub1 as $property_sub1_id){
                    if ($field_value_one->field_id == $property_sub1_id){
                        $ads_sub_featured_subtitle[$key]['sub_title_1'][] = $field_value_one->field_value;
                    }
                }
                foreach ($property_fields_ids_sub2 as $property_sub2_id){
                    if ($field_value_one->field_id == $property_sub2_id){
                        $ads_sub_featured_subtitle[$key]['sub_title_2'][] = $field_value_one->field_value;
                    }
                }
            }
            $motors_sub_name_array_index++;
        }

//        var_dump($ads_sub_featured_price, $ads_sub_featured_currency, $ads_sub_featured_region);
//        exit;
        //get user name
        //main category user name
        $user_info_array = DB::table('users')->get();
        $main_featured_random_user_info_array = [];
        $sub_featured_random_user_info_array = [];
        foreach ($user_ads_main_category_array_random_featured as $main_category_ads_one) {
            foreach ($user_info_array as $user_info) {
                if ($user_info->id == $main_category_ads_one->user_id) {
                    $main_featured_random_user_info_array[] = $user_info->name;
                }
            }

        }
        //sub category user name
        foreach ($user_ads_sub_category_array_random_featured as $sub_category_ads_one) {
            foreach ($user_info_array as $user_info) {
                if ($user_info->id == $sub_category_ads_one->user_id) {
                    $sub_featured_random_user_info_array[] = $user_info->name;
                }
            }
        }


        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        //get main time info
        $main_category_ads_created_at_ago = [];

        foreach ($user_ads_main_category_array_random_featured as $main_category_one) {
            $main_category_created_at = date_create($main_category_one->created_at);
            $current_time = date_create($now); // current time replace
            $different_main_category_ads = date_diff($main_category_created_at, $current_time);
            // days ago
            if ($different_main_category_ads->format('%d') > 0) {

                if ($different_main_category_ads->format('%d') > 1) {
                    $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%d') . ' days ago';

                } else {
                    $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%d') . ' day ago';
                }
            } else
                //hours ago
                if ($different_main_category_ads->format('%h') > 0) {
                    if ($different_main_category_ads->format('%h') > 1) {
                        $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%h') . ' hours ago';

                    } else {
                        $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%h') . ' hour ago';
                    }
                } else
                    //minutes ago
                    if ($different_main_category_ads->format('%i') > 0) {
                        if ($different_main_category_ads->format('%i') > 1) {
                            $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%i') . ' minutes ago';

                        } else {
                            $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%i') . ' minute ago';
                        }
                    } else
                        //seconds ago
                        if ($different_main_category_ads->format('%s') > 0) {
                            if ($different_main_category_ads->format('%s') > 1) {
                                $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%s') . ' seconds ago';

                            } else {
                                $main_category_ads_created_at_ago[] = $different_main_category_ads->format('%d') . ' second ago';
                            }
                        }
//            print_r($main_category_one->id); echo ' ';
//            print_r($main_category_ads_created_at_ago);
//            echo '<br>';

        }
        //sub category created at
        $sub_category_ads_created_at_ago = [];

        foreach ($user_ads_sub_category_array_random_featured as $sub_category_one) {
            $sub_category_created_at = date_create($sub_category_one->created_at);
            $current_time = date_create($now); // current time replace
            $different_sub_category_ads = date_diff($sub_category_created_at, $current_time);
            // days ago
            if ($different_sub_category_ads->format('%d') > 0) {

                if ($different_sub_category_ads->format('%d') > 1) {
                    $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%d') . ' days ago';

                } else {
                    $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%d') . ' day ago';
                }
            } else
                //hours ago
                if ($different_sub_category_ads->format('%h') > 0) {
                    if ($different_sub_category_ads->format('%h') > 1) {
                        $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%h') . ' hours ago';

                    } else {
                        $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%h') . ' hour ago';
                    }
                } else
                    //minutes ago
                    if ($different_sub_category_ads->format('%i') > 0) {
                        if ($different_sub_category_ads->format('%i') > 1) {
                            $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%i') . ' minutes ago';

                        } else {
                            $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%i') . ' minute ago';
                        }
                    } else
                        //seconds ago
                        if ($different_sub_category_ads->format('%s') > 0) {
                            if ($different_sub_category_ads->format('%s') > 1) {
                                $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%s') . ' seconds ago';

                            } else {
                                $sub_category_ads_created_at_ago[] = $different_sub_category_ads->format('%d') . ' second ago';
                            }
                        }
//            print_r($main_category_one->id); echo ' ';
//            print_r($sub_category_ads_created_at_ago);
//            echo '<br>';

        }

        //main category random ads sub category name
        $main_category_random_sub_category_name_array = [];
        foreach ($user_ads_main_category_array_random_featured as $main_category_ads_one) {
            foreach ($categories as $category) {
                if ($category->id == $main_category_ads_one->category_id) {
                    $main_category_random_sub_category_name_array[] = $category->name;
                }
            }
        }

        //regular sub-category
        //get regular sub-category ads price, region, currency values.
        $ads_regular_image_array = [];
        $ads_regular_fields_values = [];
        $ads_regular_price = [];
        $ads_regular_currency = [];
        $ads_regular_region = [];
        $ads_regular_username_array = [];
        $ads_regular_created_ago_array = [];
        //job sub category type and category value
        $job_type_sub_regular = [];
        $job_category_sub_regular = [];
        $ads_regular_sub_title = [];
        $motors_sub_regular_name_array = []; $motors_regular_name_array_index = 0 ;

        //regular ads image and fields values
        foreach ($user_ads_sub_category_array_regular as $regular_one) {
            $ads_regular_image_array[] = DB::table('user_ads_images')->where('ads_id', $regular_one->id)->first();
            $ads_regular_fields_values[] = DB::table('post_fields_values')->where('post_id', $regular_one->id)->get();

            //regular ads user name
            foreach ($user_info_array as $user_info) {
                if ($user_info->id == $regular_one->user_id) {
                    $ads_regular_username_array[] = $user_info->name;
                }
            }
            //regular ads time ago start
            $ads_created_at = date_create($regular_one->created_at);
            $current_time = date_create($now); // current time replace
            $different_regular_ads = date_diff($ads_created_at, $current_time);
            // days ago
            if ($different_regular_ads->format('%d') > 0) {

                if ($different_regular_ads->format('%d') > 1) {
                    $ads_regular_created_ago_array[] = $different_regular_ads->format('%d') . ' days ago';

                } else {
                    $ads_regular_created_ago_array[] = $different_regular_ads->format('%d') . ' day ago';
                }
            } else
                //hours ago
                if ($different_regular_ads->format('%h') > 0) {
                    if ($different_regular_ads->format('%h') > 1) {
                        $ads_regular_created_ago_array[] = $different_regular_ads->format('%h') . ' hours ago';

                    } else {
                        $ads_regular_created_ago_array[] = $different_regular_ads->format('%h') . ' hour ago';
                    }
                } else
                    //minutes ago
                    if ($different_regular_ads->format('%i') > 0) {
                        if ($different_regular_ads->format('%i') > 1) {
                            $ads_regular_created_ago_array[] = $different_regular_ads->format('%i') . ' minutes ago';

                        } else {
                            $ads_regular_created_ago_array[] = $different_regular_ads->format('%i') . ' minute ago';
                        }
                    } else
                        //seconds ago
                        if ($different_regular_ads->format('%s') > 0) {
                            if ($different_regular_ads->format('%s') > 1) {
                                $ads_regular_created_ago_array[] = $different_regular_ads->format('%s') . ' seconds ago';

                            } else {
                                $ads_regular_created_ago_array[] = $different_regular_ads->format('%d') . ' second ago';
                            }
                        }
            //regular ads time ago end



        }

        //regular ads price, region, currency values
        foreach ($ads_regular_fields_values as $key => $ads_regular_field_value) {
//            print_r($ads_main_featured_field_value); echo '<br>';
            foreach ($ads_regular_field_value as $field_value_one) {
                if ($field_value_one->field_id == $items_fields_price_id)
                    $ads_regular_price[] = number_format($field_value_one->field_value) ;
                if ($field_value_one->field_id == $items_fields_currency_id)
                    $ads_regular_currency[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $items_fields_region_id)
                    $ads_regular_region[] = $field_value_one->field_value;

                //job values
                if ($field_value_one->field_id == $job_hire_fields_price_id || $field_value_one->field_id == $job_want_fields_price_id)
                    $ads_regular_price[] = number_format($field_value_one->field_value) ;
                if ($field_value_one->field_id == $job_hire_fields_currency_id || $field_value_one->field_id == $job_want_fields_currency_id)
                    $ads_regular_currency[] = $field_value_one->field_value;
                if ($field_value_one->field_id == $job_hire_fields_region_id || $field_value_one->field_id == $job_want_fields_region_id)
                    $ads_regular_region[] = $field_value_one->field_value;

                foreach($job_type_ids as $job_type_id){
                    if ($field_value_one->field_id == $job_type_id){
                        $ads_regular_sub_title[$key]['sub_title_1'] = $field_value_one->field_value;
                    }
                }
                foreach($job_category_ids as $job_category_id){
                    if ($field_value_one->field_id == $job_category_id){
                        $ads_regular_sub_title[$key]['sub_title_2'] = $field_value_one->field_value;
                    }
                }


                //regular category motors main name
                foreach($motors_fields_name_ids as $motors_main_name_id){
                    if ($field_value_one->field_id == $motors_main_name_id) {
                        $motors_sub_regular_name_array[$motors_regular_name_array_index][] = $field_value_one->field_value." ";
                    }

                }

                //sub category featured property subtitle
                foreach ($property_fields_ids_sub1 as $property_sub1_id){
                    if ($field_value_one->field_id == $property_sub1_id){
                        $ads_regular_sub_title[$key]['sub_title_1'][] = $field_value_one->field_value;
                    }
                }
                foreach ($property_fields_ids_sub2 as $property_sub2_id){
                    if ($field_value_one->field_id == $property_sub2_id){
                        $ads_regular_sub_title[$key]['sub_title_2'][] = $field_value_one->field_value;
                    }
                }
            }
            $motors_regular_name_array_index ++ ;
        }
//        print_r($ads_sub_featured_subtitle); echo '<br>';
//        print_r($ads_sub_featured_subtitle[0]); exit;
        return view('ads-view.ads-items-view', compact('category_id', 'main_categories',
            'categories', 'user_ads_main_category_array_random_featured', 'ads_main_featured_image_array',
            'ads_main_featured_price', 'ads_main_featured_currency', 'ads_main_featured_region',
            'user_ads_sub_category_array_random_featured', 'ads_sub_featured_image_array',
            'ads_sub_featured_price', 'ads_sub_featured_currency', 'ads_sub_featured_region',
            'main_featured_random_user_info_array', 'sub_featured_random_user_info_array',
            'main_category_ads_created_at_ago', 'sub_category_ads_created_at_ago',
            'main_category_random_sub_category_name_array',
            'user_ads_sub_category_array_regular', 'ads_regular_image_array', 'ads_regular_price',
            'ads_regular_currency', 'ads_regular_region', 'ads_regular_username_array', 'ads_regular_created_ago_array',
            'main_category_name', 'sub_category_name',
            'motors_main_featured_name_array', 'motors_sub_featured_name_array', 'motors_sub_regular_name_array',
            'ads_main_featured_subtitle', 'ads_sub_featured_subtitle', 'ads_regular_sub_title'));
    }
}
