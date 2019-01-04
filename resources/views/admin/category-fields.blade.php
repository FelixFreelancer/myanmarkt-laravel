@extends('admin.basic')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control selectpicker" data-live-search="true" name="mainid" id="categories_select">
                        <option value="0">Select Category</option>
                        <?php
                        $selected = "";
                        ?>
                        @foreach($categories as $category)
                            <?php
                            $prefix = "";
                            for ($i = 0; $i < Layer2222::getCurrentLayer($category->level); $i++) {
                                $prefix .= "----";
                            }
                            if (isset($selected_category_id)) {
                                if ($category->id == $selected_category_id->id) {
                                    $selected = "selected";
                                }
                            }

                            ?>
                            <option {{$selected}} value="{{$category->id}}">{{$prefix.$category->name}}</option>
                            @php( $selected = "")
                        @endforeach
                    </select>
                    <div>
                        <button onclick="goBackCategoryList()">GO BACK</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="add-field-section">
            <div class="add-field-button">
                <button data-toggle="modal" onclick="modalInitialize(event)" data-target="#add_field_modal">Add field
                </button>
            </div>
            <input type="hidden" id="option_field_id" value="">
            <div class="added-field-section" id="added_field_section">

                @if(isset($selected_category_fields))
                    @if (sizeof($selected_category_fields) > 0)

                        @foreach($selected_category_fields as $key => $selected_category_field)
                            <div id="{{$selected_category_field->id}}" class="category-field-list-li">
                                <div class="field-style" for=""> label:
                                    <strong>  {{$selected_category_field->label}}</strong></div>
                                <div class="field-style">input field type:
                                    <strong>{{$selected_category_field->field_type}}</strong>
                                    <?php
                                    if ($selected_category_field->field_type == 'select' || $selected_category_field->field_type == 'checkbox' || $selected_category_field->field_type == 'radio') {
                                        echo '<div><button onclick="optionModalInitialize('.$selected_category_field->id.')" data-toggle="modal" data-target="#add_option_field">Add Option</button></div>';

                                        if ($selected_category_fields_options[$key] != NULL) {
                                            echo '<div class="option-field" id="option_field_section_'.$selected_category_field->id.'">';
                                            foreach ($selected_category_fields_options[$key] as $selected_category_fields_option) {
                                                echo '<div>option label: <strong id="option_label_'.$selected_category_fields_option->id.'"> ' . $selected_category_fields_option->label . ' </strong>
                                                            <button onclick="optionFieldEdit('.$selected_category_fields_option->id.')"
                                                                    data-toggle="modal" data-target="#add_option_field">
                                                            edit</button>
                                                            <button onclick="optionFieldDelete('.$selected_category_fields_option->id.')">delete</button>
                                                      </div>';

                                            }
                                            echo '</div>';

                                        }

                                    }

                                    ?>
                                </div>
                                <div class="field-style">
                                    <strong> {{$selected_category_field->required ? 'required' : 'not required' }}</strong>
                                </div>
                                <div class="field-style">
                                    {{----}}
                                    <button onclick="editField('{{$selected_category_field->id}}', event)"
                                            class="category-field-edit" id="{{$selected_category_field->id}}"
                                            data-toggle="modal" data-target="#add_field_modal">
                                        Edit
                                    </button>
                                </div>
                                <div class="field-style">
                                    <button onclick="deleteField({{$selected_category_field->id}})">delete</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 100px;">
            <div class="col-md-6 col-md-offset-3">
                <button type="button" id="add_category_btn" class="btn btn-success btn-block">Add
                    Category
                </button>
            </div>
        </div>

        {{--add field modal--}}
        <div class="admin-modal modal fade" id="add_field_modal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modal_content">
                    <div class="modal-header">
                        <button type="button" onclick="modalInitialize()" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Field</h4>
                    </div>
                    <div class="modal-body" id="modal_body">
                        <div class="select-input-field-type row">
                            <label class="col-md-4" for="">select input type</label>
                            <select name="select-input-type" id="select_input_type">
                                <option value="text">Text</option>
                                <option value="textarea">TextArea</option>
                                <option value="select">select</option>
                                <option value="radio">radio</option>
                                <option value="checkbox">checkbox</option>
                                <option value="file">Upload file</option>
                                {{--<option value="number">Number</option>--}}
                                <option value="email">Email</option>
                            </select>
                            {{--<div class="label-option-field row" id="add_option_field">--}}
                            {{--<div class="">--}}
                            {{--<button onclick="addOptionField()">Add option</button>--}}
                            {{--</div>--}}
                            {{--<div class="option-field-section" id="option_field_section">--}}

                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="label-input-field row">
                            <label class="col-md-4" for="">Input Field Label</label>
                            <input id="input_field_label" name="input_field_label" type="text">
                        </div>
                        <div class="required-input-checkbox row">
                            <label class="col-md-4" for="">Is this required field</label>
                            <input id="required_checbox" name="required_checbox" type="checkbox">
                        </div>
                        {{--add checkbox for search--}}
                        <div class="required-input-checkbox row">
                            <label class="col-md-4" for="">Is this search field</label>
                            <input id="search_checbox" name="search_checbox" type="checkbox">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="modalInitialize()" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <a class="btn btn-primary btn-ok" onclick="addField()">Add field</a>
                    </div>
                </div>
            </div>
        </div>
        {{--add option field modal--}}
        <div class="admin-modal modal fade" id="add_option_field" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="option_modal_content">
                    <div class="modal-header">
                        <button type="button" onclick="optionModalInitialize()" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Option Field</h4>
                    </div>
                    <div class="modal-body" id="option_modal_body">
                        <div class="label-input-field row">
                            <label class="col-md-4" for="">Option Field Label</label>
                            <input id="option_field_label" name="input_field_label" type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="optionModalInitialize()" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <a class="btn btn-primary btn-ok" onclick="addOptionField()">Add field</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        var option_field_one_id = 0;
        var fields = [];

        function modalInitialize(e) {
            var display_category_name = $('#name').val();
            if ($('#categories_select').val() == 0) {
                alert('select category name')
                // $('#add_field_modal').hide()
                e.preventDefault();
                e.stopPropagation();
                return;
            } else {
                $('#option_field_section').empty();
                $('#add_option_field').css('display', 'none');
                option_field_one_id = 0;
                $('#select_input_type').val('text');
                $('#input_field_label').val('');
                $('#required_checbox').prop('checked', false)
            }
        }

        function optionModalInitialize(field_id){
            $('#option_field_label').val('')
            $('#option_field_id').val(field_id)
        }

        function addOptionField() {
           option_field_one_id++;
            // $('#option_field_section_'+$('#option_field_id').val()).append('<div>option label: <strong>'+$('#option_field_label').val()+'</strong>\n' +
            //     '                                                            <button>edit</button><button>delete</button>\n' +
            //     '                                                      </div>')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post('/admin/categories-fields/option-add', {
                //CategoryFieldController@postAddOptionField
                field_id: $('#option_field_id').val(),
                option_label: $('#option_field_label').val()
            }, function (data) {
                if (data == 0) window.location.href = '/admin/categories-fields/'+$('#categories_select').val()
            })
        }

        function optionFieldEdit(option_id){
            var option_label = $('#option_label_'+option_id).text();

            $('#option_modal_content').html(' <div class="modal-header">\n' +
                '                        <button type="button" onclick="optionModalInitialize()" class="close" data-dismiss="modal"\n' +
                '                                aria-hidden="true">&times;\n' +
                '                        </button>\n' +
                '                        <h4 class="modal-title" id="myModalLabel">Edit Option Field</h4>\n' +
                '                    </div>\n' +
                '                    <div class="modal-body" id="option_modal_body">\n' +
                '                        <div class="label-input-field row">\n' +
                '                            <label class="col-md-4" for="">Option Field Label</label>\n' +
                '                            <input id="option_field_label" value="'+option_label+'" name="input_field_label" type="text">\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                    <div class="modal-footer">\n' +
                '                        <button type="button" onclick="optionModalInitialize()" class="btn btn-default" data-dismiss="modal">\n' +
                '                            Cancel\n' +
                '                        </button>\n' +
                '                        <a class="btn btn-primary btn-ok" onclick="saveOptionLabel('+option_id+')">Save Option Label</a>\n' +
                '                    </div>')
        }

        function saveOptionLabel(option_id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post('/admin/categories-fields/option-save/', {
                //CategoryFieldController@postSaveOptionField
                option_id: option_id,
                option_label:$('#option_field_label').val()
            }, function (data) {
                if (data == 0 ) window.location.href = '/admin/categories-fields/'+$('#categories_select').val()
            })
        }
        function optionFieldDelete(option_id){
            //if (confirm('Are you sure to delete this option')){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.post('/admin/categories-fields/option-delete/', {
                //CategoryFieldController@deleteOptionField
                    option_id: option_id
                }, function (data) {
                    if (data == 0) window.location.href = '/admin/categories-fields/'+$('#categories_select').val()
                })
            //}
        }

        function editField(edit_field_id, e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post('/admin/categories-fields/edit-field/', {
                edit_field_id: edit_field_id
            }, function (data) {
                var edit_field = JSON.parse(data);
                var selected = "";
                var input_required_checked = "";
                var input_search_checked = "";
                var input_type_options = ['text', 'textarea', 'select', 'radio', 'checkbox', 'file', 'email'];
                var input_type_options_label = ['Text', 'Textarea', 'Select', 'Radio', 'Checkbox', 'Upload File', 'Email'];
                var select_type_options = "";
                for (var i = 0; i < input_type_options.length; i++) {
                    if (edit_field[0]['field_type'] == input_type_options[i]) selected = "selected"
                    select_type_options += '<option ' + selected + ' value="' + input_type_options[i] + '">' + input_type_options_label[i] + '</option>'
                    selected = "";
                }

                if (edit_field[0]['required'] == 1) input_required_checked = "checked";
                if (edit_field[0]['search_required'] == 1) input_search_checked = "checked";
                $('#modal_content').html('<div class="modal-header">\n' +
                    '                        <button type="button" onclick="modalInitialize()" class="close" data-dismiss="modal"\n' +
                    '                                aria-hidden="true">&times;\n' +
                    '                        </button>\n' +
                    '                        <h4 class="modal-title" id="myModalLabel">Edit Field</h4>\n' +
                    '                    </div>' +
                    '                       <div class="select-input-field-type row">\n' +
                    '                            <label class="col-md-4" for="">select input type</label>\n' +
                    '                            <select name="select-input-type" id="select_input_type">\n' +
                    select_type_options +
                    '                            </select>\n' +
                    '                        </div>\n' +
                    '                        <div class="label-input-field row">\n' +
                    '                            <label class="col-md-4" for="">Input Field Label</label>\n' +
                    '                            <input id="input_field_label" value="' + edit_field[0]['label'] + '" name="input_field_label" type="text">\n' +
                    '                        </div>\n' +
                    '                        <div class="required-input-checkbox row">\n' +
                    '                            <label class="col-md-4" for="">Is this required field</label>\n' +
                    '                            <input id="required_checbox" ' + input_required_checked + ' name="required_checbox" type="checkbox">\n' +
                    '                        </div>' +
                '                            <div class="required-input-checkbox row">\n' +
                    '                            <label class="col-md-4" for="">Is this search field</label>\n' +
                    '                            <input id="search_checbox" '+input_search_checked+' name="search_checbox" type="checkbox">\n' +
                    '                        </div>'+
                    '                            <div class="modal-footer">\n' +
                    '                        <button type="button" onclick="modalInitialize()" class="btn btn-default" data-dismiss="modal">\n' +
                    '                            Cancel\n' +
                    '                        </button>\n' +
                    '                        <a class="btn btn-primary btn-ok" onclick="saveField(' + edit_field[0]['id'] + ')">Save field</a>\n' +
                    '                    </div>')

            })
        }

        function saveField(field_id) {
            var fieldType = $('#select_input_type').val();
            var fieldLabel = $('#input_field_label').val();
            var fieldRequired = 0;
            var options = [];
            var fieldSearch = 0;
            if ($('#required_checbox').is(':checked')) fieldRequired = 1;
            if ($('#search_checbox').is(':checked'))   fieldSearch = 1;
            fields.push({
                type: fieldType,
                label: fieldLabel,
                req: fieldRequired,
                search: fieldSearch,
                choices: options
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post('/admin/categories-fields/save-field/', {
                //CategoryFieldController@postSaveField
                save_field_id: field_id,
                save_field_values: fields

            }, function (data) {
                if (data == 0) {
                    window.location.href = ('/admin/categories-fields/' + $('#categories_select').val())
                }
            })
        }

        function deleteField(remove_id) {
            if (confirm('Are you sure to delete it?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.post('/admin/categories-fields/delete-field/', {
                    //CategoryFieldController@deleteField
                    delete_field_id: remove_id
                }, function (data) {
                    if (data == 0) {
                        window.location.href = ('/admin/categories-fields/' + $('#categories_select').val())
                    }
                })
            }
        }


        function addField() {

            var fieldType = $('#select_input_type').val();
            var fieldLabel = $('#input_field_label').val();
            var fieldRequired = 0;
            var options = []
            if ($('#required_checbox').is(':checked')) fieldRequired = 1;
            if (option_field_one_id >= 1) {
                $('.option-field-value').each(function () {
                    var option = $(this).val()
                    options.push({
                        label: option
                    });
                })
            }
            fields.push({
                type: fieldType,
                label: fieldLabel,
                req: fieldRequired,
                choices: options
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('/admin/categories/field-add', {
                //CategoryController@postFieldAdd // controller
                input_fields_data: fields,
                category_id: $('#categories_select').val()
            }, function (data) {
                if (data == 0) {
                    window.location.href = '/admin/categories-fields/' + $('#categories_select').val();
                    // $('#add_field_modal').hide(modalInitialize())


                }
            })
        }

        function goBackCategoryList() {
            history.go(-1)
        }


        $(document).ready(function () {
            $('.selectpicker').selectpicker();

            $('#categories_select').change(function () {
                window.location.href = '/admin/categories-fields/' + $('#categories_select').val();
            })

            //admin category field new
        })

    </script>

@endsection