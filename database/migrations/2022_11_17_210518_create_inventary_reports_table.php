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
        Schema::create('inventary_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_token');
            $table->string('author');
            $table->string('reporter_name');
            $table->string('department');
            $table->string('details_problem');
            $table->string('reporter_contact');
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
        Schema::dropIfExists('inventary_report');
    }
};
