<?php

namespace App\Http\Controllers;

use App\GeneratedImage;
use App\UploadedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
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
     * 요청 파라미터에서 이미지 생성에 필요한 연관배열 생성하여 반환
     * @param Request $request
     * @return array - 이미지 생성 값 연관배열
     */
    private function getImageInformation(Request $request)
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
            'image_format' => $this->image_format,

            // options
            'service' => isset($request->service) ? $request->service : $this->default_image['service'],
            'prefix' => isset($request->prefix) ? $request->prefix : $this->default_image['prefix'],
            'bgColor' => isset($request->bgColor) ? $request->bgColor : $this->default_image['bgColor'],
            'opacity' => isset($request->opacity) ? $request->opacity : $this->default_image['opacity'],
            'type' => isset($request->type) ? $request->type : $this->default_image['type'],
        ];

        // 이미지 저장위치
        $image['directory'] = $_SERVER['DOCUMENT_ROOT'] . $this->image_root_directory .'/'. $image['service'];

        // 이미지 파일명
        $image['file_name'] = isset($image['prefix']) ? $image['prefix'] . '_' : '';
        $image['file_name'] .= $image['width'] . 'x' . $image['height'];
        $image['file_name'] .= '_' . $image['bgColor'];
        $image['file_name'] .= '_' . $image['opacity'];
        $image['file_name'] .= '.' . $image['type'];

        // 이미지 전체 절대 경로
        $image['file_full_path'] = $image['directory'] . '/' . $image['file_name'];

        return $image;
    }

    /**
     * 요청 파라미터 기준으로 생성된 이미지 정보로 이미지 반환
     * @param Request $request
     * @return mixed
     */
    public function getImage(Request $request)
    {
        $image = $this->getImageInformation($request);

//        if (!\File::exists($image['file_full_path'])) {
        if(!$this->hasSameImage('image_generate_store', $image['file_full_path'])) {
            // 이미지 없을 경우 이미지 생성
            $image['file_full_path'] = $this->generateImage($request);
        }

        // php.ini 에 extension=php_fileinfo 활성화 해야함
        return response()->file($image['file_full_path']);
    }

    /**
     * 요청 파라미터 기준으로 신규 이미지 생성
     * @param Request $request
     * @return mixed
     */
    public function generateImage($request)
    {
        // php.ini 에 extension=php_gd2.dll 주석 해제야햐 GD라이브러리 사용가능
        // extension_dir = 확장 라이브러리가 설치되어있는 경로를 잡아줘야함
        $image = $this->getImageInformation($request);

        if (!is_dir($image['directory'])) {
            mkdir($image['directory'], 0777, true);
        }

        list($r, $g, $b) = sscanf($image['bgColor'], "%02x%02x%02x");
        $new_image = imagecreate($image['width'], $image['height']);
        $bg_color = imagecolorallocatealpha($new_image, $r, $g, $b, $image['opacity']);
        $font_color = imagecolorallocatealpha($new_image, 255, 255, 255, 0);
        $font_size = 5;
        $string_size = $image['width'] . ' x ' . $image['height'];
        $pos_x = (imagesx($new_image) - imagefontwidth($font_size)*strlen($string_size)) / 2;
        $pos_y = (imagesy($new_image) - imagefontheight($font_size)) / 2;
        imagestring($new_image, $font_size, $pos_x, $pos_y, $string_size, $font_color);
        imagefill($new_image, 100, 0, $bg_color);

        switch( $image['type'] ){
            case 'png':
                imagepng($new_image, $image['file_full_path']);
                break;
            case 'jpg':
                imagejpeg($new_image, $image['file_full_path']);
                break;
            case 'gif':
                imagegif($new_image, $image['file_full_path']);
                break;
        }

        imagedestroy($new_image);

        return $image['file_full_path'];
    }

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
    public function generateForm(Request $request)
    {
        $view_model['image_format'] = $this->image_format;

        return view('image/generate')->with($view_model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadForm()
    {
//        $view_model['data'] = [];
//        return view('image/upload')->with($view_model);
        return view('image/upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $imageFrom = $request->createType;

        switch( $imageFrom ){
            case 'generate' :
                $view_model = $this->generateStore($request);

                return redirect()
                    ->route('images.generateForm')
                    ->with('service', $view_model['service'])
                    ->with('prefix', $view_model['prefix'])
                    ->with('requestUrl', route('images.generate').'?'.$view_model['query_param'])
                    ->with('fileFullPath', $this->image_root_directory.'/'.$view_model['service'].'/'.$view_model['file_name'])
                    ->withInput($view_model);
                break;
            case 'upload' :
                $view_model = $this->uploadStore($request);

                return redirect()
                    ->route('images.uploadForm')
                    ->with('fileFullPath', $request->getSchemeAndHttpHost().$view_model['fileFullPath'])
                    ->withInput($view_model);
                break;
        }
    }

    public function generateStore($request)
    {
        $this->validate($request, [
            'type' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);

        $view_model = $this->getImageInformation($request);

//        DB::table('image_generate_store')->orderBy('id')->chunk(100, function ($users) {
//            foreach ($users as $user) {
//                //
//            }
//        });

        // TODO 파일 조회 -> DB 조회
//        if (!\File::exists($view_model['file_full_path'])) {
        if(!$this->hasSameImage('image_generate_store', $view_model['file_full_path'])) {
            // 이미지 없을 경우 이미지 생성
            $view_model['file_full_path'] = $this->generateImage($request);

            $imageStore = new GeneratedImage;
            $imageStore->image_type = 'generated';
            $imageStore->service = $view_model['service'];
            $imageStore->format = $view_model['type'];
            $imageStore->width = $view_model['width'];
            $imageStore->height = $view_model['height'];
            $imageStore->prefix = $view_model['prefix'];
            $imageStore->color = $view_model['bgColor'];
            $imageStore->opacity = $view_model['opacity'];
            $imageStore->full_path = $view_model['file_full_path'];
            $imageStore->real_path = $view_model['directory'];
            $imageStore->file_name = $view_model['file_name'];
            $imageStore->save();
        }

        $view_model['query_param'] = '';
        $view_model['query_param'] .= 'width='.$request->width;
        $view_model['query_param'] .= '&height='.$request->height;
        $view_model['query_param'] .= '&type='.$request->type;
        $view_model['query_param'] .= $request->service ? '&service='.$request->service : '';
        $view_model['query_param'] .= $request->prefix ? '&prefix='.$request->prefix : '';
        $view_model['query_param'] .= $request->bgColor ? '&bgColor='.$request->bgColor : '';
        $view_model['query_param'] .= $request->opacity ? '&opacity='.$request->opacity : '';

        return $view_model;
    }

    public function uploadStore($request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $service = $request->service ? $request->service : $this->default_image['service'];
        $prefix = $request->prefix ? $request->prefix . '_': $this->default_image['prefix'];
        $filename = $prefix .'_'. $file->getClientOriginalName();
        $file_full_path = public_path('/images/uploads') .'/'.$service.'/'.$filename;

        if (!is_dir($service)) {
            mkdir($service, 0777, true);
        }

//        if (!\File::exists($file_full_path)) {
        if(!$this->hasSameImage('image_upload_store',$file_full_path)) {
            $file->move(public_path('/images/uploads') .'/'.$service, $filename);
        }

        $view_model = [
            'service'=>$request->service,
            'prefix'=>$request->prefix,
            'file'=>$file,
            'fileName'=>$file->getClientOriginalName(),
            'fileFullPath'=> $this->image_root_directory.'/'.$service.'/'.$filename,
        ];

        $imageStore = new UploadedImage;
        $imageStore->image_type = 'upload';
        $imageStore->service = $view_model['service'];
        $imageStore->format = explode('.',$file->getClientOriginalName())[1];
        $imageStore->full_path = $view_model['fileFullPath'];
        $imageStore->real_path = $_SERVER['DOCUMENT_ROOT'].$this->image_root_directory.'/'.$service.'/'.$view_model['fileName'];
        $imageStore->file_name = $view_model['fileName'];
        $imageStore->save();

        return $view_model;
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
    public function destroy($id)
    {
        //
    }

    private function hasSameImage($table, $imagePath)
    {
        return DB::table($table)->where('full_path','=', $imagePath)->count() === 0 ? false : true;
    }
}
