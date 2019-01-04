@extends('layouts.app')
@section('content')
    {{--<script>--}}
    {{--function postAdsInput(e) {--}}
    {{--alert(e.target.attr('current-category-id'));--}}
    {{--}--}}

    {{--</script>--}}
    <div id="desktop-wrapper" class="desktop">
        <div id="subcategory_content" class="">


            <div id="tax-container">
                <h2>Please choose a category for your ad</h2>

                <div id="tax-category-list">
                    <div id="tax-breadcrumbs-container">
                        <ul>

                            <li class="ss-navigatedown">
                                <a href="{{route('user.post.add')}}" class="breadcrumb">
                                    {{$parent_category->name}}
                                    <i class="fas fa-times"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                    {{--@php--}}
                    {{--$parent_category = $child_categories[0]->name;--}}
                    {{--@endphp--}}

                    <div id="tax-categories">
                        <ul class="">

                            <?php foreach ($child_categories as $key => $child_category) {
                                if (Layer2222::getParentLevel($child_category->level) == $parent_category->level) {
                                    if (key_exists($key + 1, $child_categories)) {
                                        if (Layer2222::getCurrentLayer($child_category->level) < Layer2222::getCurrentLayer($child_categories[$key + 1]->level)) {
                                            //have child category.php?level=
                                            echo ' <li>
                                                    <a href="/post-add/sub-category/' . $child_category->level . '" class="motor-category">
                                                        <span>' . $child_category->name . '</span>
                                                    </a>
                                                </li>';
                                        } else {
                                            //no child item.php?cat_i= href="/post-add/post-input/' . $child_category->id . '/' . $parent_category->level . '"


                                            echo ' <li>
                                                    <a  href="/post-add/post-input/' . $child_category->id . '/' . $parent_category->level . '"
                                                        id="' . $child_category->id . '" href="#" class="category-list">
                                                        <span>' . $child_category->name . '</span>
                                                    </a>

                                                </li>';

                                        }
                                    } else {
                                        //no child href="/post-add/post-input/' . $child_category->id . '/' . $parent_category->level . '"
                                        echo ' <li>
                                                    <a href="/post-add/post-input/' . $child_category->id . '/' . $parent_category->level . '"
                                                       id="' . $child_category->id . '"   class="category-list">
                                                        <span>' . $child_category->name . '</span>
                                                    </a>
                                                </li>';
                                    }

                                }
                            }
                            ?>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            {{--$(".category-list").on('click', function () {--}}
                {{--var category_id = ($(this).attr('id'));--}}

                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--}--}}
                {{--});--}}
                {{--$.post('{{route('user.post.input')}}', {--}}
                    {{--//PostAddInputController@index--}}
                    {{--category_id: category_id,--}}
                    {{--parent_category_level: '{{$parent_category->level}}',--}}
                {{--}, function (data) {--}}
                    {{--var required = "";--}}
                   {{--for(var i = 0 ; i < data.length ; i++){--}}
                       {{--if (data[i]['required'] == 1) {--}}
                           {{--required = "required"--}}
                       {{--}--}}
                       {{----}}
                   {{--}--}}
                {{--})--}}
            {{--})--}}
        })

    </script>
@endsection