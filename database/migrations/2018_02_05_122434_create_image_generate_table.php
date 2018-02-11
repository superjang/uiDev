<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_generate_store', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image_added_type')->comment('이미지 추가 타입 [생성/업로드]');
            $table->string('site')->comment('이미지가 사용 될 사이트');
            $table->string('service')->comment('이미지 사용되는 서비스명');
            $table->string('tag')->comment('이미지 태그 구분자');
            $table->string('image_format_type')->comment('이미지 포맷');
            $table->string('color')->comment('이미지 색상값');
            $table->integer('width')->unsigned()->comment('이미지 가로값');
            $table->integer('height')->unsigned()->comment('이미지 세로값');
            $table->integer('opacity')->default(0)->unsigned()->nullable()->comment('이미지 투명도');
            $table->string('file_name')->comment('이미지 파일명');
            $table->string('directory_path')->comment('이미지 파일 디렉토리');
            $table->string('full_path')->unique()->comment('이미지 전체 경로');
            $table->string('request_path')->unique()->comment('이미지 저장 경로');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_generate_store');
    }
}
