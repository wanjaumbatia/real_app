<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_messages', function (Blueprint $table) {
            $table->id();
            $table->string('sent_to')->nullable();
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->boolean('sent')->default(false);
            $table->boolean('delivered')->default(false);
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
        Schema::dropIfExists('s_m_s_messages');
    }
}
