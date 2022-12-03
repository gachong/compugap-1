<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
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
            $table->string('codigo')->nullable();
            $table->string('articule')->nullable();
            $table->string('pricewithouttax')->nullable();
            $table->string('percenttax')->nullable();
            $table->string('percentliq')->nullable();
            $table->string('partnumber')->nullable();
            $table->string('stocklocal')->nullable();
            $table->string('mark')->nullable();
            $table->string('categoria_id')->nullable();
            $table->string('category')->nullable();
            $table->string('url_image')->nullable();
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
