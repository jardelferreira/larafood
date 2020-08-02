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
            $table->string('title')->unique();
            $table->string('flag')->unique();
            $table->text('description');
            $table->double('price',5,2);
            $table->string('image')->nullable();
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->timestamps();
        });
        Schema::create('category_products', function(Blueprint $table){
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete("cascade");
            $table->foreignId('product_id')->references('id')->on('products')->onDelete("cascade");
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
        Schema::dropIfExists('category_products');
    }
}
