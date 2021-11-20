<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('shopping_cart_id');
            $table->unsignedInteger('product_id');
            $table->integer('quantity');
            $table->double('total_price');
            $table->double('unit_price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_cart');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
