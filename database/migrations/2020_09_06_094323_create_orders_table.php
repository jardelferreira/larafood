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
            $table->foreignId('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->integer('client_id')->nullable();
            $table->integer('table_id')->nullable();
            $table->string('identify')->unique();
            $table->enum('status',['open','working','delivering','done','rejected','cancel']);
            $table->string('comment')->nullable();
            $table->double('total',10,2);
            $table->timestamps();
        });

        Schema::create('order_product',function(Blueprint $table){
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->double('price',10,2);
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
