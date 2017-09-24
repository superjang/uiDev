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
Route::get('/', function(){
//    error_reporting(E_ALL);
   $dynamicImageDir = $_SERVER['DOCUMENT_ROOT'].'\public\img\dynamic';
   $arr = ['apple','banana','orange'];
   echo __DIR__;
   echo in_array('oran',$arr);
//   dd(is_numeric($data));
});
Route::get('/image/make', 'ImageGenerator@getImage');
Route::get('/image/list', 'ImageGenerator@listingImage');
//Route::get('/image/dashboard', 'DynamicImage@index');
//
//Route::resource('/image', 'DynamicImage',
//    ['names' => [
//
//    ]]
//);
