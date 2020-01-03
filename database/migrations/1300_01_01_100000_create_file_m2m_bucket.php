<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileM2mBucket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_m2m_bucket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('file_id')->unsigned();
            $table->bigInteger('bucket_id')->unsigned();
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('file')
                ->onUpdate('CASCADE')->onDelete('CASCADE');

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
        Schema::dropIfExists('file_m2m_bucket');
    }
}
