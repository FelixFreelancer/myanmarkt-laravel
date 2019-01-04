@extends('basic.master')

@section('content')
    <link rel="stylesheet" href="{{URL::asset('/assets/css/ads-style.css')}}">
    <div class="ads-section row">
        <div class="ads-section-left col-md-2">
            <div class="ads-search-box ads-left-margin-top">
                <div class="search-time">
                    <select name="" id="search_time_order" class="full-width border-style font-size-14">
                        <option value="0">Most recent first</option>
                        <option value="1">Price: Low to High</option>
                        <option value="1">Price: High to Low</option>
                    </select>
                </div>
                <div class="search-text">Search</div>
                <input class="padding-left-4 input-search-keyword full-width border-style font-size-14" id="search_keyword"
                       placeholder="Keyword search">
                <?php
                $locations_array = ['Yangon Region', 'Mandalay Region', 'Magway Region', 'Naypyidaw Union Territory'
                    , 'Kayah State', 'Shan State', 'Ayeyarwady Region', 'Bago Region', 'Kachin State',
                    'Sagaing Region', 'Kayin State', 'Mon State', 'Tanintharyi Region', 'Chin State',
                    'Rakhine State', 'All Regions'];
                ?>
                <select name="" id="search_region" class="font-size-14 search-region full-width border-radius border-style">
                    <option value="0">All regions</option>
                    @foreach($locations_array as $location_array)
                        <option value="{{$location_array}}">{{$location_array}}</option>
                    @endforeach
                </select>
                <select name="" id="search_main_category" onchange="changeMainCategory()"
                        class="font-size-14 search-main-category full-width border-style border-radius">
                    @php($main_category_index = 0)
                    @php($selected = "")
                    @foreach($main_categories as $main_category)
                        <?php

                        if ($main_category->id == $main_category_name->id) $selected = "selected"
                        ?>
                        <option value="{{$main_category->id}}" {{$selected}}>{{$main_category->name}}</option>
                        @php($main_category_index++)
                        @php($selected = "")
                    @endforeach
                </select>
                <select name="" id="search_sub_category"
                        class="font-size-14 search-sub-category full-width border-style border-radius">
                    <?php

                    foreach ($categories as $category) {
                        $category_level = Layer2222::getMainLayerLevel($category->level);
                        if ($main_category_name->level == $category_level) {
                            if ($category->id == $sub_category_name->id) $selected = "selected";
                            echo '<option value="' . $category->id . '" ' . $selected . '>' . $category->name . '</option>';
                        }
                        $selected = "";
                    }

                    ?>
                </select>
                <?php
                //                    $search_fields = SearchFields::searchFields($main_category_name->id);
                //
                //                    foreach($search_fields as $search_field){
                ////                        print_r($search_field); echo '<br>';
                //                        echo '<select name="search_'.$search_field->id.'"  class="full-width border-style">';
                //                        echo '<option>'.$search_field->label.'</option>';
                //                        if (isset($search_field->options)){
                //                            foreach ($search_field->options as $option){
                //                                echo '<option value="'.$option.'">'.$option.'</option>';
                //                            }
                //
                //                        }
                //                        echo '</select>';
                //                    }
                //                    exit;
                ?>

                {{--search depending on category--}}
                <div class="font-size-14 search-price full-width">
                    <div class="search-price-usd">Price (USD)</div>
                    <div class="search-price-value ">
                        {{--validation for only number--}}
                        <input type="text" id="price-from" class="padding-left-4 font-size-14 border-style" placeholder="From">
                        <div class="input-spacing">-</div>
                        <input type="text" id="price-to" class="padding-left-4 font-size-14 border-style" placeholder="To">
                    </div>
                </div>
                <button class="search-button">Search</button>
            </div>
            <div class="ads-google-ads ads-left-margin-top">google ads space</div>
        </div>
        <?php
        $bedrooms_bathrooms_icons= ["fa-bed","fas fa-bath"];
        ?>
        <div class="ads-section-right col-md-10">
            <div class="ads-featured-subcategory">
                <div class="ads-featured-title">
                    Featured {{$sub_category_name->name}}
                </div>
                <div class="ads-featured-content">
                    <?php

                    ?>
                    @if( !sizeof($user_ads_sub_category_array_random_featured) > 0)
                        <div class="ads-featured-column-one featured-ads-coming-soon">
                            <div class="ads-featured-one ">
                                Coming soon
                            </div>
                        </div>
                    @else

                        @foreach($user_ads_sub_category_array_random_featured as $key => $sub_category_ads_one)
                                <input type="hidden" value="{{$sub_category_ads_one->id}}">
                            <div class="ads-featured-column-one">
                                <div class="ads-featured-one ">
                                    <div class="b-card--el-header">
                                        <a href="javascript:void(0);">
                                            <div class="b-card--el-view img-responsive"
                                                 style="background-image: url('http://localhost:8080/upload/{{$ads_sub_featured_image_array[$key]->ads_image}}');"
                                            >
                                            </div>
                                            {{--<img class="b-card--el-view img-responsive"--}}
                                                {{--src = 'https://myanmarkt.com/upload/{{$ads_sub_featured_image_array[$key]->ads_image}}'--}}
                                            {{-->--}}

                                            <span class="b-card--el-featured-label">Featured</span>
                                            <div class="ads-card-footer">
                                                <div class="b-card--el-vehicle-price">{{isset($ads_sub_featured_price[$key])? $ads_sub_featured_price[$key] : '' }}
                                                    <br>
                                                    <span>{{isset($ads_sub_featured_currency[$key])? $ads_sub_featured_currency[$key] : ''}}</span>
                                                </div>
                                                <div class="card-footer-logo">
                                                    LOGO
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    <div class="b-card--el-details">
                                        <div class="b-ad-excerpt-header">
                                            <!--<sapn class="b-ad-excerpt b-par-mod-clear b-line-mod-thin--mix-vehicle">-->
                                        <!--    {{$main_category_name->name}} >-->
                                            <!--</sapn>-->
                                            <span>{{$sub_category_name->name}}, </span>
                                            <span>{{$ads_sub_featured_region[$key]}}</span>
                                            <span class="span-heart"><i class="far fa-heart"></i></span>
                                        </div>

                                        <a href="javascript:void(0);" class="b-card--el-brand">
                                            {{--<p class="b-card--el-description">{{$sub_category_ads_one->ads_main_name}}</p>--}}
                                            <p class="b-card--el-description">
                                                <?php
                                                if (isset($motors_sub_featured_name_array) && (sizeof($motors_sub_featured_name_array) > 0)){
                                                    foreach ($motors_sub_featured_name_array[$key] as $motors_sub_featured_name_string ) {
                                                        echo $motors_sub_featured_name_string;
                                                    }
                                                }else{
                                                    print_r($sub_category_ads_one->ads_main_name);
                                                }
