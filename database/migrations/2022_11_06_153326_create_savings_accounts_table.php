<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer');
            $table->unsignedBigInteger('plan_id');
            $table->string('plan');
            $table->string('name');
            $table->string('branch')->nullable();
            $table->double('pledge')->default(0);
            $table->string('handler')->nullable();            
            $table->string('created_by')->nullable();
            $table->boolean('active')->default(true);           
            $table->foreign('plan_id')
                ->references('id')
                ->on('plans');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
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
        Schema::dropIfExists('savings_accounts');
    }
}
