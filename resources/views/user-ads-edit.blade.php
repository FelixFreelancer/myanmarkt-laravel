@extends('layouts.app')

@section('content')
    <div id="desktop-wrapper" class="desktop">

        <div id="content">
            <form action="" id="detail-page-form" enctype="multipart/form-data">
                {{csrf_field()}}

                <div id="form-wrapper">
                    <div class="category-list">
                        <div class="tax-breadcrumbs-container grap-bg">
                            <ul>

                                <li>
                                    <span class="taxonomy_desc">This will be listed in:</span>
                                    <span class="change-taxonomy"><a href="/user-ads/">My Ads </a></span>
                                </li>
                                <li>
                                    <span>{{$main_category->name }}  {{  isset($parent_category->name) ? ' > '.$parent_category->name : ''}}
                                        &gt; {{$current_category->name}}</span>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <div class="input-container  ">
                        <div class="post-input">
                            {{--<label class="col-4" for="ads_main_name">Ads Main Name</label>--}}
                            <input name="ads_main_name" autofocus placeholder="Ads Title" id="ads_main_name"
                                   required value="{{$user_ads->ads_main_name}}"
                                   class="input-text input-validate">
                        </div>
                        <input type="hidden" name="post_image_category" value="{{$current_category->id}}">

                        <div class="form-group">
                            <div class="file-loading">
                                <input type="file" name="post_image" accept="image/*" multiple id="post_image_id"
                                       class="input-validate" style="" data-overwrite-initial="false"
                                       data-min-file-count="2">
                            </div>
                        </div>

                        {{--<div class="input-container  ">--}}
                        <?php
                        $index = 0;
                        $required = "";
                        $required_symbol = "";
                        //                        foreach($fields_values as $fields_value){


                        if ($post_input_fields) {
                            foreach ($post_input_fields as $key => $post_input_field) {
                                if ($post_input_field->required == 1) {
                                    $required = "required";
                                }
                                if ($post_input_field->field_type == 'text') {
                                    //contact phone Number // phone number validataion such as post-add-input.blade.php
                                    if ($post_input_field->label == "Contact Number") {
                                        foreach ($fields_values as $fields_value) {
                                            if ($post_input_field->id == $fields_value->field_id) {
                                                if ($required == "required") $required_symbol = "*";
                                                echo '<div class="post-input" >
                                            <input  name="post_input_text" value="' . $fields_value->field_value . '" onkeypress="return isNumberKey(event)" onblur="isValidationLength()"
                                                    id="contact_phone_number" input-type="input-normal-text" input_field_id="' . $post_input_field->id . '"
                                                    placeholder="' . $post_input_field->label . $required_symbol . '"  ' . $required . '
                                                    class="input-text input-value input-validate" maxlength="12">
                                            <div id="contact_number_length_validate">
                                            </div>
                                          </div>';
                                            }
                                        }
                                    } else {
                                        foreach ($fields_values as $fields_value) {
                                            if ($post_input_field->id == $fields_value->field_id) {
                                                if ($required == "required") $required_symbol = "*";
                                                echo '<div class="post-input" >
                                                            <input name="post_input_text" value="' . $fields_value->field_value . '"  input-type="input-normal-text" input_field_id="' . $post_input_field->id . '"  placeholder="' . $post_input_field->label . $required_symbol . '" id="input_id_' . $post_input_field->id . '" ' . $required . '
                                                                   class="input-text input-value input-validate">
                                                                   <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span>
                                                        </div>';
                                            }
                                        }
                                    }


                                }

                                if ($post_input_field->field_type == 'file') {
                                    echo '
                                             <div style="font-size:18px">' . $post_input_field->label . '</div>
                                                <div class="post-input" >
                                                <input type="file" name="post_input_text" value="' . $fields_value->field_value . '" input-type="input-normal-text" input_field_id="' . $post_input_field->id . '"
                                                        placeholder="' . $post_input_field->label . '" id="input_id_' . $post_input_field->id . '" ' . $required . ' value=""  autofocus
                                                       class="input-text input-value input-validate">
                                                       <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span>
                                              </div>';
                                }

                                if ($post_input_field->field_type == 'textarea') {
                                    foreach ($fields_values as $fields_value) {
                                        if ($post_input_field->id == $fields_value->field_id) {
                                            echo '<div class="post-input" >
                                        <textarea rows="7" name="post_input_textarea" value="" input-type="input-normal-text" input_field_id="' . $post_input_field->id . '" placeholder="' . $post_input_field->label . '" id="text_input_id_' . $post_input_field->id . '" ' . $required . ' value=""
                                               class="input-text input-value input-validate">' . $fields_value->field_value . '</textarea>
                                               <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span>
                                        </div>';
                                        }
                                    }
                                }
                                if ($post_input_field->field_type == 'select') {
                                    $selected = "";
                                    if ($required == "required") $required_symbol = "*";

                                    foreach ($fields_values as $fields_value) {
                                        if ($post_input_field->id == $fields_value->field_id) {
                                            echo '<div class="post-input" >
                                        <select name="post_input_select" input-type="input-normal-text" input_field_id="' . $post_input_field->id . '" id="select_id_' . $post_input_field->id . '" ' . $required . '
                                               class="input-text input-value input-validate">';
                                            echo '<option>' . $post_input_field->label . $required_symbol . '</option>';

                                            // job-type selected option
                                            if ($post_input_field->label == "Job Type") {
                                                $job_types = ['Full Time', 'Part Time', 'Internship', 'Temporary'];
                                                foreach ($job_types as $job_type) {
                                                    if ($job_type == $fields_value->field_value) $selected = "selected";
                                                    echo '<option ' . $selected . ' value="' . $job_type . '">' . $job_type . '</option>';
                                                    $selected = "";
                                                }

                                            }

                                            //job-category selected option
                                            if ($post_input_field->label == "Job Category") {
                                                $job_categories = ['Accounting', 'Airlines & Aviation', 'Architecture & Interior Design', 'Art & Entertainment',
                                                    'Automotive', 'Banking & Finance', 'Beauty', 'Business Development', 'Business Supplies & Equipment', 'Construction',
                                                    'Consulting', 'Customer Service', 'Education', 'Engineering', 'Environmental Services', 'Event Management', 'Executive
                                                    ', 'Fashion', 'Food & Beverages', 'Government / Administration', 'Graphic Design', 'Hospitality & Restaurants', 'HR & Recruitment', 'Import & Export',
                                                    'Industrial & Manufacturing', 'Information Technology', 'Insurance', 'Internet', 'Legal Services', 'Logistics & Distribution'
                                                    , 'Marketing & Advertising', 'Media', 'Medical & Healthcare', 'Oil, Gas & Energy', 'Online Media', 'Online Media', 'Pharmaceuticals'
                                                    ,'Public Relations', 'Real Estate', 'Research & Development', 'Retail & Consumer Goods', 'Safety & Security', 'Sales',
                                                    'Secretarial', 'Sports & Fitness', 'Telecommunications', 'Transportation', 'Travel & Tourism', 'Veterinary & Animals' ,
                                                    'Warehousing', 'Wholesale', 'Other'];
                                                foreach ($job_categories as $job_category) {
                                                    if ($job_category == $fields_value->field_value) $selected = "selected";
                                                    echo '<option ' . $selected . ' value="' . $job_category . '">' . $job_category . '</option>';
                                                    $selected = "";
                                                }
                                            }

                                            //general option selected
                                            if (isset($post_input_field->options) && $post_input_field->options) {
                                                foreach ($post_input_field->options as $input_option) {
                                                    if ($fields_value->field_value == $input_option->label) $selected = "selected";
                                                    echo '<option ' . $selected . ' value="' . $input_option->label . '">' . $input_option->label . '</option>';
                                                    $selected = "";
                                                }
                                            }
                                            echo '</select>
                                                        <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span></div>';
                                        }
                                    }
                                }
                                if ($post_input_field->field_type == 'radio') {
                                    $checked = "";
                                    foreach ($fields_values as $fields_value) {
                                        if ($post_input_field->id == $fields_value->field_id) {
                                            echo '<div class="extras">
                                            <ul id="extras" class="input-value input-validate"  input-type="input-radio" input_field_id="' . $post_input_field->id . '">';
                                            if (isset($post_input_field->options)) {
                                                $index_option = 0;
                                                foreach ($post_input_field->options as $check_option) {
                                                    if ($fields_value->field_value == $check_option->label) $checked = "checked";
                                                    echo '<li>
                                                    <label  for="extras_item_' . $index . '_' . $index_option . '">
                                                    <input ' . $checked . '  name="post_input_radio' . $post_input_field->id . '_' . $index . '" class="input-radio-value" type="radio"  value="' . $check_option->label . '"  id="extras_item_' . $index . '_' . $index_option . '" >
                                                        ' . $check_option->label . '
                                                    </label>
                                                </li>';
                                                    $index_option++;
                                                    $checked = "";
                                                }
                                            }
                                            echo '</ul>
                                        </div>';
                                        }
                                    }
                                }
                                if ($post_input_field->field_type == 'checkbox') {
                                    $checked = "";
                                    $check_option_fields = [];
                                    $ads_check_option_values = [];

                                    echo '<div class="extras">
                                            <ul id="extras" class="input-value input-validate" input-type="input-checkbox" input_field_id="' . $post_input_field->id . '">';
                                    $index_option = 0;

                                    foreach ($post_input_field->options as $check_option) {
                                        $check_option_fields[] = $check_option;
                                    }
//                                    print_r($check_option_fields); echo "<br>";
                                    $check_field_id = $check_option->field_id;
//                                    print_r($check_field_id);
                                    foreach ($fields_values as $fields_value) {
//                                      print_r($fields_value->field_id);echo "<br>";
                                        if ($check_field_id == $fields_value->field_id) {
                                            $ads_check_option_values[] = $fields_value;
                                        }
                                    }
//                                    print_r($ads_check_option_values);exit;
                                    foreach ($check_option_fields as $key => $check_option_field) {
                                        $checked = "";
                                        if ($ads_check_option_values[$key]->field_value == $check_option_field->label) {
                                            $checked = "checked";
                                        }
                                        echo '<li>
                                                    <label  for="extras_item_' . $index . '_' . $index_option . '">
                                                        <input ' . $checked . ' option-field-id="' . $check_option_field->id . '" name="post_input_checkbox" class="checkbox-value-class" value="' . $check_option_field->label . '" type="checkbox" id="extras_item_' . $index . '_' . $index_option . '" >
                                                        ' . $check_option_field->label . '
                                                    </label>
                                                </li>';
                                        $index_option++;

                                    }
                                    echo '</ul></div>';
                                }
                                if ($post_input_field->field_type == 'agree') {
                                    $checked = "";
                                    foreach ($fields_values as $fields_value) {
                                        if ($post_input_field->id == $fields_value->field_id) {
                                            if ($fields_value->field_value == $post_input_field->label) $checked = "checked";

                                            echo '<div class="input-agree input-checkbox-style" >
                                            <input ' . $checked . ' name="post_input_agree" type="checkbox" placeholder="" id="agree_id_' . $index . '" ' . $required . ' value="' . $post_input_field->label . '"
                                               class="checkbox input-value input-validate" input-type="input-agree" input_field_id="' . $post_input_field->id . '">
                                            <label  for="agree_id_' . $index . '">' . $post_input_field->label . '</label>
                                      </div>';
                                            $checked = "";
                                        }
                                    }
                                }

                                $index++;
                                $required = " ";
                                $required_symbol = "";
                            }
                        }
                        //                        }
                        ?>


                        {{--<div style="width: 100%;">--}}
                        {{--<button type="submit" id="upload-button" value="Add your photos"--}}
                        {{--class="button button-yalla button-green" onclick="event.preventDefault();--}}
                        {{--document.getElementById('post_image_id').click();    ">--}}
                        {{--Add your photos<i class="fas fa-camera"></i>--}}

                        {{--</button>--}}

                        {{--<span >Add your photos</span>--}}

                        {{--</div>--}}

                        <input id="enter-details-submit" onclick="saveData()" type="button"
                               class="button button-yalla button-green proxima"
                               value="Submit">
                    </div>
                </div>

            </form>
        </div>

    </div>
    <script>
            <?php
            $ads_preview_images = "";
            $ads_preview_images_name = "";
            foreach ($user_ads_images as $user_ads_image) {
                if ($user_ads_image->ads_image != "") {
                    $ads_preview_images .= 'http://localhost:8080/upload/' . $user_ads_image->ads_image;
                    $ads_preview_images .= ',';
                    $ads_preview_images_name .= $user_ads_image->ads_image;
                    $ads_preview_images_name .= ',';
                }

            }
            $ads_preview_images = substr($ads_preview_images, 0, strlen($ads_preview_images) - 1);
            $ads_preview_images_name = substr($ads_preview_images_name, 0, strlen($ads_preview_images_name) - 1);
            //print_r('asdf'.$ads_preview_images.'2adsf');exit;
            ?>
        var ads_preview_images = '{{$ads_preview_images}}';
        var imageNames = '{{$ads_preview_images_name}}';

        imageNames = imageNames.split(',');
        var preview_image_caption = [];
        for (var i = 0; i < imageNames.length; i++) {
            var obj = {caption: '', key: 0};
            obj.caption = imageNames[i];
            obj.key = i;
            preview_image_caption.push(obj);
        }

        // var imageNames = [{caption: "picture-1.jpg", key: 0}, {caption: "picture-2.jpg", key: 1},];

        // ads_preview_images = "http://lorempixel.com/800/460/people/5/"+ ', ' +"http://lorempixel.com/800/460/people/2";
        $("#post_image_id").fileinput({
            theme: 'fas',
            uploadUrl: "/post-add/post-image",
            uploadAsync: false,
            uploadExtraData: function () {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },

            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            initialPreview: ads_preview_images.trim().length ? ads_preview_images.split(',') : [],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            maxFileSize: 2000,
            maxFilesNum: 10,
            // removeLabel: 'Remove',
            initialPreviewConfig: preview_image_caption
        });

        //image delete button click, the image is deleted
        $('.kv-file-remove').on('click', function () {
            alert($(this).attr('data-key'));
            var preview_id = "preview--init_" + $(this).attr('data-key');
            var delete_image_name = "";
            $('.file-preview-frame').each(function () {
                if ($(this).attr('id') == preview_id) {
                    delete_image_name = $('#' + preview_id + ' .file-caption-info').html();
                    //alert($('#'+preview_id+' .file-caption-info').html())
                }
            })
            //remove from database
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{route('user.ads.photo.delete')}}', {
                //UserAdsController@deleteImage
                imageName: delete_image_name,
                user_ads_id: '{{$user_ads->id}}',
            }, function (data) {
                if (data == 0) {
                    console.log('success delete');
                    location.reload();
                }
            })
            //
        });

        $('#post_image_id').on('fileuploaded', function (event, data, previewId, index) {
            var response = data.response;

            imageNames += response['uploaded'];
            imageNames += '|';

        });

        //contact phone number validation
        var contact_number_validation = true;

        function isNumberKey(evt) {

            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        //contact number length
        function isValidationLength() {
            var phone_number = $('#contact_phone_number').val();
            if (phone_number.length < 8) {
                $('#contact_number_length_validate').html('<span id="contactNumber-invalid-feedback" class="input-invalid-feedback" role="alert">\n' +
                    '                   <strong>Phone Number must be 8 letter at least ' +
                    '                   </span>');
                contact_number_validation = false;
            } else {
                $('#contactNumber-invalid-feedback').hide();
                contact_number_validation = true;
            }
        }


        // save ads data
        function saveData(e) {
            console.log(imageNames);
            imageNames = imageNames.substr(0, imageNames.length - 1);

            var input_field_id = [];
            var option_field_id = [];
            var input_field_value = [];
            var index = 0;
            var options = [];


            $('.input-value').each(function () {
                if ($(this).attr('input-type') == 'input-radio') {
                    input_field_id[index] = $(this).attr('input_field_id');
                    $('.input-radio-value').each(function () {
                        if ($(this).is(':checked')) {
                            // input_field_value[index] = $(this).val();
                            input_field_value[index] = $('input[name^="post_input_radio"]:checked').val();
                        }
                        // else input_field_value[index] = null

                    })

                }
                if ($(this).attr('input-type') == 'input-checkbox') {
                    input_field_id[index] = $(this).attr('input_field_id');

                    var index_checkbox = 0;

                    $('.checkbox-value-class').each(function () {
                        option_field_id[index_checkbox] = $(this).attr('option-field-id');
                        // input_field_value[index] = $('input[name="post_input_checkbox"]:checked').val();
                        if ($(this).is(':checked')) {
                            options[index_checkbox] = $(this).val();
                        } else {
                            options[index_checkbox] = null;
                        }

                        index_checkbox++;
                    })

                    input_field_value[index] = options;
                }
                if ($(this).attr('input-type') == 'input-agree') {
                    input_field_id[index] = $(this).attr('input_field_id');
                    if ($(this).is(':checked')) {
                        // console.log($('input[name="post_input_agree"]').val());

                        input_field_value[index] = $(this).val();

                    } else {
                        input_field_value[index] = null;

                    }
                }
                if ($(this).attr('input-type') == 'input-normal-text') {

                    input_field_id[index] = $(this).attr('input_field_id');
                    input_field_value[index] = $(this).val();

                }

                index++;
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{route('user.ads.update')}}', {
                //UserAdsController@updateUserAds
                input_field_id: input_field_id,
                input_field_value: input_field_value,
                option_field_id: option_field_id,
                ads_main_name: $('#ads_main_name').val(),
                ads_images: imageNames,
                user_ads_id: '{{$user_ads->id}}',
                category_id: '{{$current_category->id}}'


            }, function (data) {
                if (data == 0) {

                    location.reload();
                }
            })
        }
    </script>
@endsection