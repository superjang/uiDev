<?php

namespace App\Http\Controllers;

use App\GeneratedImage;
use App\UploadedImage;
use Illuminate\Http\Request;

class ImageHelper extends Controller
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
    public function getImageInformation(Request $request)
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

        if (!\File::exists($image['file_full_path'])) {
            // 이미지 없을 경우 이미지 생성
            $image['file_full_path'] = $this->makeImage($request);
        }

        // php.ini 에 extension=php_fileinfo 활성화 해야함
        return response()->file($image['file_full_path']);
    }

    /**
     * 요청 파라미터 기준으로 신규 이미지 생성
     * @param Request $request
     * @return mixed
     */
    public function makeImage(Request $request)
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

    public function listingImage()
    {
        $root_dir_name = $_SERVER['DOCUMENT_ROOT'] . $this->image_root_directory;
        $dir_list = scandir($root_dir_name, 1);
        $view_model['data'] = [];

        foreach ($dir_list as $item) {
            if ($item === '.' or $item === '..') {
                continue;
            }

            $currentDirPath = $root_dir_name . '/' . $item;
            $each_item = ['service' => $item];
            $each_item['current_item'] = $this->image_root_directory.'/'.$item;

            if (is_dir($currentDirPath)) {
                // directory
                $each_item['type'] = 'directory';
            } else {
                // image
                $each_item['type'] = 'image';
            }

            array_push($view_model['data'], $each_item);
        }

        return view('image/dynamic_image_list')->with($view_model);
    }

//            if(getimagesize($path) !== false){
//               $extension = pathinfo($path, PATHINFO_EXTENSION);
//               if(! in_array($extension, array('gif','png','jpg','jpeg'))){
//                   continue;
//               }

    public function main()
    {
        $root_dir_name = $_SERVER['DOCUMENT_ROOT'] . $this->image_root_directory;
        $dir_list = scandir($root_dir_name, 1);
//        $view_model['data'] = [];
//        $view_model['data']['serviceList'] = [];
        $view_model['image_format'] = $this->image_format;

//        foreach ($dir_list as $item) {
//            if ($item === '.' or $item === '..') {
//                continue;
//            }
//
//            array_push($view_model['data']['serviceList'], $item);
//        }
//        dd($view_model);
        return view('image/generate')->with($view_model);
    }

    public function make(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);

        $image = $this->getImageInformation($request);
        $view_model = $image;
        $view_model['image_format'] = $this->image_format;

        if (!\File::exists($image['file_full_path'])) {
            // 이미지 없을 경우 이미지 생성
            $image['file_full_path'] = $this->makeImage($request);

            $imageStore = new GeneratedImage;
            $imageStore->image_type = 'generated';
            $imageStore->service = $image['service'];
            $imageStore->format = $image['type'];
            $imageStore->width = $image['width'];
            $imageStore->height = $image['height'];
            $imageStore->prefix = $image['prefix'];
            $imageStore->color = $image['bgColor'];
            $imageStore->opacity = $image['opacity'];
            $imageStore->full_path = $image['file_full_path'];
            $imageStore->real_path = $image['directory'];
            $imageStore->file_name = $image['file_name'];
            $imageStore->save();
        }

        $param = '';
        $param .= 'width='.$request->width;
        $param .= '&height='.$request->height;
        $param .= '&type='.$request->type;
        $param .= $request->service ? '&service='.$request->service : '';
        $param .= $request->prefix ? '&prefix='.$request->prefix : '';
        $param .= $request->bgColor ? '&bgColor='.$request->bgColor : '';
        $param .= $request->opacity ? '&opacity='.$request->opacity : '';

        if($request->requestFrom === 'view'){
            return redirect()
                ->route('imageGenerate')
                ->with('service', $request->service)
                ->with('service', $request->prefix)
                ->with('requestUrl',  $request->getSchemeAndHttpHost().'/image/generation?'.$param)
                ->with('fileFullPath', $this->image_root_directory.'/'.$image['service'].'/'.$image['file_name'])
                ->withInput($view_model);
        }else{
            return $this->getImage($request);
        }
    }

    public function upload(Request $request)
    {
        $root_dir_name = $_SERVER['DOCUMENT_ROOT'] . $this->image_root_directory;
        $dir_list = scandir($root_dir_name, 1);
        $view_model['data'] = [];
        $view_model['data']['serviceList'] = [];

        foreach ($dir_list as $item) {
            if ($item === '.' or $item === '..') {
                continue;
            }

            array_push($view_model['data']['serviceList'], $item);
        }

        return view('image/upload')->with($view_model);
    }

    public function ffff(Request $request)
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

        if (!\File::exists($file_full_path)) {
            $file->move(public_path('/images/uploads') .'/'.$service, $filename);
        }

        $viewModel = [
            'service'=>$request->service,
            'prefix'=>$request->prefix,
            'file'=>$file,
            'fileName'=>$file->getClientOriginalName(),
            'fileFullPath'=> $request->getSchemeAndHttpHost().$this->image_root_directory.'/'.$service.'/'.$filename,
        ];

        return redirect()
            ->route('imageUpload')
            ->with('fileFullPath', $request->getSchemeAndHttpHost().$this->image_root_directory.'/'.$service.'/'.$filename)
            ->withInput($viewModel);
    }
}
