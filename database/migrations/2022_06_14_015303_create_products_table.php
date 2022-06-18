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
            $table->string('name');
            $table->boolean('status');
            $table->integer('qty');
            $table->string('image');
            $table->text('description');
            $table->float('price');

            $table->foreignId('supplier_id')->nullable()->constrained('users')
                                                                ->onUpdate('cascade')
                                                                ->onDelete('cascade');

            $table->foreignId('admin_id')->constrained('users');

            $table->foreignId('category_id')->nullable()->constrained('categories');

            $table->foreignId('sub_category_id')->nullable()->constrained('categories');


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
