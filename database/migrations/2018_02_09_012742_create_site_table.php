<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_list', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('domain')->unique()->coment('도메인');
            $table->string('description')->coment('도메인 설명');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_list');
    }
}
