@extends('layouts.app')

@section('content')
    <div id="desktop-wrapper" class="desktop">

        <div id="content">
            {{-- $.post('{{route('user.post.data.submit')}}', {
                //PostAddInputController@postDataSubmit--}}
            <form method="post" id="detail-page-form" action="{{route('user.post.data.submit')}}"
                  enctype="multipart/form-data">
                {{csrf_field()}}

                <div id="form-wrapper">
                    <div class="category-list">
                        <div class="tax-breadcrumbs-container grap-bg">
                            <ul>

                                <li>
                                    <span class="taxonomy_desc">This will be listed in:</span>
                                    <?php
                                    if (isset($parent_catgory_level) && $parent_catgory_level) {
                                        echo '<span class="change-taxonomy"><a href="/post-add/sub-category/' . $parent_catgory_level . '">
                                                    Change</a></span>';
                                    } else {
                                        echo '<span class="change-taxonomy"><a href="/post-add/' . $main_category->id . '">
                                                    Change</a></span>';
                                    }
                                    ?>

                                </li>
                                <li>
                                    <span>{{$main_category->name }}  {{  isset($parent_category->name) ? ' > fasd'.$parent_category->name : ''}}
                                        &gt; {{$current_category->name}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="input-container  ">
                        <div class="post-input">
                            {{--<label class="col-4" for="ads_main_name">Ads Main Name</label>--}}
                            <input name="ads_main_name" autofocus placeholder="Title*" id="ads_main_name"
                                   maxlength="45" required value="" class="input-text input-validate ">
                            <span class="input-invalid-feedback " role="alert">
                                <strong>This field is required</strong>
                            </span>
                        </div>
                        <div class="post-input post-type-select">
                            <input type="radio" name="ads_type" value="0"> Featured<br>
                            <input type="radio" name="ads_type" value="1"> Promoted<br>
                            <input type="radio" name="ads_type" value="3"> Sold
                        </div>

                        <input type="hidden" name="category_id" value="{{$current_category->id}}">
                        <input type="hidden" name="main_category_id" value="{{$main_category->id}}">

                        <div class="form-group">
                            <div class="file-loading">
                                <input type="file" name="post_image" accept="image/*" multiple id="post_image_id"
                                       data-msg-placeholder="or select files" id="image_upload_plugin"
                                       class="input-validate" style="" data-overwrite-initial="false"
                                       data-min-file-count="2">

                            </div>
                            <span class="input-invalid-feedback " id="image-upload-invalid" role="alert">
                                    <strong>This field is required</strong>
                        </span>
                        </div>

                        {{--<div class="input-container  ">--}}
                        <?php
                        $index = 0;
                        $required = "";
                        $required_symbol = "";
                        $contact_number_validation = "";
                        $setUp_contact_number_validation = false;
                        $number_validation_id = "";
                        $max_length = "";
                        if ($post_input_fields) {
                            for ($i = 0; $i < sizeof($post_input_fields); $i++) {
                                if ($post_input_fields[$i]->required == 1) {
                                    $required = "required";
                                }
                                if ($post_input_fields[$i]->field_type == 'email'){
                                    if ($required == "required") $required_symbol = "*";
                                    echo '<div class="post-input" >
                                            <input  name="post_input_text" value="" type="email"
                                                    input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"
                                                    placeholder="' . $post_input_fields[$i]->label . $required_symbol . '"
                                                    id="input_id_' . $post_input_fields[$i]->id . '" ' . $required . '
                                                    class="input-text input-value input-validate">
                                            <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span>
                                          </div>';

                                }

                                if ($post_input_fields[$i]->field_type == 'text') {
                                    // contact number validation || $post_input_fields[$i]->label == "Mileage (in km)"

                                    if ($required == "required") $required_symbol = "*";
                                    if ($post_input_fields[$i]->label == "Contact number" || $post_input_fields[$i]->label == "Engine size (e.g. 1.6 or 2.0)"
                                        || $post_input_fields[$i]->label == "Seats" || $post_input_fields[$i]->label == "Mileage (in km)"
                                        || $post_input_fields[$i]->label == "Applicant number" ) {
                                        $number_validation_id = "number_input_".$post_input_fields[$i]->id;
                                        if ($post_input_fields[$i]->label == "Contact number") {
                                            $contact_number_validation = "onblur='isValidationLength()'";
                                            $setUp_contact_number_validation = true;
                                            $number_validation_id = "contact_phone_number";
                                            $max_length = "12";
                                        }
                                        if ($post_input_fields[$i]->label == "Engine size (e.g. 1.6 or 2.0)") $max_length = 3;
                                        if ($post_input_fields[$i]->label == "Seats") $max_length = 2;
                                        echo '<div class="post-input" >
                                            <input  name="post_input_text" value=""  ' . $contact_number_validation . '
                                                    maxlength="' . $max_length . '"    id="'.$number_validation_id.'" input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"
                                                    placeholder="' . $post_input_fields[$i]->label . $required_symbol . '"  ' . $required . '
                                                    class="input-text input-value input-validate input-number">
                                                    <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                            </span>';
                                        if ($setUp_contact_number_validation){
                                            echo '<div id="contact_number_length_validate">
                                            </div>';
                                        }


                                        echo '</div>';
                                        $contact_number_validation = "";
                                        $setUp_contact_number_validation = false;
                                        $number_validation_id = "";
                                        $max_length = "";

                                    }
                                    if ($post_input_fields[$i]->label == "Price" || $post_input_fields[$i]->label == "Size" ||
                                        $post_input_fields[$i]->label == "Salary" || $post_input_fields[$i]->label == "Salary expectation") {
//                                        $max_length = "";
//                                        if ($post_input_fields[$i]->label == "Engine size (e.g. 1.6 or 2.0)") $max_length = 3;
//                                        if ($post_input_fields[$i]->label == "Seats") $max_length = 2;
                                        echo '<div class="post-input post-input-price " >
                                               <div class="">
                                            <input  name="post_input_text" value=""
                                                    id="ads_price" input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"
                                                    placeholder="' . $post_input_fields[$i]->label . $required_symbol . '"  ' . $required . '
                                                    class="input-text input-value input-validate input-number" >
                                             <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                            </span>
                                            </div>
                                            <div>';

                                        foreach ($post_input_fields as $post_input_field_for_price) {
                                            if (($post_input_fields[$i]->label == "Price" && $post_input_field_for_price->label == "Kyat")
                                                || ($post_input_fields[$i]->label == "Size" && $post_input_field_for_price->label == "sq feet")
                                                || ($post_input_fields[$i]->label == "Salary" && $post_input_field_for_price->label == "Kyat")
                                                || ($post_input_fields[$i]->label == "Salary expectation" && $post_input_field_for_price->label == "Kyat")) {
                                                if ($post_input_field_for_price->required == 1) {
                                                    $required_symbol = "*";
                                                    $required = "required";
                                                }
                                                echo '<select input_field_id="' . $post_input_field_for_price->id . '" ' . $required . '
                                                                  input-type="input-normal-text" class="input-value input-text input-validate second-select-value" >';

                                                if ($required == "required") {
                                                    echo '<option value="required">' . $post_input_field_for_price->label . $required_symbol . '</option>';
                                                } else {
                                                    echo '<option value="' . $post_input_field_for_price->label . '">' . $post_input_field_for_price->label . '</option>';
                                                }
                                                foreach ($post_input_field_for_price->options as $select_price_currency) {
                                                    echo '<option  value="' . $select_price_currency->label . '">' . $select_price_currency->label . '</option>';
                                                }

                                                echo '</select><span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                            </span>';
                                            }
                                            $required = "";
                                            $required_symbol = "";
                                        }
                                        echo '</div>
                                          </div>';
                                        $required_symbol = "";
                                        $max_length = 0;

                                    }
                                    if ($post_input_fields[$i]->label != "Engine size (e.g. 1.6 or 2.0)" && $post_input_fields[$i]->label != "Seats" &&
                                        $post_input_fields[$i]->label != "Size" && $post_input_fields[$i]->label != "Price" &&
                                        $post_input_fields[$i]->label != "Contact number" && $post_input_fields[$i]->label != "Salary" &&
                                        $post_input_fields[$i]->label != "Mileage (in km)" &&
                                        $post_input_fields[$i]->label != "Applicant number" && $post_input_fields[$i]->label != "Salary expectation") {
                                        echo '<div class="post-input" >
                                            <input  name="post_input_text" value=""
                                                    input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"
                                                    placeholder="' . $post_input_fields[$i]->label . $required_symbol . '" id="input_id_' . $post_input_fields[$i]->id . '" ' . $required . ' value=""
                                                    class="input-text input-value input-validate">
                                            <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span>
                                          </div>';
                                    }
                                }
                                //upload file
                                if ($post_input_fields[$i]->field_type == 'file') {
                                    echo '
                                             <div style="font-size:18px">' . $post_input_fields[$i]->label . '</div>
                                                <div class="post-input" >
                                                <input type="file" name="upload_cv" value="" input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"
                                                        placeholder="' . $post_input_fields[$i]->label . '" id="input_id_' . $post_input_fields[$i]->id . '" ' . $required . ' value=""  autofocus
                                                       class="input-text input-value input-validate">
                                                <span class="input-invalid-feedback " role="alert">
                                                    <strong>This field is required</strong>
                                                </span>
                                              </div>';
                                }


                                if ($post_input_fields[$i]->field_type == 'textarea') {
                                    if ($required == "required") $required_symbol = "*";
                                    echo '<div class="post-input" >
                                        <textarea rows="7" name="post_input_textarea"  placeholder="' . $post_input_fields[$i]->label . $required_symbol . '"
                                                input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"  id="text_input_id_' . $post_input_fields[$i]->id . '" ' . $required . ' value=""  autofocus
                                               class="input-text input-value input-validate"></textarea>
                                        <span class="input-invalid-feedback " role="alert">
                                                <strong>This field is required</strong>
                                        </span>
                                    </div>';
                                }
                                if ($post_input_fields[$i]->field_type == 'select') {

                                    if ($required == "required") $required_symbol = "*";
                                    if ($post_input_fields[$i]->label == "Kyat" || $post_input_fields[$i]->label == "sq feet") {
//                                        $i++;
                                    } else {
                                        echo '<div class="post-input" >
                                        <select name="post_input_select" input-type="input-normal-text" input_field_id="' . $post_input_fields[$i]->id . '"
                                                id="select_id_' . $post_input_fields[$i]->id . '" ' . $required . '   autofocus
                                                class="input-text input-value input-validate">';
                                        if ($required == "required") {

                                            echo '<option value="required">' . $post_input_fields[$i]->label . $required_symbol . ' </option>';
                                        }else {
//                                            echo '<option value="'.$post_input_fields[$i]->label.'">' . $post_input_fields[$i]->label . $required_symbol . ' </option>';
                                            echo '<option value="null">' . $post_input_fields[$i]->label . $required_symbol . ' </option>';
                                        }
                                        if ($post_input_fields[$i]->label == "Please select location") {
                                            $locations_array = ['Yangon Region', 'Mandalay Region', 'Magway Region', 'Naypyidaw Union Territory'
                                                , 'Kayah State', 'Shan State', 'Ayeyarwady Region', 'Bago Region', 'Kachin State',
                                                'Sagaing Region', 'Kayin State', 'Mon State', 'Tanintharyi Region', 'Chin State',
                                                'Rakhine State', 'All Regions'];
                                            foreach ($locations_array as $location_array) {
                                                echo '<option  value="' . $location_array . '">' . $location_array . '</option> ';
                                            }
                                        }
                                        if ($post_input_fields[$i]->label == "Job type") {
                                            $job_types = ['Full Time', 'Part Time', 'Internship', 'Temporary'];
                                            foreach ($job_types as $job_type) {
                                                echo '<option value="' . $job_type . '">' . $job_type . '</option>';
                                            }
                                        }

                                        if ($post_input_fields[$i]->label == "Job category") {
                                            $job_categories = ['Accounting', 'Airlines & Aviation', 'Architecture & Interior Design', 'Art & Entertainment',
                                                'Automotive', 'Banking & Finance', 'Beauty', 'Business Development', 'Business Supplies & Equipment', 'Construction',
                                                'Consulting', 'Customer Service', 'Education', 'Engineering', 'Environmental Services', 'Event Management', 'Executive', 'Fashion', 'Food & Beverages', 'Government / Administration', 'Graphic Design', 'Hospitality & Restaurants', 'HR & Recruitment', 'Import & Export',
                                                'Industrial & Manufacturing', 'Information Technology', 'Insurance', 'Internet', 'Legal Services', 'Logistics & Distribution'
                                                , 'Marketing & Advertising', 'Media', 'Medical & Healthcare', 'Oil, Gas & Energy', 'Online Media', 'Online Media', 'Pharmaceuticals'
                                                , 'Public Relations', 'Real Estate', 'Research & Development', 'Retail & Consumer Goods', 'Safety & Security', 'Sales',
                                                'Secretarial', 'Sports & Fitness', 'Telecommunications', 'Transportation', 'Travel & Tourism', 'Veterinary & Animals',
                                                'Warehousing', 'Wholesale', 'Other'];
                                            foreach ($job_categories as $job_category) {
                                                echo '<option value="' . $job_category . '">' . $job_category . '</option>';
                                            }
                                        }

                                        if (isset($post_input_fields[$i]->options) && $post_input_fields[$i]->options) {
                                            foreach ($post_input_fields[$i]->options as $input_option) {
                                                echo '<option  value="' . $input_option->label . '">' . $input_option->label . '</option>';
                                            }
                                        }
                                        echo '</select>
                                            <span class="input-invalid-feedback " role="alert">
                                                <strong>This field is required</strong>
                                            </span></div>';
                                    }

                                }
                                if ($post_input_fields[$i]->field_type == 'radio') {
                                    echo '<div class="extras">
                                            <ul id="extras" class="input-value input-validate"  input-type="input-radio" input_field_id="' . $post_input_fields[$i]->id . '">';
                                    if (isset($post_input_fields[$i]->options)) {
                                        $index_option = 0;
                                        foreach ($post_input_fields[$i]->options as $check_option) {
                                            echo '<li>
                                                    <label  for="extras_item_' . $index . '_' . $index_option . '">
                                                    <input  name="post_input_radio' . $post_input_fields[$i]->id . '_' . $index . '" class="input-radio-value" type="radio"  value="' . $check_option->label . '"  id="extras_item_' . $index . '_' . $index_option . '" >
                                                        ' . $check_option->label . '
                                                    </label>
                                                </li>';
                                            $index_option++;
                                        }
                                    }
                                    echo '</ul></div>';
                                }
                                if ($post_input_fields[$i]->field_type == 'checkbox') {

                                    echo '<div class="extras">
                                            <ul id="extras" class="input-value input-validate" input-type="input-checkbox" input_field_id="' . $post_input_fields[$i]->id . '">';
                                    $index_option = 0;
                                    foreach ($post_input_fields[$i]->options as $check_option) {
                                        echo '<li>
                                                    <label  for="extras_item_' . $index . '_' . $index_option . '">
                                                        <input input-option-id="' . $check_option->id . '" name="post_input_checkbox" class="checkbox-value-class" value="' . $check_option->label . '" type="checkbox" id="extras_item_' . $index . '_' . $index_option . '" >
                                                        ' . $check_option->label . '
                                                    </label>
                                                </li>';
                                        $index_option++;

                                    }
                                    echo '</ul></div>';
                                }
                                if ($post_input_fields[$i]->field_type == 'agree') {

                                    echo '<div class="input-agree input-checkbox-style" >
                                            <input name="post_input_agree" type="checkbox" placeholder="" id="agree_id_' . $index . '" ' . $required . ' value="' . $post_input_fields[$i]->label . '"  autofocus
                                               class="checkbox input-value input-validate" input-type="input-agree" input_field_id="' . $post_input_fields[$i]->id . '">
                                            <label  for="agree_id_' . $index . '">' . $post_input_fields[$i]->label . '</label>
                                          </div>';
                                }

                                $index++;
                                $required = "";
                                $required_symbol = "";
                            }
                        }
                        ?>
                        {{--<div style="width: 100%;">--}}
                        {{--<button type="submit" id="upload-button" value="Add your photos"--}}
                        {{--class="button button-yalla button-green" onclick="event.preventDefault();--}}
                        {{--document.getElementById('post_image_id').click();    ">--}}
                        {{--Add your photos<i class="fas fa-camera"></i>--}}

                        {{--</button>--}}

                        {{--<span >Add your photos</span>--}}

                        {{--</div>--}}
                        {{--onclick="saveData(event)"--}}

                        <input id="enter-details-submit"  type="submit"
                               class="button button-yalla button-green proxima"
                               value="Submit">
                        <input id="input_field_id" type="hidden" name="input_field_id" value="">
                        <input id="option_field_id" type="hidden" name="option_field_id" value="">
                        <input id="option_field_values" type="hidden" name="option_field_values" value="">
                        <input id="input_field_value" type="hidden" name="input_field_value" value="">
                        <input id="ads_images" type="hidden" name="ads_images" value="">
                    </div>
                </div>

            </form>
        </div>

    </div>
    <script>
        //contact number validation
        var contact_number_validation = true;
        // function isNumberKey(evt){
        $('.input-number').keypress(function (evt) {

            var charCode = (evt.which) ? evt.which : event.keyCode;

            if (charCode < 46 || charCode > 59) {
                return false;
            } // prevent if not number/dot

            if (charCode == 46 && $(this).val().indexOf('.') != -1) {

                return false;
            } // prevent if already dot

            return true;
        })


        //contact number length
        function isValidationLength() {
            var phone_number = $('#contact_phone_number').val();
            // console.log(phone_number.length)
            if (phone_number.length < 8) {
                $('#contact_number_length_validate').html('<span id="contactNumber-invalid-feedback" class="input-invalid-feedback" role="alert">\n' +
                    '                   <strong>Phone Number must be 8 letter at least ' +
                    '                   </span>');
                contact_number_validation = false;
            } else {
                // $('#contactNumber-invalid-feedback').hide();
                $('#contact_number_length_validate').html('')

                contact_number_validation = true;
            }
        }
        <?php
        // enter remove
        $current_category_name = trim(preg_replace('/\s\s+/', ' ', $current_category->name))
        ?>
        //image names
        //if job category,  i want a job, or hire. it has preview images.
        var current_category_name = '{{$current_category_name}}';
        var job_preview_image = '';
        var image_required_validation = true;

        if (current_category_name == 'I want to hire') {
            job_preview_image = 'http://localhost:8080/upload/hiring.png';
            // job_preview_image = 'https://myanmarkt.com/upload/hiring.png';
            image_required_validation = false;
        } else if (current_category_name == 'I want a job') {
            job_preview_image = 'http://localhost:8080/upload/wanted.png';
            // job_preview_image = 'https://myanmarkt.com/upload/wanted.png';
            image_required_validation = false;
        }

        var imageNames = "";
        $("#post_image_id").fileinput({
            theme: "fas",
            uploadUrl: "/post-add/post-image",
            // deleteUrl:'/post-add/image-delete',
            //PostAddInputController@postImageDelete
            uploadAsync: false,
            uploadExtraData: function () {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },

            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            initialPreview: job_preview_image,
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            maxFileSize: 2000,
            maxFilesNum: 10,


        })


        $('#post_image_id').on('fileuploaded', function (event, data, previewId, index) {
            var response = data.response;
            imageNames += response['uploaded'];
            imageNames += '|';

        });

        // save ads data
        $('#detail-page-form').on('submit', function (event) {

           event.preventDefault();
        // })
        // function saveData(event) {

            imageNames = imageNames.substr(0, imageNames.length - 1);

            var input_field_id = [];
            var option_field_id = [];
            var input_field_value = [];
            var index = 0;
            var options = [];
            var ajaxStop = true;

            if (image_required_validation) {
                if (imageNames.trim() == '') {
                    ajaxStop = false;
                    $('#image-upload-invalid').css('display', 'block')
                } else {
                    $('#image-upload-invalid').css('display', 'none')
                }
            }

            $('.input-validate').each(function () {
                //validataion script
                var required_fields_property = $(this).attr('required');
                if (required_fields_property == 'required') {
                    if ($(this).val().trim().length == 0 || $(this).val() == 'required') {
                        $(this).siblings('.input-invalid-feedback').css('display', 'block');
                        ajaxStop = false

                    } else {
                        $(this).siblings('.input-invalid-feedback').css('display', 'none');
                    }
                }
            })

            if (!ajaxStop || !contact_number_validation) {

                $('body, html').animate({
                    scrollTop: 0
                }, 2000)
            } else {

                $('.input-value').each(function () {

                    if ($(this).attr('input-type') == 'input-radio') {
                        input_field_id[index] = $(this).attr('input_field_id');
                        $('.input-radio-value').each(function () {
                            input_field_value[index] = $('input[name^="post_input_radio"]:checked').val();
                            // alert($('input[name^="post_input_radio"]:checked').val());
                            // if ($('input[name^="post_input_radio"]').attr('checked')){
                            //     alert($('input[name^="post_input_radio"]').val());
                            //     input_field_value[index] = $('input[name^="post_input_radio"]').val();
                            // }
                        })
                    }
                    if ($(this).attr('input-type') == 'input-checkbox') {
                        input_field_id[index] = $(this).attr('input_field_id');
                        //option_field_id[index] = $(this).find('.checkbox-value-class').attr('input-option-id');
                        var index_checkbox = 0;

                        $('.checkbox-value-class').each(function () {
                            option_field_id[index_checkbox] = $(this).attr('input-option-id');
                            // input_field_value[index] = $('input[name="post_input_checkbox"]:checked').val();
                            if ($(this).is(':checked')) {
                                options[index_checkbox] = $(this).val();
                            } else {
                                options[index_checkbox] =  'null';
                            }

                            index_checkbox++;
                        })

                        input_field_value[index] = "options";
                    }
                    if ($(this).attr('input-type') == 'input-agree') {
                        input_field_id[index] = $(this).attr('input_field_id');
                        if ($(this).is(':checked')) {

                            input_field_value[index] = $(this).val();

                        } else input_field_value[index] = 'null';

                    }
                    if ($(this).attr('input-type') == 'input-normal-text') {

                        input_field_id[index] = $(this).attr('input_field_id');
                        input_field_value[index] = $(this).val();

                    }
                    index++;
                })
                // console.log(options);

                $('#input_field_id').val(input_field_id);
                $('#option_field_id').val(option_field_id);
                $('#input_field_value').val(input_field_value);
                $('#option_field_values').val(options);
                $('#ads_images').val(imageNames);

                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--}--}}
                {{--});--}}
                {{--$.post('{{route('user.post.data.submit')}}', {--}}
                    {{--//PostAddInputController@postDataSubmit--}}
                    {{--input_field_id: input_field_id,--}}
                    {{--option_field_id: option_field_id,--}}
                    {{--input_field_value: input_field_value,--}}
                    {{--ads_images: imageNames,--}}
                    {{--ads_main_name: $('#ads_main_name').val(),--}}
                    {{--//ads_main_name--}}
                    {{--category_id: '{{$current_category->id}}',--}}
                    {{--//post_image_category--}}
                {{--}, function (data) {--}}
                    {{--if (data == 0) {--}}
                        {{--location.reload();--}}
                    {{--}--}}
                {{--})--}}


                document.getElementById('detail-page-form').submit();
                //PostAddInputController@postDataSubmit
            }

        })
    </script>

@endsection