//                                                ?>
                                                {{--{{? $motors_main_featured_name_array[$key][0] : }}--}}
                                            </p>
                                        </a>

                                        <p  class="b-card--el-brief-details">
                                            <?php
                                                if (isset($ads_sub_featured_subtitle[$key]['sub_title_1'])){
                                                    if (gettype($ads_sub_featured_subtitle[$key]['sub_title_1']) == "array"){
                                                        foreach ($ads_sub_featured_subtitle[$key]['sub_title_1'] as $ads_sub_title_1){
                                                                print_r ($ads_sub_title_1); echo " ";
                                                        }
                                                    }else{
                                                         print_r($ads_sub_featured_subtitle[$key]['sub_title_1']);
                                                    }
                                                }

                                            if (isset($ads_sub_featured_subtitle[$key]['sub_title_2'])){
                                                if (gettype($ads_sub_featured_subtitle[$key]['sub_title_2']) == "array"){
                                                    echo ", ";
                                                    foreach ($ads_sub_featured_subtitle[$key]['sub_title_2'] as $sub_key => $ads_sub_title_2){
                                                        echo '<i class="fas '.$bedrooms_bathrooms_icons[$sub_key].'"></i> ';
                                                        print_r($ads_sub_title_2); echo " ";
                                                    }
                                                }else{
                                                   echo ", ";  print_r($ads_sub_featured_subtitle[$key]['sub_title_2']);
                                                }

                                            }
                                            ?>

                                        </p>
                                        <p  class="b-card--el-brief-details">
                                            <?php
