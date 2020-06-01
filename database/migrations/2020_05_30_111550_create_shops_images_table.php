<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id');
            $table->string('file_name');
            $table->string('file_mime');
            $table->string('file_size')->nullable();
            $table->string('file_dimension')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops_images');
    }
}
