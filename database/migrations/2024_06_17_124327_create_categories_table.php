<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('cat_id');
            $table->string("name");
            $table->string("slug")->unique();
            $table->string('image')->nullable();
            $table->string('status')->default("active");
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
