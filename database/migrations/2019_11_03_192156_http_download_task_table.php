<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HttpDownloadTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('http_download_task', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->integer('status_id');
            $table->float('progress');
            $table->timestamps();

//            $table->foreign('status_id')->references('id')->on('ref_http_download_task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('http_download_task');
    }
}
