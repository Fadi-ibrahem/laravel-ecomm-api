<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_sizes', function (Blueprint $table) {

            $table->primary(['product_id', 'size_id']);

            $table->foreignId('product_id')->constrained('products')
                                                    ->onUpdate('cascade')
                                                    ->onDelete('cascade');

            $table->foreignId('size_id')->constrained('sizes')
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
        Schema::dropIfExists('products_sizes');
    }
}
