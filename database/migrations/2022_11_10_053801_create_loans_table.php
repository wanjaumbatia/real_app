<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number');
            $table->integer('customer_id');
            $table->string('customer');
            $table->integer('loan_type_id');
            $table->string('loan_type');
            $table->double('amount');
            $table->decimal('interest');
            $table->integer('duration');
            $table->string('purpose')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('disbursed')->default(false);
            $table->date('disbursed_on')->nullable();
            $table->string('disbursed_by')->nullable();
            $table->string('approval_location')->nullable();
            $table->boolean('approved');
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
        Schema::dropIfExists('loans');
    }
}
