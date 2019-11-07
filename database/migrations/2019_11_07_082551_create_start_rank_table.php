<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartRankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('start_rank', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('username')->nullable();
            $table->string('description')->nullable();
            $table->string('picture')->nullable();
            $table->integer('like')->nullable();
            $table->integer('dislike')->nullable();

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
        Schema::dropIfExists('start_rank');
    }
}
