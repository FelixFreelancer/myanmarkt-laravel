@extends('basic.master')

@section('content')
    <script type="text/javascript">
        jssor_1_slider_init = function () {

            var jssor_1_options = {
                $Idle: 2000,
                $SlideEasing: $Jease$.$InOutSine,
                $DragOrientation: 3,
                $SlideSpacing: 5,
                // $SlideWidth: 840,
                $AutoPlay: true,
                $AutoPlaySteps: 1,
                $PauseOnHover: 1,
                $Loop: 1,
                $ThumbnailNavigatorOptions: {

                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Loop: 2,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                    $AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Rows: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 0,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 1,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $Cols: 8,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 0,                            //[Optional] The offset position to park thumbnail
                    $Orientation: 2,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $NoDrag: false


                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            jssor_1_slider.$Elmt.style.margin = "";

            function ScaleSlider() {
                var parentWidth = jssor_1_slider.$Elmt.parentNode.clientWidth;
                // var parentHeight = jssor_1_slider.$Elmt.parentNode.clientHeight;
                if (parentWidth) {
                    var sliderWidth = parentWidth;
                    // var sliderHeight = parentHeight;
                    //keep the slider width no more than 840
                    sliderWidth = Math.min(sliderWidth, 740);
                    // sliderHeight = Math.min(sliderHeight, 400);
                    jssor_1_slider.$ScaleWidth(sliderWidth);
                    // jssor_1_slider.$ScaleHeight(sliderHeight);
                }
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            function OnOrientationChange() {
                ScaleSlider();
                window.setTimeout(ScaleSlider, 800);
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", OnOrientationChange);
        };
    </script>

    <div class="news-section">
        <div class="news-header">
            <div class="news-heahder-title">News</div>
            <div class="news-notification">
                <button class="notification-control" onclick="notifiControl();"><i class="fas fa-play"></i></button>
                <div class="notification-container">
                    <div class="notification-container-inner">
                        <ul class="notification-contents">
                            <marquee behavior="" direction="left" scrolldelay="100" height="100%">
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type first</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div style="display: inline-block;">type</div>
                                        <div style="display: inline-block;font-size: 12px;">value</div>
                                        <div style="display: inline-block;vertical-align: initial;width: 0;height: 0;border-style: solid;border-width: 10px 5px 0;border-color: #ff433d transparent transparent;"></div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value1
                                        </div>
                                        <div style="display: inline;padding: 2px 1px 1px;font-size: 12px;background-color: #ffe1e1;">
                                            value2
                                        </div>
                                    </a>
                                </li>
                            </marquee>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="news-header-weather">
                <div class="weather-content">
                    <div>
                        <div class="weather-today">Today</div>
                        <div class="weather-today-date">Fri, January 04</div>
                    </div>
                    <div class="weather-status-img">
                        <img src="http://cdn.apixu.com/weather/64x64/day/113.png" alt="">
                    </div>
                    <div>
                        <div class="weather-status">sunny</div>
                        <div class="weather-temperature">20°C</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-content " style="display: flex;  position:relative; top:0;left:0;width:100%;overflow:hidden; ">
            <div id="jssor_1"
                 style="min-width: 950px; position: relative;margin:0 auto;top:0px;left:0px;overflow:hidden;visibility:hidden;width: 1366px; height: 768px;">
                <div data-u="slides" id="v-pills-tabContent"
                     style="position:relative;margin:0 auto;top:0px;left:0px;width: 1366px; height: 768px;overflow:hidden;">
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/001.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/002.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <div data-u="thumb" class="i" style="transform: scale(1);">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/003.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/004.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/005.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <!--<img data-u="thumb" class="i" src="./assets/img/005-s96x48.jpg" />-->
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/006.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <!--<img data-u="thumb" class="i" src="./assets/img/005-s96x48.jpg" />-->
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/007.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <!--<img data-u="thumb" class="i" src="./assets/img/005-s96x48.jpg" />-->
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>
                    <div data-p="155">
                        <img data-u="image" src="./assets/img/008.jpg"/>
                        <div class="news-description">
                            <div class="news-title">
                                10th Marmi International Festival kicks off Saturday
                            </div>
                            <div class="news-abstract">
                                His Highness the Amir Sheikh Tamim bin Hamad al-Thani on Friday attended part of the
                                semifinal of the 27th edition of Qatar ExxonMobil Open
                            </div>
                        </div>
                        <div data-u="thumb">
                            <!--<img data-u="thumb" class="i" src="./assets/img/005-s96x48.jpg" />-->
                            <div data-u="thumb" class="i">
                                10th Marmi International Fest kicks off Saturday
                                <span class="ti"></span><br/>
                                <span class="d"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div u="thumbnavigator" class="jssort121-220-68" jssor-slider="true"
                     style="position: absolute; top: 0px; right: 0px;width: 210px; height: 472px; cursor: pointer; transform: scale(1);">
                    <!--transform-origin: 0px 0px 0px; transform: scale(1);-->
                    <div data-u="slides">
                        <div data-u="prototype" class="p" style="width:210px;height:51px;">
                            <div data-u="thumbnailtemplate" class="t">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-google-ads col">
                <div class="right-ads-text">google ads space</div>
            </div>
        </div>

    </div>
    <div class="classifieds-section">
        <div class="classified-title">Classifieds</div>
        <div class="classifieds-subTitle">Vehicles</div>
        <div class="row classifieds-sub-contents">
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
        </div>
        <div class="classifieds-subTitle">Properties for rent</div>
        <div class="row classifieds-sub-contents">
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
        </div>
        <div class="classifieds-subTitle">Properties for sale</div>
        <div class="row classifieds-sub-contents">
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
        </div>
        <div class="classifieds-subTitle">Items and Services</div>
        <div class="row classifieds-sub-contents">
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
            <div class="classifieds-sub-content-one">
                <a href="" class="classifieds-sub-contents-a">
                    <div class="classifieds-sub-contents-header">
                        <img src="./assets/img/lincoln.jpg"
                             alt="">
                        <span>Featured</span>
                        <div class="sub-contents-price">
                            <p>550,000</p>
                            <p>QAR</p>

                        </div>
                    </div>
                    <div class="classifieds-sub-contents-detail">
                        <p class="sub-contents-expert">Car/Sedan, Doha</p>
                        <p class="sub-contents-details">
                        <span class="sub-contents-details-model">Lamborghini Huracan LP610-4 <span
                                    class="sub-contents-details-year">2015</span> </span>
                        </p>
                        <p class="sub-contents-brief-details">2015 , 20,000 km </p>

                    </div>

                </a>
            </div>
        </div>
    </div>

    <div class="forum-events-section">
        <div class="row">
            <div class="">
                Forum
            </div>
            <div class="">
                <div class="row upcoming-events">
                    <div class="col-md-7 col-sm-12">Upcoming Events</div>
                    <div class="co1-md-3 col-sm-12">asdf</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jssor_1_slider_init();

    </script>
@endsection
