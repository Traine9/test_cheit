<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestLogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->string('method');
            $table->ipAddress('ip');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('type');
            $table->json('data')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
