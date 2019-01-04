@extends('admin.basic')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/categories') !!}" class="btn btn-default btn-back"><i
                                    class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Add Category</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div id="response"></div>
                        {{--action="{!! action('ChildCategoryController@store') !!}"--}}
                        <form method="post" class="form-horizontal form-label-left">
                            {{csrf_field()}}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Select Category<span
                                            class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="mainid"
                                            id="maincats">
                                        <option value="">Select parent Category</option>
                                        @foreach($categories as $category)
                                            <?php
                                            $prefix = "";
                                            for ($i = 0; $i < Layer2222::getCurrentLayer($category->level); $i++) {
                                                $prefix .= "----";
                                            }
                                            ?>
                                            <option value="{{$category->level}}">{{$prefix.$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <p style="margin: 5px; color: red;">If you want to add the main category, please
                                        don't select it.</p>
                                </div>
                            </div>
                            <input type="hidden" id="selected_category_level" name="level">
                            <input type="hidden" id="input_fields_data" name="input_fields_data">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Display
                                    Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name"
                                           placeholder="e.g Mens Clothing" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order_number">
                                    Category Order
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="order_number" class="form-control col-md-7 col-xs-12" name="order_number"
                                           placeholder="2" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Category URL
                                    Slug<span class="required">*</span>
                                    <p class="small-label">(In English Must be Unique)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="slug" class="form-control col-md-7 col-xs-12" name="slug"
                                           placeholder="e.g mens-clothing" type="text">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" id="add_category_btn" class="btn btn-success btn-block">Add
                                        Category
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    {{--------------------------------------}}
    {{--------admin form builder  ----------------}}
    {{--------------------------------------}}



    {{--------------------------------------}}
    {{--------admin form builder  ----------------}}
    {{--------------------------------------}}
    {{--<div class="form-group" style="margin-bottom: 100px;">--}}
        {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--<button type="button" id="add_category_btn" class="btn btn-success btn-block">Add--}}
                {{--Category--}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--admin category add modal--}}
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();

            //select parent category or main category add
            $('#maincats').change(function () {
                var category_level = $('#maincats').val();
                $('#selected_category_level').val(category_level);

            })

            $('#add_category_btn').click(function (e) {
                //add new category
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('/admin/categories/add', {
                    name: $('#name').val(),
                    level: $('#maincats').val(),
                    order: $('#order_number').val()
                }, function (data) {
                    if (data == 0) {
                        window.location.href = '/admin/categories';
                    }
                })
            })
        })
    </script>
@endsection

