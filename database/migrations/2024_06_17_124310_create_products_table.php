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
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->double('price',10,2);
            $table->string('image')->nullable();
            $table->double('compare_price',10,2)->nullable();
            
            $table->enum('is_featured',['Yes', 'No'])->default('No');
            $table->string('sku');
            $table->string('barcode');
            $table->enum('track_qty',['Yes', 'No'])->default('Yes');
            $table->integer('quantity')->nullable();
            $table->string('status')->default('active');
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
};
