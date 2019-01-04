@extends('admin.basic')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Categories</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="res">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.start -->
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#maincat" data-toggle="tab" aria-expanded="false"><strong>Main
                                            Category</strong></a>
                                {{--<li><a href="#subcat" data-toggle="tab" aria-expanded="true"><strong>Sub Category</strong></a>--}}
                                {{--<li><a href="#childcat" data-toggle="tab" aria-expanded="true"><strong>Child Category</strong></a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>

                        <div class="col-xs-12" style="padding: 0">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="maincat">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <a href="/admin/categories/add" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add
                                                 Category</a>
                                        </div>
                                        <h3>Main Category</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0"
                                                   id="example" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    {{--<th>First Sub Category Name</th>--}}
                                                    {{--<th>Second Sub Category Name</th>--}}
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($categories as $category )
                                                    <?php
                                                    $category_result = [];
                                                    //$category_result[] = Layer2222::getParentLayer($category->level);
                                                    $prefix="";
                                                    for($i = 0 ; $i < Layer2222::getCurrentLayer($category->level) ; $i++){
                                                        $prefix.="----";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>{{$prefix.$category->name}}</td>
                                                        <td>
                                                            <a href="/admin/categories/{{$category->id}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                                            <a href="javascript:void(0)"  data-href="{{url('/')}}/admin/categories/delete/{{$category->id}}"  data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a>
                                                            <a href="/admin/categories-fields/{{$category->id}}" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> View Fields </a>
                                                        </td>
                                                    </tr>


                                                @endforeach

                                                {{--<tr>--}}
                                                {{--<td>name</td>--}}
                                                {{--<td>slug</td>--}}
                                                {{--<td>slug</td>--}}
                                                {{--<td>--}}
                                                {{--<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>--}}
                                                {{--<a href="javascript:;"  data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>--}}

                                                {{--</td>--}}
                                                {{--</tr>--}}


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- /.end -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->



    <div class="admin-modal modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete this Category, Everything will be deleted under this Category.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('footer')

    <script>
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@stop