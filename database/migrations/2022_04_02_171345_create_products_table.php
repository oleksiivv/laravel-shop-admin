<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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

            $table->string('name');
            $table->json('information')->nullable();
            $table->float('current_price');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->unsignedBigInteger('guarantee_id')->nullable();

            $table->string('image_url')->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories')
                ->nullOnDelete();

            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('product_manufacturers')
                ->nullOnDelete();

            $table->foreign('guarantee_id')
                ->references('id')
                ->on('product_guarantees')
                ->nullOnDelete();

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
};
