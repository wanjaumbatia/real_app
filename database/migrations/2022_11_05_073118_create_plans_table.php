<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('default')->default(false);
            $table->boolean('allow_multiple')->default(true);
            $table->double('charge');
            $table->double('commission');
            $table->integer('duration')->default(0);
            $table->boolean('regular')->default(false);
            $table->boolean('savings')->default(false);
            $table->boolean('invest')->default(false);
            $table->double('returns');
            $table->double('penalty');
            $table->boolean('active')->default(true);
            $table->string('create_by')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
