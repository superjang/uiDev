<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesGenerateController extends Controller
{
    // 동적 이미지 생성 위치
    private $image_root_directory = '/public/images/uploads';

    // 생성 이미지 포멧
    private $image_format = ['png','jpg','gif'];

    // 기본 이미지 생성 정보
    private $default_image = [
        'service' => 'default', // directory name
        'prefix' => '', // filename prefix
        'type' => 'png', // file extension
        'bgColor' => '6482d8', // file background color
        'opacity' => 0 // file opacity
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $view_model['image_format'] = $this->image_format;
        return view('image/generate')->with($view_model);
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
