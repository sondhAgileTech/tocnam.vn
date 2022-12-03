<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('order')->default(0);
            $table->integer('parent')->nullable();
            $table->integer('limit_post')->default(5);
            $table->longText('extends')->nullable();
            $table->unsignedInteger('sort_by_category')->nullable();
            $table->unsignedInteger('sort_by_user')->nullable();
            $table->enum('sort_by_time',['asc','desc']);
            $table->enum('type_news',['news','video']);
            $table->string('style');
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
        Schema::dropIfExists('widgets');
    }
}
