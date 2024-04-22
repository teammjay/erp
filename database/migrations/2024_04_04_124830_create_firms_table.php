<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->id('firm_id');
            $table->enum('business', ["Company","B2B","B2C","Wholesaler","Retailer"]);
            $table->smallInteger('pws');
            $table->smallInteger('inperson');
            $table->smallInteger('social');
            $table->smallInteger('onlinemarket');
            $table->enum('status', ['New Seller', 'Existing Seller']);
            $table->enum('primary', ["Grocery","Mobiles","Fashion","Electronics","Home & Furniture","Appliances","Beauty, Toys & More","Automobile"]);
            $table->enum('secondary', ["Grocery","Mobiles","Fashion","Electronics","Home & Furniture","Appliances","Beauty, Toys & More","Automobile"]);
            $table->enum('region', ["In your City","In your State","In your Country","Worldwide",]);
            // $table->unsignedBigInteger('customer_id');
            $table->foreignId('customer_id')->references('customer_id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firms');
    }
};
