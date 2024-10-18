<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToQualityFormsTable extends Migration
{
    public function up()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            // Her sütunun mevcut olup olmadığını kontrol ediyoruz ve sadece yoksa ekliyoruz.
            if (!Schema::hasColumn('quality_forms', 'electronics_shipping')) {
                $table->string('electronics_shipping')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'electronics_pcb_certificate')) {
                $table->string('electronics_pcb_certificate')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'electronics_special_process')) {
                $table->string('electronics_special_process')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'electronics_pcb_mechanical')) {
                $table->string('electronics_pcb_mechanical')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'electronics_visual_inspection')) {
                $table->string('electronics_visual_inspection')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'electronics_electrical_test')) {
                $table->string('electronics_electrical_test')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'component_shipping')) {
                $table->string('component_shipping')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'component_lot_certificate')) {
                $table->string('component_lot_certificate')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'component_visual_inspection')) {
                $table->string('component_visual_inspection')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'component_electrical_test')) {
                $table->string('component_electrical_test')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'component_measurement')) {
                $table->string('component_measurement')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'cabling_mechanical_test')) {
                $table->string('cabling_mechanical_test')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'cabling_visual_inspection')) {
                $table->string('cabling_visual_inspection')->nullable();
            }
            if (!Schema::hasColumn('quality_forms', 'cabling_electrical_test')) {
                $table->string('cabling_electrical_test')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            // Geri alınacak sütunlar
            $table->dropColumn([
                'electronics_shipping', 'electronics_pcb_certificate', 'electronics_special_process',
                'electronics_pcb_mechanical', 'electronics_visual_inspection', 'electronics_electrical_test',
                'component_shipping', 'component_lot_certificate', 'component_visual_inspection',
                'component_electrical_test', 'component_measurement', 'cabling_mechanical_test',
                'cabling_visual_inspection', 'cabling_electrical_test',
            ]);
        });
    }
}