//                                                if (isset($ads_sub_featured_subtitle[$key]['sub_title_2'])){
//                                                    if (gettype($ads_sub_featured_subtitle[$key]['sub_title_2']) == "array"){
//                                                        foreach ($ads_sub_featured_subtitle[$key]['sub_title_2'] as $sub_key => $ads_sub_title_2){
//                                                            echo '<i class="fas '.$bedrooms_bathrooms_icons[$sub_key].'"></i> ';
//                                                            print_r($ads_sub_title_2); echo " ";
//                                                        }
//                                                    }else{
//                                                        print_r($ads_sub_featured_subtitle[$key]['sub_title_2']);
//                                                    }
//
//                                                }
                                            ?>
                                        </p>


                                    </div>
                                </div>
                                <div class="b-card--el-agency">
                                    {{--<a href="#">--}}
                                    {{--<img src="https://myanmarkt.com/upload/user-temp.png" alt=""--}}
                                    {{--class="b-card--el-agency-logo">--}}
                                    {{--</a>--}}
                                    <div class="b-card--el-agency-info">
                                        <span class="b-card--el-agency-time">about {{$sub_category_ads_created_at_ago[$key]}}</span>
                                        <span class="b-card--el-agency-title">by</span>
                                        <span><a href=""
                                                 class="b-card--el-agency-title">{{$sub_featured_random_user_info_array[$key]}}</a></span>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            {{--main featured ads--}}
            <div class="ads-featured-mainCategory">
                <div class="ads-featured-title">
                    Featured {{$main_category_name->name}}
                </div>

                <div class="ads-featured-content">
                    @if( !sizeof($user_ads_main_category_array_random_featured) > 0)
                        <div class="ads-featured-column-one featured-ads-coming-soon">
                            <div class="ads-featured-one ">
                                Coming soon
                            </div>
                        </div>
                    @else
                        @foreach($user_ads_main_category_array_random_featured as $key => $main_category_ads_one)
                            <input type="hidden" value="{{$main_category_ads_one->id}}">
                            <div class="ads-featured-column-one">
                                <div class="ads-featured-one ">
                                    <div class="b-card--el-header">
                                        <a href="javascript:void(0);">
                                            <div class="b-card--el-view img-responsive"
                                                 style="background-image: url('http://localhost:8080/upload/{{$ads_main_featured_image_array[$key]->ads_image}}');"
                                            >
                                            </div>

                                            {{--<img class="b-card--el-view img-responsive"--}}
                                                 {{--src='https://myanmarkt.com/upload/{{$ads_main_featured_image_array[$key]->ads_image}}'>--}}


                                            <span class="b-card--el-featured-label">Featured</span>
                                            <div class="ads-card-footer">
                                                <div class="b-card--el-vehicle-price">{{isset($ads_main_featured_price[$key])? $ads_main_featured_price[$key]: ''}}
                                                    <br>
                                                    <span>{{isset($ads_main_featured_currency[$key]) ? $ads_main_featured_currency[$key] : ''}}</span>
                                                </div>
                                                <div class="card-footer-logo">
                                                    LOGO
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    <div class="b-card--el-details">
                                        <div class="b-ad-excerpt-header">
                                            <!--<sapn class="b-ad-excerpt b-par-mod-clear b-line-mod-thin--mix-vehicle">-->
                                        <!--    {{$main_category_name->name}} >-->
                                            <!--</sapn>-->
                                            <span>{{$main_category_random_sub_category_name_array[$key]}}, </span>
                                            <span>{{$ads_main_featured_region[$key]}}</span>
                                            <span class="span-heart"><i class="far fa-heart"></i></span>
                                        </div>

                                        <a href="javascript:void(0);" class="b-card--el-brand">
                                            <p class="b-card--el-description">
                                                <?php
                                                    if (isset($motors_main_featured_name_array) && (sizeof($motors_main_featured_name_array) > 0)){
                                                        foreach ($motors_main_featured_name_array[$key] as $motors_main_featured_name_string ) {
                                                            echo $motors_main_featured_name_string;
                                                        }
                                                    }else{
                                                        print_r($main_category_ads_one->ads_main_name);
                                                    }
                                                ?>
                                                {{--{{? $motors_main_featured_name_array[$key][0] : }}--}}
                                            </p>
                                        </a>
                                        <p  class="b-card--el-brief-details">
                                            <?php
                                            if (isset($ads_main_featured_subtitle[$key]['sub_title_1'])){

                                                if (gettype($ads_main_featured_subtitle[$key]['sub_title_1']) == "array"){
                                                    foreach ($ads_main_featured_subtitle[$key]['sub_title_1'] as $ads_sub_title_1){
                                                        print_r($ads_sub_title_1); echo " ";
                                                    }
                                                }else{
                                                    print_r($ads_main_featured_subtitle[$key]['sub_title_1']);
                                                }

                                            }
                                        if (isset($ads_main_featured_subtitle[$key]['sub_title_2'])){
                                            if (gettype($ads_main_featured_subtitle[$key]['sub_title_2']) == "array"){
                                                echo ", ";
                                                foreach ($ads_main_featured_subtitle[$key]['sub_title_2'] as $sub_key => $ads_sub_title_2){
                                                    echo '<i class="fas '.$bedrooms_bathrooms_icons[$sub_key].'"></i> ';
                                                    print_r($ads_sub_title_2); echo " ";
                                                }
                                            }else{
                                               echo ", ";  print_r($ads_main_featured_subtitle[$key]['sub_title_2']);
                                            }
                                        }
                                            ?>
                                        <p  class="b-card--el-brief-details">
                                            <?php

