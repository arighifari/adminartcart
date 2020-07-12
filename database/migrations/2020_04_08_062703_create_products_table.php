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
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('qty')->default(0);
            $table->string('title');
            $table->integer('price');
            $table->text('description');
            $table->string('image');
            $table->string('keyword');
            $table->integer('special')->nullable();
            $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image');
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
