<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table->string('branch')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->double('amount')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->string('created_by')->nullable();
            $table->string('confirmed_by')->nullable();            
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
        Schema::dropIfExists('cashflows');
    }
}
