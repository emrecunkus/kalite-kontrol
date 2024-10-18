<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToQualityFormsTable extends Migration
{
    public function up()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            // Add new columns as needed
            $table->string('document_date')->nullable();
            $table->string('document_no')->default('TKKF/ FR-KYM-247');
            $table->string('part_stock_number')->nullable();
            $table->string('quality_report_number')->nullable();
            $table->text('part_description')->nullable(); // Changed to TEXT
            $table->string('product_revision')->nullable();
            $table->integer('batch_quantity')->nullable();
            $table->integer('inspected_quantity')->nullable();
            
            // General section fields
            $table->string('technical_drawing_qdms')->nullable();
            $table->text('technical_drawing_qdms_file')->nullable(); // Changed to TEXT
            $table->string('mechanical_measurements')->nullable();
            $table->text('mechanical_measurements_file')->nullable(); // Changed to TEXT

            $table->string('calibration_equipment')->nullable();
            $table->text('calibration_equipment_file')->nullable(); // Changed to TEXT

            $table->string('electrical_optical_test')->nullable();
            $table->text('electrical_optical_test_file')->nullable(); // Changed to TEXT

            $table->string('supplier_measurement')->nullable();
            $table->text('supplier_measurement_file')->nullable(); // Changed to TEXT

            $table->string('environmental_conditions')->nullable();
            $table->text('environmental_conditions_file')->nullable(); // Changed to TEXT

            $table->string('special_process_tests')->nullable();
            $table->text('special_process_tests_file')->nullable(); // Changed to TEXT

            $table->string('quality_conformance_certificate')->nullable();
            $table->text('quality_conformance_certificate_file')->nullable(); // Changed to TEXT

            $table->string('shipping_packaging')->nullable();
            $table->text('shipping_packaging_file')->nullable(); // Changed to TEXT

            $table->string('counterfeit_suspected')->nullable();
            $table->text('counterfeit_suspected_file')->nullable(); // Changed to TEXT

            $table->string('shelf_life')->nullable();
            $table->text('shelf_life_file')->nullable(); // Changed to TEXT

            // Add other sections like electronics, components, etc.
            $table->json('product_type')->nullable(); // Store product types as JSON

            // Mechanical section
            $table->string('mechanical_raw_material')->nullable();
            $table->text('mechanical_raw_material_file')->nullable(); // Changed to TEXT

            $table->string('mechanical_paint')->nullable();
            $table->text('mechanical_paint_file')->nullable(); // Changed to TEXT

            $table->string('mechanical_exterior')->nullable();
            $table->text('mechanical_exterior_file')->nullable(); // Changed to TEXT

            $table->string('mechanical_welding_documents')->nullable();
            $table->text('mechanical_welding_documents_file')->nullable(); // Changed to TEXT

            // Electronics section
            $table->string('electronics_shipping')->nullable();
            $table->text('electronics_shipping_file')->nullable(); // Changed to TEXT

            $table->string('electronics_pcb_certificate')->nullable();
            $table->text('electronics_pcb_certificate_file')->nullable(); // Changed to TEXT

            $table->string('electronics_special_process')->nullable();
            $table->text('electronics_special_process_file')->nullable(); // Changed to TEXT

            $table->string('electronics_pcb_mechanical')->nullable();
            $table->text('electronics_pcb_mechanical_file')->nullable(); // Changed to TEXT

            $table->string('electronics_visual_inspection')->nullable();
            $table->text('electronics_visual_inspection_file')->nullable(); // Changed to TEXT

            $table->string('electronics_electrical_test')->nullable();
            $table->text('electronics_electrical_test_file')->nullable(); // Changed to TEXT

            // Component section
            $table->string('component_shipping')->nullable();
            $table->text('component_shipping_file')->nullable(); // Changed to TEXT

            $table->string('component_lot_certificate')->nullable();
            $table->text('component_lot_certificate_file')->nullable(); // Changed to TEXT

            $table->string('component_visual_inspection')->nullable();
            $table->text('component_visual_inspection_file')->nullable(); // Changed to TEXT

            $table->string('component_electrical_test')->nullable();
            $table->text('component_electrical_test_file')->nullable(); // Changed to TEXT

            $table->string('component_measurement')->nullable();
            $table->text('component_measurement_file')->nullable(); // Changed to TEXT

            // Cabling section
            $table->string('cabling_mechanical_test')->nullable();
            $table->text('cabling_mechanical_test_file')->nullable(); // Changed to TEXT

            $table->string('cabling_visual_inspection')->nullable();
            $table->text('cabling_visual_inspection_file')->nullable(); // Changed to TEXT

            $table->string('cabling_electrical_test')->nullable();
            $table->text('cabling_electrical_test_file')->nullable(); // Changed to TEXT

            // Suspected fake section
            $table->string('suspected_supplier_list')->nullable();
            $table->text('suspected_supplier_list_file')->nullable(); // Changed to TEXT

            $table->string('suspected_traceability')->nullable();
            $table->text('suspected_traceability_file')->nullable(); // Changed to TEXT

            $table->string('suspected_fake_packaging')->nullable();
            $table->text('suspected_fake_packaging_file')->nullable(); // Changed to TEXT
        });
    }

    public function down()
    {
        Schema::table('quality_forms', function (Blueprint $table) {
            // Drop the columns if rolling back the migration
            $table->dropColumn([
                'document_date', 'document_no', 'part_stock_number', 'quality_report_number',
                'part_description', 'product_revision', 'batch_quantity', 'inspected_quantity',
                'technical_drawing_qdms', 'technical_drawing_qdms_file', 'mechanical_measurements',
                'mechanical_measurements_file', 'calibration_equipment', 'calibration_equipment_file',
                'electrical_optical_test', 'electrical_optical_test_file', 'supplier_measurement',
                'supplier_measurement_file', 'environmental_conditions', 'environmental_conditions_file',
                'special_process_tests', 'special_process_tests_file', 'quality_conformance_certificate',
                'quality_conformance_certificate_file', 'shipping_packaging', 'shipping_packaging_file',
                'counterfeit_suspected', 'counterfeit_suspected_file', 'shelf_life', 'shelf_life_file',
                'product_type', 'mechanical_raw_material', 'mechanical_raw_material_file',
                'mechanical_paint', 'mechanical_paint_file', 'mechanical_exterior', 'mechanical_exterior_file',
                'mechanical_welding_documents', 'mechanical_welding_documents_file',
                'electronics_shipping', 'electronics_shipping_file', 'electronics_pcb_certificate',
                'electronics_pcb_certificate_file', 'electronics_special_process',
                'electronics_special_process_file', 'electronics_pcb_mechanical',
                'electronics_pcb_mechanical_file', 'electronics_visual_inspection',
                'electronics_visual_inspection_file', 'electronics_electrical_test',
                'electronics_electrical_test_file', 'component_shipping', 'component_shipping_file',
                'component_lot_certificate', 'component_lot_certificate_file',
                'component_visual_inspection', 'component_visual_inspection_file',
                'component_electrical_test', 'component_electrical_test_file', 'component_measurement',
                'component_measurement_file', 'cabling_mechanical_test', 'cabling_mechanical_test_file',
                'cabling_visual_inspection', 'cabling_visual_inspection_file', 'cabling_electrical_test',
                'cabling_electrical_test_file', 'suspected_supplier_list', 'suspected_supplier_list_file',
                'suspected_traceability', 'suspected_traceability_file', 'suspected_fake_packaging',
                'suspected_fake_packaging_file'
            ]);
        });
    }
}
