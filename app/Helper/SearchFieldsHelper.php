<?php
/**
 * Created by PhpStorm.
 * User: RHH GO!
 * Date: 2/22/2019
 * Time: 3:54 PM
 */

namespace App\Helper;
use Illuminate\Support\Facades\DB;


class SearchFieldsHelper
{
    public static function searchFields($main_category)
    {
        $search_fields = DB::table('categories_fields')->where([['category_id', $main_category],
            ['search_required', 1]])->get();
        $motors_search_year = [];
        $motors_search_mieage = [];
        $motors_search_engine = [];

        foreach ($search_fields as $key => $search_field){
            if ($search_field->label == "Job type"){
                $search_fields[$key]->options = ['Full Time', 'Part Time', 'Internship', 'Temporary'] ;
            }
            if ($search_field->label == "Job type") {
                $search_fields[$key]->options = ['Accounting', 'Airlines & Aviation', 'Architecture & Interior Design', 'Art & Entertainment',
                    'Automotive', 'Banking & Finance', 'Beauty', 'Business Development', 'Business Supplies & Equipment', 'Construction',
                    'Consulting', 'Customer Service', 'Education', 'Engineering', 'Environmental Services', 'Event Management', 'Executive', 'Fashion', 'Food & Beverages', 'Government / Administration', 'Graphic Design', 'Hospitality & Restaurants', 'HR & Recruitment', 'Import & Export',
                    'Industrial & Manufacturing', 'Information Technology', 'Insurance', 'Internet', 'Legal Services', 'Logistics & Distribution'
                    , 'Marketing & Advertising', 'Media', 'Medical & Healthcare', 'Oil, Gas & Energy', 'Online Media', 'Online Media', 'Pharmaceuticals'
                    , 'Public Relations', 'Real Estate', 'Research & Development', 'Retail & Consumer Goods', 'Safety & Security', 'Sales',
                    'Secretarial', 'Sports & Fitness', 'Telecommunications', 'Transportation', 'Travel & Tourism', 'Veterinary & Animals',
                    'Warehousing', 'Wholesale', 'Other'];
            }
            if ($search_field->label == "Year"){
                $search_fields[$key]->options  = ["2019 or newer", "2018 or newer", "2017 or newer", "2016 or newer",
                    "2015 or newer", "older"];
            }
            if ($search_field->label == "Mileage (in km)"){
                $search_fields[$key]->options = ["10,000km or less", "20,000km or less", "30,000km or less", "40,000km or less",
                    "50,000km or less", "any mileage"];
            }
            if ($search_field->label == "Engine size (e.g. 1.6 or 2.0)") {
                $search_fields[$key]->options = ["2.0L or less", "2.1L to 3.0L", "3.1L and more"];
            }

        }
        return $search_fields;


    }
}