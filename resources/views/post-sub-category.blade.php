@extends('layouts.app')
@section('content')
    <div id="desktop-wrapper" class="desktop">
        <div id="content" class="">


            <div id="tax-container">
                <h2>Please choose a category for your ad</h2>

                <div id="tax-category-list">
                    <div id="tax-breadcrumbs-container">
                        <ul>

                            <li class="ss-navigatedown">
                                <a href="{{route('user.post.add')}}" class="breadcrumb">
                                    {{$main_category->name}}
                                    <i class="fas fa-times"></i>
                                </a>
                            </li>
                            <li class="ss-navigatedown">
                                <a href="/post-add/{{$main_category->id}}" class="breadcrumb">
                                    {{$parent_category->name}}
                                     <i class="fas fa-times"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div id="tax-categories">
                        <ul class="">

                            <?php foreach ($child_categories as $key => $child_category) {
                                if (Layer2222::getParentLevel($child_category->level) == $parent_category->level) {
                                    if (key_exists($key + 1, $child_categories)) {
                                        if (Layer2222::getCurrentLayer($child_category->level) < Layer2222::getCurrentLayer($child_categories[$key + 1]->level)) {
                                            //have child category.php?level=
                                            echo ' <li>
                                                    <a  href="/post-add/sub-category/' . $child_category->level . '" class="motor-category"
                                                        style="background-color: #7C6085;">
                                                        <span>' . $child_category->name . '</span>
                                                    </a>
                                                </li>';
                                        } else {
                                            //no child item.php?cat_i=
                                            echo ' <li>
                                                    <a  href="/post-add/post-input/' . $child_category->id . '/'.$parent_category->level.'" class="motor-category"
                                                        style="background-color: #7C6085;">
                                                        <span>' . $child_category->name . '</span>
                                                    </a>
                                                </li>';
                                        }
                                    } else {
                                        //no child
                                        echo ' <li>
                                                    <a  href="/post-add/post-input/' . $child_category->id . '/'.$parent_category->level.'" class="motor-category"
                                                        style="background-color: #7C6085;">
                                                        <span>' . $child_category->name . '</span>
                                                    </a>
                                                </li>';
                                    }

                                }
                            }
                            ?>
                            {{--<li>--}}
                            {{--<a href="/post-add/{{$child_category->level}}/{{$child_category->name}}"--}}
                            {{--class="motor-category"--}}
                            {{--style="background-color: #7C6085;">--}}
                            {{--<span>{{$child_category->name}}--}}
                            {{--</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}

                            {{--<li>--}}
                            {{--<a href="/post-add/{{$parent_category->id}}/{{$child_category->name}}/{{$child_category->id}}"--}}
                            {{--class="motor-category"--}}
                            {{--style="background-color: #7C6085;">--}}
                            {{--<span>{{$child_category->name}}--}}
                            {{--</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}

                            {{--@php(exit)--}}
                            {{--<li>--}}
                            {{--<a id="suv" href="javascript:void(0);" class="motor-category"--}}
                            {{--style="background-color: rgb(111, 86, 119);"--}}
                            {{-->--}}
                            {{--<span>Cars – 4x4/SUV</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}

                            {{--<li>--}}
                            {{--<a id="motorcycle" href="javascript:void(0);" class="motor-category"--}}
                            {{--style="background-color: rgb(99, 77, 107);"  >--}}
                            {{--<span>Motorcycle</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}

                            {{--<li>--}}
                            {{--<a id="boats" href="" class="motor-category"--}}
                            {{--style="background-color: rgb(89, 69, 96);"--}}
                            {{-->--}}
                            {{--<span>Boats</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}

                            {{--<li>--}}
                            {{--<a id="heavy-vehicle"  class="motor-category" href=""--}}
                            {{--style="background-color: rgb(80, 62, 86);"--}}
                            {{-->--}}
                            {{--<span>Heavy Vehicle</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a id="accessories-parts" class="motor-category" href=""--}}
                            {{--style="background-color: rgb(72, 55, 77);" >--}}
                            {{--<span>Auto Accessories &amp; Parts</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // $(document).ready(function () {
        //     $('.motor-category').each(function (e) {
        //         $(this).click(function (e) {
        //             // e.preventDefault();
        //             var id = $(this).attr('id');
        //             $(this).attr('href', '/post-add/motors/'+id);
        //         })
        //     });
        // })


    </script>
@endsection