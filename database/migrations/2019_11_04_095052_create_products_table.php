<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->nullable();
            $table->string('short_description')->nullable();
            $table->string('long_description')->nullable();
            $table->string('category')->nullable();
            $table->string('squ')->nullable();
            $table->string('type')->nullable();
            $table->string('price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->string('brand')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('available')->nullable()->default(1);

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
        Schema::dropIfExists('products');
    }
}
