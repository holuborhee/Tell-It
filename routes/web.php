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

/*Route::get('/', function () {
    return view('test');
});*/
Route::get('/', 'GuestController@index');

Route::get('/test', 'HomeController@test');

Route::resource('user', 'UserController');
Route::resource('post', 'PostController');
Route::resource('article', 'ArticleController');

Route::resource('report', 'TextPostController');
Route::resource('photos', 'PicturePostController');
Route::resource('videos', 'VideoPostController');
Route::resource('breaking-news', 'BreakingNewsController');

Route::resource('category', 'CategoryController');
Route::resource('column', 'ColumnController');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/customize', 'HomeController@customize')->middleware('admin');

Route::get('/editpersonal/changepassword', 'HomeController@changePassword');
Route::post('/checkpassword', 'HomeController@checkpassword');

Route::post('/postpassword', 'HomeController@postPassword');


Route::get('/advert', 'HomeController@adverts');



Route::post('/uploadphotos', 'PhotoUploadController@photoNews');
Route::post('/removephotos', 'PhotoUploadController@removephotoNews');
Route::post('/articlephoto', 'PhotoUploadController@articleDisplayPicture');
Route::post('/reportphoto', 'PhotoUploadController@postDisplayPicture');
Route::post('/uploadadvert', 'PhotoUploadController@newAdvert');
Route::post('/uploadprofilephoto', 'PhotoUploadController@displayPicture');
