@extends('layouts.app')

@section ('content')
    <div id="desktop-wrapper" class="desktop">
        <div id="main-category-content" class="">

        <!-- Content Container -->
            <div id="pick-a-category-overlay" class="overlay-shade"></div>
            <div id="container" class="cf">
                <!-- Classifier message -->
                <div id="header_title" class="span12">
                    <h2 class="listing-question">What are you listing?</h2>
                    <h3 class="pre-select-cat">Please select which category your ad fits into</h3>
                </div>
                {{--<form method="post" action="">--}}
                {{--{{csrf_field()}}--}}
                <?php
                $categories_icons = ['fa-sitemap', 'fa-user-tie', 'fa-car', 'fa-concierge-bell', 'fa-home', 'fa-home', 'fa-calendar-week', 'fa-users',  'fa-home'];
                $index = 0;
                $rent_or_sale = "";
                ?>
                <div id="pre-classifier-container">
                    @foreach($main_categories as $key => $main_category)

                        <a class="motors section-box" href="/post-add/{{$main_category->id}}">
                            <i class="fas {{$categories_icons[$index]}}"></i>
                            <?php
                                if ($main_category->name == "Real Estate (for rent)" || $main_category->name == "Real Estate (for sale)"){
                                    $rent_or_sale = "(for sale)";
                                    if ($main_category->name == "Real Estate (for rent)") $rent_or_sale = "(for rent)";
                                    echo '<h3>Real Estate <br> '.$rent_or_sale.' </h3>' ;
                                }else{
                            ?>
                            <h3>{{$main_category->name}}</h3>
                        </a>
                        <?php
                        }
                        $rent_or_sale = "";
                        $index++;
                        ?>
                    @endforeach

                    {{--<div class="jobs section-box" onclick="showJob();">--}}
                        {{--<a id="job_section" style="display: block;">--}}
                            {{--<i class="fas fa-car"></i>--}}
                            {{--<h3>Jobs</h3>--}}
                        {{--</a>--}}
                        {{--<span id="job_style" class="split-view" >--}}
                            {{--<a href="/post-add/jobs/" class="jobs split-view">--}}
                                {{--<h3 class="pre-title-split">I'm hiring</h3>--}}
                                {{--<span class="pre-icons-split half-splitter"></span>--}}
                            {{--</a>--}}
                            {{--<a href="/post-add/jobs-wanted/" class="jobs split-view">--}}
                                {{--<h3 class="pre-title-split">I want a job</h3>--}}
                                {{--<span class="pre-icons-split half-splitter"></span>--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                    {{--<a class="services section-box" href="/post-add/services">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Services</h3>--}}
                    {{--</a>--}}
                    {{--<a class="items section-box" href="/post-add/items">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Items</h3>--}}
                    {{--</a>--}}
                    {{--<a class="property-for-sale section-box" href="/post-add/property-sale">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Property for Sale</h3>--}}
                    {{--</a>--}}
                    {{--<a class="property-for-rent section-box" href="/post-add/property-rent">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Property for Rent</h3>--}}
                    {{--</a>--}}
                    {{--<a class="events section-box" href="/post-add/events">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Events</h3>--}}
                    {{--</a>--}}
                    {{--<a class="forum section-box" href="/post-add/forum">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Forum</h3>--}}
                    {{--</a>--}}
                    {{--<a class="other section-box" href="/post-add/other">--}}
                    {{--<i class="fas fa-car"></i>--}}
                    {{--<h3>Other</h3>--}}
                    {{--</a>--}}


                </div>
                {{--</form>--}}
            </div>

        </div>
    </div>
    <script>
        function showJob() {
            // $('#job_section').css('display', 'none');
            $('#job_style').css('display', 'block');

        }
        var job_style = document.getElementById('job_style');
        window.onclick = function(event) {
            if (event.target == job_style) {
                $('#job_style').css('display', 'none');

            }
        }

    </script>
@endsection