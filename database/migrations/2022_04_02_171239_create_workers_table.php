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
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->float('month_of_experience');

            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->foreign('speciality_id')
                ->references('id')
                ->on('specialities')
                ->nullOnDelete();

            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
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
        Schema::dropIfExists('sellers');
    }
};
