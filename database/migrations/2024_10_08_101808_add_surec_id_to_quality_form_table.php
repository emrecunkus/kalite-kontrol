<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('surec_id')->nullable(); // Adding sürec_id column
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->dropColumn('surec_id'); // Dropping sürec_id column
        });
    }

};
