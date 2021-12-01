<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_h', function (Blueprint $table) {
            $table->id();
            $table->string('num_invoice');
            $table->integer('total')->nullable();
            $table->integer('id_vendor');
            $table->integer('active');
            $table->enum('status',['order', 'receive']);
            $table->integer('user_modified');
            $table->date('date');
            $table->text('information')->nullable();
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
        Schema::dropIfExists('purchase_h');
    }
}
