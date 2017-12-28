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

// ULR 필터링 방법 - pattern
//Route::pattern('aaa', '[0-9a-zA-Z]{3}');
//Route::get('/{foo?}', function($foo = 'bar'){
//   return $foo;
//});

// ULR 필터링 방법 - where
//Route::get('/{foo?}', function($foo = 'bar'){
//    return $foo;
//})->where('foo', '[0-9a-zA-Z]{3}');
Route::get('/', function(){
    $viewModel = [];
    return view('index')->with($viewModel);
})->name('index');

Route::prefix('/image')->group(function(){
    Route::get('/', 'ImageGenerator@main')->name('imageMain');
    Route::get('/generation', 'ImageGenerator@getImage')->name('generation');
    Route::get('/list', 'ImageGenerator@listingImage')->name('listing');
});

Route::prefix('/font')->group(function(){
    Route::get('/', 'FontHelper@index')->name('fontMain');
});
//route('generate', ['width'=>100,'height'=>200]);
