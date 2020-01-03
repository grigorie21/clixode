<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHttpDownloadTaskTable extends Migration
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
            $table->integer('ref_http_download_task_status_id')->unsigned();
            $table->bigInteger('bucket_id')->unsigned();
            $table->float('progress');
            $table->timestamps();

            $table->foreign('ref_http_download_task_status_id')->references('id')
                ->on('ref_http_download_task_status')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->foreign('bucket_id')->references('id')->on('bucket_file')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
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
