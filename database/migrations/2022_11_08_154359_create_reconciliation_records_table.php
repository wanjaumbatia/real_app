<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReconciliationRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reconciliation_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('expected_amount');
            $table->double('submited_amount');
            $table->boolean('shortage')->default(false);
            $table->double('shortage_amount')->nullable();
            $table->string('branch');
            $table->string('reconciled_by');
            $table->date('reconciled_on')->nullable();
            $table->integer('min');
            $table->integer('max');
            $table->string('reconciliation_reference')->nullable();
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
        Schema::dropIfExists('reconciliation_records');
    }
}