//                                            if (isset($ads_main_featured_subtitle[$key]['sub_title_2'])){
//                                                if (gettype($ads_main_featured_subtitle[$key]['sub_title_2']) == "array"){
//                                                    foreach ($ads_main_featured_subtitle[$key]['sub_title_2'] as $sub_key => $ads_sub_title_2){
//                                                        echo '<i class="fas '.$bedrooms_bathrooms_icons[$sub_key].'"></i> ';
//                                                        print_r($ads_sub_title_2); echo " ";
//                                                    }
//                                                }else{
//                                                    print_r($ads_main_featured_subtitle[$key]['sub_title_2']);
//                                                }
//                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="b-card--el-agency">
                                    {{--<a href="#">--}}
                                    {{--<img src="https://myanmarkt.com/upload/user-temp.png" alt=""--}}
                                    {{--class="b-card--el-agency-logo">--}}
                                    {{--</a>--}}
                                    <div class="b-card--el-agency-info">
                                        <span class="b-card--el-agency-time">about {{$main_category_ads_created_at_ago[$key]}}</span>
                                        <span class="b-card--el-agency-title">by</span>
                                        <span><a href="javascript:void(0);"
                                                 class="b-card--el-agency-title">{{$main_featured_random_user_info_array[$key]}}</a></span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <?php
