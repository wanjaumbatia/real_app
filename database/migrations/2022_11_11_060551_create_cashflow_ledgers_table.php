<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashflowLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashflow_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('branch')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
            $table->double('amount')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->string('created_by')->nullable();
            $table->string('batch')->nullable();
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
        Schema::dropIfExists('cashflow_ledgers');
    }
}
