<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInspectedAndApprovedByToQualityFormsTable extends Migration
{
    public function up()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->string('inspected_by')->nullable();
            $table->string('approved_by')->nullable();
        });
    }

    public function down()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            $table->dropColumn('inspected_by');
            $table->dropColumn('approved_by');
        });
    }
}
