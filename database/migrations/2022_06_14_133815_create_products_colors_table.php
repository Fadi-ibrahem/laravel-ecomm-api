<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_colors', function (Blueprint $table) {

            $table->primary(['product_id', 'color_id']);

            $table->foreignId('product_id')->constrained('products')
                                                    ->onUpdate('cascade')
                                                    ->onDelete('cascade');

            $table->foreignId('color_id')->constrained('colors')
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');

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
        Schema::dropIfExists('products_colors');
    }
}
