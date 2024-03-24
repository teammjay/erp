<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->text('about')->nullable();
            $table->string('gstin')->nullable();
            $table->string('gstin_type')->nullable();
            $table->string('legal_name')->nullable();
            $table->string('store_name')->nullable();
            $table->text('address')->nullable();
            $table->text('pincode')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->string('password');
            $table->smallInteger('is_admin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
