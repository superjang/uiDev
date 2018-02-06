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
            $table->string('image_type')->comment('이미지 생성타입');
            $table->string('service')->comment('이미지 사용되는 서비스명');
            $table->string('format')->comment('이미지 포맷');
            $table->string('full_path')->unique()->comment('이미지 전체 경로');
            $table->string('color')->comment('이미지 색상값');
            $table->integer('width')->unsigned()->comment('이미지 가로값');
            $table->integer('height')->unsigned()->comment('이미지 세로값');
            $table->string('prefix')->nullable()->comment('이미지명 프리픽스');
            $table->integer('opacity')->unsigned()->nullable()->comment('이미지 투명도');
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
