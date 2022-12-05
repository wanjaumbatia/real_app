<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('savings_account_id');
            $table->string('plan')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer');
            $table->string('transaction_type');
            $table->string('loan_number')->nullable();
            $table->string('status')->default('pending');
            $table->string('remarks')->nullable();
            $table->double('amount');
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
        Schema::dropIfExists('payments');
    }
}
