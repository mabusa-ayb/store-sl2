<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_sales', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('invoiceNumber')->unique();
            $table->string('paymentMethod');
            $table->string('subtotal');
            $table->string('shipping_cost');
            $table->string('total');
            $table->string('status');
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
        Schema::dropIfExists('online_sales');
    }
}
