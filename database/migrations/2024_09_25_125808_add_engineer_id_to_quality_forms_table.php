<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEngineerIdToQualityFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('engineer_id')->nullable()->after('assigned_to');  // engineer_id sütununu ekliyoruz
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->dropColumn('engineer_id');  // Bu sütunu geri almak için
        });
    }
}
