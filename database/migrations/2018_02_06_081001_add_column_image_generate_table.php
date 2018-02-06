<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnImageGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_generate_store', function (Blueprint $table) {
            $table->string('real_path')->unique()->comment('이미지 저장 경로');
            $table->string('file_name')->comment('이미지 파일명');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_generate_store', function (Blueprint $table) {
            //
        });
    }
}
