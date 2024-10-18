<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedToToQualityFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->string('assigned_to')->nullable()->after('technician_id');  // assigned_to sütununu ekliyoruz
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
            $table->dropColumn('assigned_to');  // Bu sütunu geri almak için
        });
    }
}
