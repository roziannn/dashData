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
        Schema::create('comment_inventary', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 20)->nullable();
            $table->string('inventary_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('event', 100)->nullable();
            $table->text('extra')->nullable();
            $table->string('ip', 20);
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
        Schema::dropIfExists('comment_inventary');
    }
};
