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

// index
Route::get('/', function(){ return view('index'); })->name('index');

// image
Route::prefix('/image')->group(function(){
    Route::get('/generate', 'ImageHelper@main')->name('imageGenerate');
    Route::get('/upload', 'ImageHelper@upload')->name('imageUpload');
    Route::post('/ffff', 'ImageHelper@ffff')->name('controller_upload');
    Route::get('/generation', 'ImageHelper@getImage')->name('generation');
    Route::get('/list', 'ImageHelper@listingImage')->name('listing');
    Route::get('/make', 'ImageHelper@make')->name('imageMake');
});

// font
Route::prefix('/font')->group(function(){
    Route::get('/', 'FontHelper@index')->name('fontMain');
});




//route('generate', ['width'=>100,'height'=>200]);


// ULR 필터링 방법 - pattern
//Route::pattern('aaa', '[0-9a-zA-Z]{3}');
//Route::get('/{foo?}', function($foo = 'bar'){
//   return $foo;
//});

// ULR 필터링 방법 - where
//Route::get('/{foo?}', function($foo = 'bar'){
//    return $foo;
//})->where('foo', '[0-9a-zA-Z]{3}');














