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
        Schema::table('inventary_reports', function (Blueprint $table) {
            $table->string('executor_2')->nullable();
            $table->string('solution_2')->nullable();
            $table->time('solution_2_add_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventary_reports', function (Blueprint $table) {
            //
        });
    }
};
