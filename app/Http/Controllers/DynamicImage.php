<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DynamicImage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // php.ini 에 extension=php_gd2.dll 주석 해제야햐 GD라이브러리 사용가능
        // extension_dir = 확장 라이브러리가 설치되어있는 경로를 잡아줘야함
        $base_dir = $_SERVER['DOCUMENT_ROOT'].'/public/img/dynamic/';
        $width = $request->w;
        $height = $request->h;
        $service_name = $request->use;
        $dir_name = $base_dir.$service_name;
        $file_name = $dir_name.'/gd_'.$width.'x'.$height.'.png';

        if(!is_dir($base_dir.$service_name)){
            mkdir($base_dir.$service_name, 0777, true);
        }

        if(file_exists($file_name)){
            return response()->file($file_name);
        }
        $image = imagecreate($width, $height);
        $bg_color = imagecolorallocatealpha($image, 255, 180, 180, 0);
        $font_color = imagecolorallocatealpha($image, 255, 255, 255, 0);
        $font_size = 5;
        $image_string = $width.' x '.$height;
        $pos_x = (imagesx($image) - 9 * strlen($image_string)) / 2;
        $pos_y = (imagesy($image) - 9) / 2;
        imagestring($image, $font_size, $pos_x, $pos_y, $image_string, $font_color);
        imagefill($image, 100, 0, $bg_color);
        imagepng($image, $file_name);
        imagedestroy($image);

        return response()->file($file_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
