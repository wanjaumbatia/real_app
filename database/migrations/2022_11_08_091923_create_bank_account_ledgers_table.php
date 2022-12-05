<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date('posting_date');
            $table->unsignedBigInteger('bank_account_id');
            $table->string('bank_name');
            $table->string('transaction_type');
            $table->double('debit');
            $table->double('credit');
            $table->double('amount');
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
        Schema::dropIfExists('bank_account_ledgers');
    }
}
