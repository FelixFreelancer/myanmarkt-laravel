<?php
/**
 * Created by PhpStorm.
 * User: RHH GO!
 * Date: 16/1/2019
 * Time: 6:05 AM
 */

namespace App\Helper;

use Illuminate\Support\Facades\DB;

class Layer2222Helper
{
    public static function getCurrentLayer($level)
    {
        if ($level % 1000000 == 0) {
            return 0;
        } elseif ($level % 10000 == 0) {
//            $level_parent = intdiv($level, 1000000);
//            $level_result = [1, $level_parent];
            return 1;
        } elseif ($level % 100 == 0) {
            return 2;
        } elseif ($level % 100 != 0) {
            return 3;
        }
    }
    public static function getParentLevel($level){
        if ($level % 1000000 == 0) {
            return 0;
        } elseif ($level % 10000 == 0) {
            return intdiv($level, 1000000)*1000000;
        } elseif ($level % 100 == 0) {
            return intdiv($level, 10000)*10000;
        } elseif ($level % 100 != 0) {
            return intdiv($level, 100)*100;
        }
    }
    public static function getParentLayer($level)
    {
        $currentLayer = Layer2222Helper::getCurrentLayer($level);
        $level = "$level";
        $parentCategories = [];
        if (strlen($level) != 8) {
            $level = "0" . $level;
        }
//        for( $i = 1 ; $i <= $currentLayer; $i++ ){
//            $parentLayer = substr($level,0, $i * 2) . str_repeat('0', (4 - $i) * 2);
//            $parentCategories[] = DB::select('select * from categories where level = ?', [$parentLayer]);
//        }
        $parentLayer = substr($level, 0, $currentLayer * 2) . str_repeat('0', (4 - $currentLayer) * 2);
//      $parentCategory = DB::select('select * from categories where level = ?', [$parentLayer]);

        $parentCategory = DB::table('categories')->where('level', intval($parentLayer))->first();
        //     return json_encode($parentCategory);
//        print_r(gettype($parentCategory)) ;
        //      print_r($parentCategory);exit;
        return $parentCategory;
    }

    public static function getNextLayer($level)
    {
        if ($level % 1000000 == 0) {
            return $level + 1000000;
        } elseif ($level % 10000 == 0) {
            return $level + 10000;
        } elseif ($level % 100 == 0) {
            return $level + 100;
        } elseif ($level % 100 != 0) {
            return $level + 1;
        }

    }

    public static function firstChildLevel($parentLevel)
    {
        if ($parentLevel % 1000000 == 0) {
            return $parentLevel + 10000;
        } elseif ($parentLevel % 10000 == 0) {
            return $parentLevel + 100;
        } else {
            return $parentLevel + 1;
        }
    }

    public static function getMainLayerLevel($level)
    {
        $main_layer_level = intdiv($level,1000000);
        $main_layer_level = $main_layer_level*1000000;
        return $main_layer_level;
    }
}