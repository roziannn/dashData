<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_inventary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 20)->nullable();
            $table->string('user_name')->nullable();
            $table->string('ip', 20);
            $table->string('event', 100)->nullable();
            $table->text('extra')->nullable();
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
        Schema::dropIfExists('logs_inventary');
    }
};