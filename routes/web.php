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

/**
 * Image Controller
 */
Route::prefix('/images')->group(function(){
    Route::get('/list/{imageAddedType}', 'ImageController@index')->name('images.collection');
    Route::get('/generateForm', 'ImageController@generateForm')->name('images.generateForm');
    Route::get('/uploadForm', 'ImageController@uploadForm')->name('images.uploadForm');
    Route::post('/store', 'ImageController@store')->name('images.store');
    Route::get('/generate', 'ImageController@getImage')->name('images.generate');
    Route::get('/show', 'ImageController@show')->name('images.show');
    Route::get('/editForm', 'ImageController@editForm')->name('images.editForm');
    Route::put('/update', 'ImageController@update')->name('images.update');
    Route::get('/destroy', 'ImageController@destroy')->name('images.destroy');
});

/**
 * Font Controller
 */
Route::prefix('/font')->group(function(){
    Route::get('', 'FontHelper@index')->name('font.collection');
//    Route::get('/upload', 'FontHelper@upload')->name('fontUploadView');
//    Route::post('/add', 'FontHelper@add')->name('fontAdd');
});




//Route::get('/test', function(){
//    $public = $_SERVER['DOCUMENT_ROOT'].'\public\\';
//
//    dd(is_readable($public.'index.html'));
//   $page = file_get_contents($public.'index.html');
//   $page = str_replace('{data}','변환할 데이터!!', $page);
//
////    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/public/asdf.html', $page);
//   return $page;

//file($public.'index.html');
//    파일을 전체 읽은다음 array에 한줄씩 담아 리턴, 큰 파일은 메모리를 많이먹으므로 fopen 으로 한줄씩 읽어 들여야 한다.
//    array:12 [▼
//  0 => "<!DOCTYPE html>\r\n"
//  1 => "<html lang="en">\r\n"
//  2 => "<head>\r\n"
//  3 => "    <meta charset="UTF-8">\r\n"
//  4 => "    <title>Title</title>\r\n"
//  5 => "</head>\r\n"
//  6 => "<body>\r\n"
//  7 => "ㅋㅋㅋㅋ@ㅎㅎㅎㅎ\r\n"
//  8 => "asdfa@sdf</br>\r\n"
//  9 => "{data}\r\n"
//  10 => "</body>\r\n"
//  11 => "</html>"
//]
//    foreach(file($public.'index.html') as $line){
//        echo '<p>'.explode('@',trim($line))[0].'</p>';
//    }

    // 파일 객체 리턴
//    $fh = fopen($public.'index.html','rb+');
//    fgets() 는 파일 읽어들이는데 개행 문자도 들어옴

//    fwrite($fh, 'heilo~!');
//    fclose($fh);
//    return $public.'index.html';
//    while((! feof($fh)) && ($line = fgets($fh))){
//        $line = trim($line);
//        $info = explode('@',$line);
//        print '<p>'.$info[0].'##'.$info[1].'</p>';
//    }
//});
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














