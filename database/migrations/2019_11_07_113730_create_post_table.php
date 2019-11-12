<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('username')->nullable();
            $table->string('description')->nullable();
            $table->integer('like')->nullable();
            $table->integer('dislike')->nullable();
            $table->integer('view')->nullable();
            $table->integer('comment')->nullable();
            $table->integer('star')->nullable();
            $table->string('picture')->nullable();

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
        Schema::dropIfExists('post');
    }
}
