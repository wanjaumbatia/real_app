<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsAccountLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_account_ledgers', function (Blueprint $table) {
            $table->id();            
            $table->date('posting_date');
            $table->string('batch')->nullable();
            $table->integer('customer_id');
            $table->string('customer');
            $table->integer('savings_account_id');
            $table->string('plan');            
            $table->string('transaction_type');
            $table->string('description')->nullable();
            $table->double('debit')->default(0);
            $table->double('credit')->default(0);
            $table->double('amount')->default(0);
            $table->boolean('reconciled')->default(false);
            $table->boolean('reversed')->default(false);
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
        Schema::dropIfExists('savings_account_ledgers');
    }
}
