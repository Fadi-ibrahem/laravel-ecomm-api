<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->dateTime('order_date');
            $table->dateTime('shipped_date');
            $table->dateTime('required_date');
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('shipper_id')->constrained('shippers');
            $table->integer('qty');
            $table->float('discount')->nullable();
            $table->float('price');
            $table->string('card_type');
            $table->string('card_number');
            $table->float('tax');
            $table->float('total_price');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');

            $table->foreignId('cancellation_id')->nullable()->constrained('cancellations')
                                                                    ->onDelete('cascade')
                                                                    ->onUpdate('cascade');

            $table->enum('status', ['pending', 'shipping', 'accepted', 'rejected', 'cancelled']);
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
