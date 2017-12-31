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



Route::get('/', function(){ return view('index'); })->name('index');
Route::prefix('/image')->group(function(){
    Route::get('/generate', 'ImageGenerator@main')->name('imageGenerate');
    Route::get('/upload', 'ImageGenerator@upload')->name('imageUpload');
    Route::post('/ffff', 'ImageGenerator@ffff')->name('controller_upload');
    Route::get('/generation', 'ImageGenerator@getImage')->name('generation');
    Route::get('/list', 'ImageGenerator@listingImage')->name('listing');
    Route::get('/make', 'ImageGenerator@make')->name('imageMake');
});
Route::prefix('/font')->group(function(){
    Route::get('/', 'FontHelper@index')->name('fontMain');
});























