<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slugs')->unique();
            $table->string('description_news')->nullable();
            $table->longText('content_news')->nullable();
            $table->integer('status');
            $table->string('img_news')->nullable();
            $table->string('keywords_news')->nullable();
            $table->enum('type_news',['news','video']);
            $table->string('video_news')->nullable();
            $table->unsignedInteger('id_categories');
            $table->foreign('id_categories')->references('id')->on('categories');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('admin_users');
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
        Schema::dropIfExists('news');
    }
}
