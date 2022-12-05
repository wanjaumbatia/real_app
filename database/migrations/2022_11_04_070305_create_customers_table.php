<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('town')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('handler')->nullable();
            $table->string('dob')->nullable();
            $table->string('business')->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->boolean('app_user')->default(false);
            $table->string('branch')->nullable();
            $table->boolean('old')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
