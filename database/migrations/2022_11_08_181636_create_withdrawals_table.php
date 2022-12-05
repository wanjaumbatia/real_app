<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('savings_account_id');
            $table->string('plan')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer');
            $table->string('transaction_type')->default('withdrawal');
            $table->string('status')->default('pending');
            $table->string('pof')->default(false);
            $table->string('remarks')->nullable();
            $table->double('amount');
            $table->double('commission');
            $table->double('total');
            $table->string('handler')->nullable();
            $table->boolean('requires_approval')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('posted')->default(false);            
            $table->string('batch_number')->nullable();            
            $table->string('branch')->nullable();    
            $table->boolean('reconciled')->default(false);
            $table->boolean('admin_reconciled')->default(false);
            $table->string('reconciliation_reference')->nullable();
            $table->string('reconciled_by')->nullable();
            $table->date('reconciled_on')->nullable();
            $table->string('otp')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
}
