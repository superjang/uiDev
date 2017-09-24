<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageGenerator extends Controller
{
    // 동적 이미지 생성 루트 폴더
    private $image_root_directory = '\public\img\dynamic';
    // 기본 이미지 생성 정보
    private $default_image = [
        'service' => 'tmep',
        'prefix' => 'temp',
        'type' => 'png',
        'bg' => ['r' => 34, 'g' => 143, 'b' => 255],
        'opacity' => 0
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
        $image_informations = [
            // required
            'width' => $request->width,
            'height' => $request->height,

            // options
            'service' => isset($request->service) ? $request->service : $this->default_image['service'],
            'prefix' => isset($request->prefix) ? $request->prefix : $this->default_image['prefix'],
            'bg' => [
                'r' => isset($request->r) ? (int)$request->r : $this->default_image['bg']['r'],
                'g' => isset($request->g) ? (int)$request->g : $this->default_image['bg']['g'],
                'b' => isset($request->b) ? (int)$request->b : $this->default_image['bg']['b'],
            ],
            'opacity' => isset($request->opacity) ? $request->opacity : $this->default_image['opacity'],
            'type' => isset($request->type) ? $request->type : $this->default_image['type'],
        ];

        // 이미지 저장위치
        $image_informations['directory'] = $_SERVER['DOCUMENT_ROOT'] . $this->image_root_directory . $image_informations['service'];
        // 이미지 파일명
        $image_informations['file_name'] = $image_informations['prefix'] . '_' . $image_informations['width'] . 'x' . $image_informations['height'] . '_R' . $image_informations['bg']['r'] . 'G' . $image_informations['bg']['g'] . 'B' . $image_informations['bg']['b'] . '.' . $image_informations['type'];
        // 이미지 전체 절대 경로
        $image_informations['file_full_path'] = $image_informations['directory'] . '/' . $image_informations['file_name'];

        return $image_informations;
    }

    /**
     * 요청 파라미터 기준으로 생성된 이미지 정보로 이미지 반환
     * @param Request $request
     * @return mixed
     */
    public function getImage(Request $request)
    {
        $image = $this->getImageInformation($request);
        $image_file_full_path = $image['file_full_path'];

        if (!file_exists($image_file_full_path)) {
            // 이미지 없을 경우 이미지 생성
            $image_file_full_path = $this->makeImage($request);
        }

        // php.ini 에 extension=php_fileinfo 활성화 해야함
        return response()->file($image_file_full_path);
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

        $new_image = imagecreate($image['width'], $image['height']);
        $bg_color = imagecolorallocatealpha($new_image, $image['bg']['r'], $image['bg']['g'], $image['bg']['b'], $image['opacity']);
        $font_color = imagecolorallocatealpha($new_image, 255, 255, 255, 0);
        $font_size = 4;
        $string_size = $image['width'] . 'x' . $image['height'];
        $string_service = $image['service'];
        $pos_x = 5;//(imagesx($new_image) - 9 * strlen($image_string)) / 2;
        $pos_y = 5;//(imagesy($new_image) - 9) / 2;
        imagestring($new_image, $font_size, 5, 20, $string_size, $font_color);
        imagestring($new_image, $font_size, 5, 3, $string_service, $font_color);
        imagefill($new_image, 100, 0, $bg_color);
        imagepng($new_image, $image['file_full_path']);
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
            $each_item = ['pull_path' => $currentDirPath];

            if (is_dir($currentDirPath)) {
                // directory
                $each_item['type'] = 'directory';
            } else {
                // image
                $each_item['type'] = 'image';
            }

            array_push($view_model['data'], $each_item);
        }

        return view('dynamic_image_list')->with($view_model);
    }

//            if(getimagesize($path) !== false){
//               $extension = pathinfo($path, PATHINFO_EXTENSION);
//               if(! in_array($extension, array('gif','png','jpg','jpeg'))){
//                   continue;
//               }

    public function dashboard()
    {

    }
}
