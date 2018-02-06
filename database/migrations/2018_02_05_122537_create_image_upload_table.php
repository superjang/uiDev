<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_upload_store', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image_type')->comment('이미지 생성타입');
            $table->string('service')->comment('이미지 사용되는 서비스명');
            $table->string('format')->comment('이미지 포맷');
            $table->string('full_path')->unique()->comment('이미지 전체 경로');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_upload_store');
    }
}
