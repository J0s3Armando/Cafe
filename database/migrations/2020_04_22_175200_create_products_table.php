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
            $table->id();
            $table->string('description');
            $table->integer('price');
            $table->integer('wholesale_price')->nullable();
            $table->integer('quantity_wholesale_price')->nullable();
            $table->integer('stock');
            $table->string('image');
            $table->string('code');
            $table->string('long_description');
            $table->unsignedBigInteger('id_categories');
            $table->unsignedBigInteger('id_units');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_categories')->references('id')->on('categories');
            $table->foreign('id_units')->references('id')->on('units');
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