//                print_r($job_type_category_main_featured) ;exit;

            ?>

            <div class="ads-list">
                <div class="ads-list-title ads-featured-title">
                    Ads
                </div>
                {{-- <div class="ads-list-google-ads">
                                google ads space
                            </div>--}}
                <div class="ads-list-section">
                    @if( !sizeof($user_ads_sub_category_array_regular) > 0)

                        <div class="ads-list-column-one ads-coming-soon">
                            <div class=" ads-list-one featured-ads-coming-soon">
                                Coming Soon
                            </div>
                        </div>
                    @else
                        <div class="ads-list-container">
                            <?php
                            $ads_regular_sold_class = "";

                            ?>
                            @foreach($user_ads_sub_category_array_regular as $key => $regular_ads_one)
                                    <input type="hidden" value="{{$regular_ads_one->id}}">
                                <?php
                                if ($regular_ads_one->ads_type == 3)
                                    $ads_regular_sold_class = "ads-regular-sold";
                                if ($regular_ads_one->ads_type == 2)
                                    $ads_regular_sold_class = "ads-regular";


                                ?>
                                <div class="ads-list-column-one">
                                    <div class=" ads-list-one ">
                                        <div class="b-card--el-header">
                                            <a href="javascript:void(0);">
                                                <img class="ads-list-b-card--el-view img-responsive"
                                              src="http://localhost:8080/upload/{{$ads_regular_image_array[$key]->ads_image}}"
                                                   alt="">
                                                {{--<div class="ads-list-b-card--el-view img-responsive" --}}
                                                     {{--style="--}}
                                                        {{--background-image:url('https://myanmarkt.com/upload/{{$ads_regular_image_array[$key]->ads_image}}')">--}}
                                                {{--</div>--}}
                                                <span class="{{$ads_regular_sold_class}}  b-card--el-featured-label promoted-label">
                                                    {{$regular_ads_one->ads_type_label}}</span>
                                                <div class="ads-card-footer">
                                                    <div class="{{$ads_regular_sold_class}}  b-card--el-vehicle-price ">{{isset($ads_regular_price[$key]) ? $ads_regular_price[$key] : ''}}
                                                        <br>
                                                        <span>{{isset($ads_regular_currency[$key])? $ads_regular_currency[$key] : ''}}</span>
                                                    </div>
                                                    <div class="card-footer-logo">
                                                        LOGO
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                        <div class="ads-list-b-card--el-details">
                                            <div class="b-ad-excerpt-header">
                                                <!--<sapn class="b-ad-excerpt b-par-mod-clear b-line-mod-thin--mix-vehicle">-->
                                            <!--    {{$main_category_name->name}} >-->
                                                <!--</sapn>-->
                                                <span>{{$sub_category_name->name}}, </span>
                                                <span>{{$ads_regular_region[$key]}}</span>
                                                <span class="span-heart"><i class="far fa-heart"></i></span>
                                            </div>

                                            <a href="javascript:void(0);" class="b-card--el-brand">
                                                <p class=" {{$ads_regular_sold_class}}  b-card--el-description">
                                                    <?php
                                                    if (isset($motors_sub_regular_name_array) && (sizeof($motors_sub_regular_name_array) > 0)){
                                                        foreach ($motors_sub_regular_name_array[$key] as $motors_sub_regular_name_string ) {
                                                            echo $motors_sub_regular_name_string;
                                                        }
                                                    }else{
                                                        print_r($regular_ads_one->ads_main_name);
                                                    }
                                                    ?>
                                                </p>
                                            </a>
                                            <p  class="{{$ads_regular_sold_class}} b-card--el-brief-details">
                                                <?php
                                                if (isset($ads_regular_sub_title[$key]['sub_title_1'])){
                                                    if (gettype($ads_regular_sub_title[$key]['sub_title_1']) == "array"){
                                                        foreach ($ads_regular_sub_title[$key]['sub_title_1'] as $ads_sub_title_1){
                                                            print_r($ads_sub_title_1); echo " ";
                                                        }
                                                    }else{
                                                        print_r($ads_regular_sub_title[$key]['sub_title_1']);
                                                    }

                                                }

                                                if (isset($ads_regular_sub_title[$key]['sub_title_2'])){
                                                    if (gettype($ads_regular_sub_title[$key]['sub_title_2']) == "array"){
                                                        echo ",";
                                                        foreach ($ads_regular_sub_title[$key]['sub_title_2'] as $sub_key => $ads_sub_title_2){
                                                            echo '<i class="fas '.$bedrooms_bathrooms_icons[$sub_key].'"></i> ';
                                                            print_r($ads_sub_title_2); echo " ";
                                                        }
                                                    }else{
                                                       echo ", ";  print_r($ads_regular_sub_title[$key]['sub_title_2']);
                                                    }

                                                }
                                                ?>

                                            </p>
                                            <p  class="{{$ads_regular_sold_class}} b-card--el-brief-details">
                                                <?php
//                                                if (isset($ads_regular_sub_title[$key]['sub_title_2'])){
//                                                    if (gettype($ads_regular_sub_title[$key]['sub_title_2']) == "array"){
//                                                        foreach ($ads_regular_sub_title[$key]['sub_title_2'] as $sub_key => $ads_sub_title_2){
//                                                            echo '<i class="fas '.$bedrooms_bathrooms_icons[$sub_key].'"></i> ';
//                                                            print_r($ads_sub_title_2); echo " ";
//                                                        }
//                                                    }else{
//                                                        print_r($ads_regular_sub_title[$key]['sub_title_2']);
//                                                    }
//
//                                                }
                                                ?>
                                            </p>

                                            <div class="ads-list-b-card--el-agency-info">
                                                {{--<a href="">--}}
                                                {{--<img src="http://localhost:8080/upload/user-temp.png" alt="" class="b-card--el-agency-logo">--}}
                                                {{--<img src="https://myanmarkt.com/upload/user-temp.png" alt=""--}}
                                                {{--class="b-card--el-agency-logo">--}}
                                                {{--</a>--}}
                                                <div class="b-card--el-agency-info">
                                                    <span class="b-card--el-agency-time">about {{$ads_regular_created_ago_array[$key]}}</span>
                                                    <span class="b-card--el-agency-title">by</span>
                                                    <span><a href=""
                                                             class="b-card--el-agency-title">&nbsp; {{$ads_regular_username_array[$key]}}</a></span>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $ads_regular_sold_class = "" ;

                                    ?>
                                </div>

                            @endforeach
                        </div>
                    @endif
                    <div class="ads-list-google-ads">
                        google ads space
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection

@section('footer')
    <script>
        function changeMainCategory(){
            var categories = <?php echo $categories; ?> ;
            var main_category_level = 0;
            var category_level = 0;
            var sub_category_id = 0;
            $.each(categories,  function (index, category) {

                if (category.id == $('#search_main_category').val()) {
                    main_category_level = category.level
                }
                category_level = Math.floor(category.level/1000000);
                category_level = category_level*1000000
                if (main_category_level == category_level){
                    if (category.id != $('#search_main_category').val()){
                        sub_category_id = category.id;
                        return false
                    }
                }
            })
            // console.log(sub_category_id)
            window.location.href = "/category/"+$('#search_main_category').val()+"/"+sub_category_id
        }

        $('#search_sub_category').change(function () {
            window.location.href = "/category/"+$('#search_main_category').val()+"/"+$(this).val()

        })
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     })
        //     $.post('/sub-category', {
        //         //PostAddInputController@postDataSubmit
        //         main_category_id: $('#search_main_category').val()
        //         //post_image_category
        //     }, function (data) {
        //         if (data == 0) {
        //             location.reload();
        //         }
        //     })
        // })
    </script>
@endsection