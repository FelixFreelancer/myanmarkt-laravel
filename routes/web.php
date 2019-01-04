<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

//Route::get('/', 'HomeController@index')->name('index')->middleware('verified') ;
Auth::routes();
//['verify' => true]

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('/post-add', 'PostAddController@index')->name('user.post.add');
Route::get('/post-add/{category}', 'PostAddController@postSubCategory');
Route::get('/post-add/sub-category/{level}', 'PostAddController@postSubSubCategory');
Route::get('/post-add/post-input/{child_id}/{parent_level}', 'PostAddInputController@index');
Route::post('/post-add/post-image', 'PostAddInputController@postImageUpload');
//image delete
Route::post('/post-add/image-delete', 'PostAddInputController@postImageDelete');
Route::post('/post-add/post-data/submit', 'PostAddInputController@postDataSubmit')->name('user.post.data.submit');

// user post page
Route::get('/user-ads', 'UserAdsController@index')->name('user.ads');
Route::get('/user-ads/edit/{ads_id}', 'UserAdsController@editUserAds');
Route::post('/user-ads/update', 'UserAdsController@updateUserAds')->name('user.ads.update');
Route::post('/user/image/delete', 'UserAdsController@deleteImage')->name('user.ads.photo.delete');
Route::post('/user/ads/delete', 'UserAdsController@deleteAds')->name('user.ads.delete');

//user profile page
Route::get('/user/edit/', 'UserController@editUser')->name('user.settings');
Route::post('/user/update', 'UserController@profileUpdate')->name('user.profile.update');

//Authentication
//Route::get('/login/email', 'Auth\LoginController')->name('login.email');
//admin routes group
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@loginFunction')->name('admin.login.submit');
Route::get('/admin/categories', 'CategoryController@index');
Route::get('/admin/categories/add', 'CategoryController@addCategory');
Route::post('/admin/categories/add', 'CategoryController@store')->name('admin.category.add');
//new category field add
Route::post('/admin/categories/field-add', 'CategoryFieldController@postFieldAdd');
Route::get('/admin/categories-fields/{category_id}', 'CategoryFieldController@getFieldsIndex');
Route::post('/admin/categories-fields/delete-field/', 'CategoryFieldController@deleteField');
Route::post('/admin/categories-fields/edit-field/', 'CategoryFieldController@getEditField');
Route::post('/admin/categories-fields/save-field/', 'CategoryFieldController@postSaveField');
Route::post('/admin/categories-fields/option-add/', 'CategoryFieldController@postAddOptionField');
Route::post('/admin/categories-fields/option-save/', 'CategoryFieldController@postSaveOptionField');
Route::post('/admin/categories-fields/option-delete/', 'CategoryFieldController@deleteOptionField');

//new
Route::get('/admin/categories/{id}', 'CategoryController@editCategory');
Route::post('/admin/categories/{id}/update', 'CategoryController@updateCategory');
Route::get('/admin/categories/delete/{id}', 'CategoryController@deleteCategory');

//ads show route
Route::get('/category/{main_category_id}/{category_id}', 'AdsViewController@index');
//test route
Route::get('/category-test', function () {
    return Layer2222::getParentLevel(1010101);
});

Route::get('/search-fields', function () {
    return SearchFields::searchFields(3);
});