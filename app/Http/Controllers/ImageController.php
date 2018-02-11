<?php

namespace App\Http\Controllers;

use App\GeneratedImage;
use App\UploadedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    // 사이트(도메인) 리스트
    private $site_list = [
        'Gmarket-PC',
        'Gmarket-Mobile',
        'Auction-PC',
        'Auction-Mobile',
        'G9-PC',
        'G9-Mobile',
        'Etc'
    ];

    // 동적 이미지 생성 위치
    private $image_root_directory_path = '/public/images/uploads';

    // 생성 이미지 포멧
    private $image_format_type = ['png','jpg','gif'];

    // 기본 이미지 생성 정보
    private $default_image = [
        'service' => 'default', // directory name
        'tag' => '', // filename tag
        'image_format_type' => 'png', // file extension
        'color' => '6482d8', // file background color
        'opacity' => 0 // file opacity
    ];

    /**
     * 요청 파라미터에서 이미지 생성에 필요한 연관배열 생성하여 반환
     * @param Request $request
     * @return array - 이미지 생성 값 연관배열
     */
    private function getImageGenerationInformation(Request $request)
    {
        // 이미지 필수 값 벨리데이션
        $this->validate($request, [
            'width' => 'required',
            'height' => 'required'
        ]);

        // 이미지 생성 정보
        $image = [
            // required
            'width' => $request->width,
            'height' => $request->height,
            'site' => $request->site,
            'image_format_type' => $this->image_format_type,

            // options
            'service' => isset($request->service) ? $request->service : $this->default_image['service'],
            'tag' => isset($request->tag) ? $request->tag : $this->default_image['tag'],
            'color' => isset($request->color) ? $request->color : $this->default_image['color'],
            'opacity' => isset($request->opacity) ? $request->opacity : $this->default_image['opacity'],
            'image_format_type' => isset($request->image_format_type) ? $request->image_format_type : $this->default_image['image_format_type'],
        ];

        // 이미지 파일명
        $image['file_name'] = isset($image['tag']) ? $image['tag'] . '_' : '';
        $image['file_name'] .= $image['width'] . 'x' . $image['height'];
        $image['file_name'] .= '_' . $image['color'];
        $image['file_name'] .= '_' . $image['opacity'];
        $image['file_name'] .= '.' . $image['image_format_type'];

        // 이미지 저장위치
        $image['directory_path'] = $_SERVER['DOCUMENT_ROOT'] . $this->image_root_directory_path  .'/'. $image['service'];

        // 이미지 전체 절대 경로
        $image['full_path'] = $image['directory_path'] . '/' . $image['file_name'];

        // 이미지 request URL
        $image['request_path'] = $this->image_root_directory_path .'/'. $image['service'] . '/' . $image['file_name'];

        // 이미지 생성 queryString
        $image['query_param'] = 'width='.$request->width;
        $image['query_param'] .= '&height='.$request->height;
        $image['query_param'] .= '&image_format_type='.$request->image_format_type;
        $image['query_param'] .= $request->service ? '&service='.$request->service : '';
        $image['query_param'] .= $request->tag ? '&prefix='.$request->tag : '';
        $image['query_param'] .= $request->color ? '&color='.$request->color : '';
        $image['query_param'] .= $request->opacity ? '&opacity='.$request->opacity : '';

        return $image;
    }

    private function getImageUploadInformation(Request $request)
    {
        $file = $request->file('file');
        $service = $request->service ? $request->service : $this->default_image['service'];
        $site = $request->site;
        $tag = $request->tag ? $request->tag: $this->default_image['tag'];
        $file_name = $tag.'_'.$file->getClientOriginalName();
        $directory_path = public_path('/images/uploads') .'/'.$site.'/'.$service;
        $request_path = $this->image_root_directory_path .'/'.$site.'/'.$service.'/'.$file_name;

        $view_model = [
            'service'=>$service,
            'site'=>$site,
            'tag'=>$tag,
            'file'=>$file,
            'image_format_type'=> explode('.',$file->getClientOriginalName())[1],
            'file_name'=>$file_name,
            'directory_path'=> $directory_path,
            'full_path'=> $directory_path.'/'.$file_name,
            'request_path' => $request_path
        ];

        return $view_model;
    }

    /**
     * 요청 파라미터 기준으로 생성된 이미지 정보로 이미지 반환
     * @param Request $request
     * @return mixed
     */
    public function getImage(Request $request)
    {
        $view_model = $this->getImageGenerationInformation($request);
        $image_data = $this->hasSameImage('image_generate_store', $view_model['full_path']);

        if( !$image_data ) {
            // 이미지 없을 경우 이미지 생성 & 이미지 DB 추가
            $view_model = $this->generateImage($view_model);
        } else {
            $view_model = $image_data;
        }

        // php.ini 에 extension=php_fileinfo 활성화 해야함
        return response()->file($view_model['full_path']);
    }

    /**
     * 요청 파라미터 기준으로 신규 이미지 생성
     * @param Request $request
     * @return mixed
     */
    public function generateImage($view_model)
    {
        // php.ini 에 extension=php_gd2.dll 주석 해제야햐 GD라이브러리 사용가능
        // extension_dir = 확장 라이브러리가 설치되어있는 경로를 잡아줘야함
//        $image = $this->getImageGenerationInformation($request);

        if (!is_dir($view_model['directory_path'])) {
            mkdir($view_model['directory_path'], 0777, true);
        }

        list($r, $g, $b) = sscanf($view_model['color'], "%02x%02x%02x");
        $new_image = imagecreate($view_model['width'], $view_model['height']);
        $bg_color = imagecolorallocatealpha($new_image, $r, $g, $b, $view_model['opacity']);
        $font_color = imagecolorallocatealpha($new_image, 255, 255, 255, 0);
        $font_size = 5;
        $string_size = $view_model['width'] . ' x ' . $view_model['height'];
        $pos_x = (imagesx($new_image) - imagefontwidth($font_size)*strlen($string_size)) / 2;
        $pos_y = (imagesy($new_image) - imagefontheight($font_size)) / 2;
        imagestring($new_image, $font_size, $pos_x, $pos_y, $string_size, $font_color);
        imagefill($new_image, 100, 0, $bg_color);

        switch( $view_model['image_format_type'] ){
            case 'png':
                imagepng($new_image, $view_model['full_path']);
                break;
            case 'jpg':
                imagejpeg($new_image, $view_model['full_path']);
                break;
            case 'gif':
                imagegif($new_image, $view_model['full_path']);
                break;
        }

        imagedestroy($new_image);

        // Image Add
        $imageStore = new GeneratedImage;
        $imageStore->image_added_type = 'generated';
        $imageStore->site = $view_model['site'];
        $imageStore->service = $view_model['service'];
        $imageStore->tag = $view_model['tag'];
        $imageStore->image_format_type = $view_model['image_format_type'];
        $imageStore->color = $view_model['color'];
        $imageStore->width = $view_model['width'];
        $imageStore->height = $view_model['height'];
        $imageStore->opacity = $view_model['opacity'];
        $imageStore->file_name = $view_model['file_name'];
        $imageStore->directory_path = $view_model['directory_path'];
        $imageStore->full_path = $view_model['full_path'];
        $imageStore->request_path = $view_model['request_path'];
        $imageStore->save();

        return $view_model;
    }

    /**
     * 요청 파라미터 기준으로 신규 이미지 업로드
     * @param Request $request
     * @return mixed
     */
    public function uploadImage($view_model)
    {
        if (!is_dir($view_model['directory_path'])) {
            mkdir($view_model['directory_path'], 0777, true);
        }

        $view_model['file']->move($view_model['directory_path'], $view_model['file_name']);

        $imageStore = new UploadedImage;
        $imageStore->image_added_type = 'upload';
        $imageStore->service = $view_model['service'];
        $imageStore->site = $view_model['site'];
        $imageStore->tag = $view_model['tag'];
        $imageStore->image_format_type = $view_model['image_format_type'];
        $imageStore->file_name = $view_model['file_name'];
        $imageStore->directory_path = $view_model['directory_path'];
        $imageStore->full_path = $view_model['full_path'];
        $imageStore->request_path = $view_model['request_path'];
        $imageStore->save();

        return $view_model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($imageAddedType = 'generated', Request $request)
    {
        $PAGINATION = 10;
        $view_model = [];

        switch( $imageAddedType ){
            case 'generated':
                $view_model['data'] = GeneratedImage::latest()->paginate($PAGINATION);
                break;
            case 'upload':
                $view_model['data'] = UploadedImage::latest()->paginate($PAGINATION);
                break;
        }

        return view('image/list')->with($view_model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateForm(Request $request)
    {
        $view_model['site_list'] = $this->site_list;
        $view_model['image_format_type'] = $this->image_format_type;

        return view('image/generate')->with($view_model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadForm()
    {
        $view_model['site_list'] = $this->site_list;

        return view('image/upload')->with($view_model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageFrom = $request->image_added_type;

        switch( $imageFrom ){
            case 'generate' :
                $view_model = $this->generateStore($request);

                return redirect()
                    ->route('images.generateForm')
                    ->with('site', $view_model['site'])
                    ->with('service', $view_model['service'])
                    ->with('tag', $view_model['tag'])
                    ->with('full_path', $this->image_root_directory_path .'/'.$view_model['service'].'/'.$view_model['file_name'])
                    ->with('request_path', route('images.generate').'?'.$view_model['query_param'])
                    ->withInput($view_model);
                break;
            case 'upload' :
                $view_model = $this->uploadStore($request);

                return redirect()
                    ->route('images.uploadForm')
                    ->with('site', $view_model['site'])
                    ->with('service', $view_model['service'])
                    ->with('tag', $view_model['tag'])
                    ->with('request_path', $request->getSchemeAndHttpHost().$view_model['request_path'])
                    ->withInput($view_model);
                break;
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function generateStore($request)
    {
        $this->validate($request, [
            'image_format_type' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);

        $view_model = $this->getImageGenerationInformation($request);
        $image_data = $this->hasSameImage('image_generate_store', $view_model['full_path']);

        // 이미지 없을 경우 이미지 생성 & 이미지 DB 추가
        return !$image_data ? $this->generateImage($view_model) : $image_data;
    }

    public function uploadStore($request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        $view_model = $this->getImageUploadInformation($request);
        $image_data = $this->hasSameImage('image_upload_store', $view_model['full_path']);

        return !$image_data ? $this->uploadImage($view_model) : $image_data;
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
    public function editForm($id)
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
    public function destroy(Request $request)
    {
        $table_name = null;

        switch ( $request->image_added_type ){
            case 'generated':
                $table_name = 'image_generate_store';
                break;
            case 'upload':
                $table_name = 'image_upload_store';
                break;
        }

        DB::table($table_name)->where('request_path', $request->destory_key)->delete();

        return redirect()->back();
    }

    private function hasSameImage($table, $searchValue)
    {
        $imageTable = DB::table($table)->where('full_path','=', $searchValue);

        return $imageTable->count() === 0 ? false : $imageTable;
    }
}
