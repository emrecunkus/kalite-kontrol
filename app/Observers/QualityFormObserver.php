<?php

namespace App\Observers;

use App\Models\QualityForm;
use Illuminate\Support\Facades\Log;

class QualityFormObserver
{
    /**
     * Handle the QualityForm "created" event.
     *
     * @param  \App\Models\QualityForm  $qualityForm
     * @return void
     */
    public function created(QualityForm $qualityForm)
    {
        // Log the stored data
        Log::info('A new form has been created:', [
            'document_date' => $qualityForm->document_date,
            'document_no' => $qualityForm->document_no,
            'part_stock_number' => $qualityForm->part_stock_number,
            'quality_report_number' => $qualityForm->quality_report_number,
            'part_description' => $qualityForm->part_description,
            'product_revision' => $qualityForm->product_revision,
            'batch_quantity' => $qualityForm->batch_quantity,
            'inspected_quantity' => $qualityForm->inspected_quantity,
            'technical_drawing_qdms' => $qualityForm->technical_drawing_qdms,
            'technical_drawing_qdms_file' => $qualityForm->technical_drawing_qdms_file,
            'mechanical_measurements' => $qualityForm->mechanical_measurements,
            'mechanical_measurements_file' => $qualityForm->mechanical_measurements_file,
            'calibration_equipment' => $qualityForm->calibration_equipment,
            'calibration_equipment_file' => $qualityForm->calibration_equipment_file,
            'electrical_optical_test' => $qualityForm->electrical_optical_test,
            'supplier_measurement' => $qualityForm->supplier_measurement,
            'environmental_conditions' => $qualityForm->environmental_conditions,
            'special_process_tests' => $qualityForm->special_process_tests,
            'quality_conformance_certificate' => $qualityForm->quality_conformance_certificate,
            'shipping_packaging' => $qualityForm->shipping_packaging,
            'counterfeit_suspected' => $qualityForm->counterfeit_suspected,
            'shelf_life' => $qualityForm->shelf_life,
            'product_type' => $qualityForm->product_type,
            'mechanical_raw_material' => $qualityForm->mechanical_raw_material,
            'mechanical_paint' => $qualityForm->mechanical_paint,
            'mechanical_exterior' => $qualityForm->mechanical_exterior,
            'mechanical_welding_documents' => $qualityForm->mechanical_welding_documents,
            'electronics_shipping' => $qualityForm->electronics_shipping,
            'electronics_pcb_certificate' => $qualityForm->electronics_pcb_certificate,
            'electronics_special_process' => $qualityForm->electronics_special_process,
            'electronics_pcb_mechanical' => $qualityForm->electronics_pcb_mechanical,
            'electronics_visual_inspection' => $qualityForm->electronics_visual_inspection,
            'electronics_electrical_test' => $qualityForm->electronics_electrical_test,
            'component_shipping' => $qualityForm->component_shipping,
            'component_lot_certificate' => $qualityForm->component_lot_certificate,
            'component_visual_inspection' => $qualityForm->component_visual_inspection,
            'component_electrical_test' => $qualityForm->component_electrical_test,
            'component_measurement' => $qualityForm->component_measurement,
            'cabling_mechanical_test' => $qualityForm->cabling_mechanical_test,
            'cabling_visual_inspection' => $qualityForm->cabling_visual_inspection,
            'cabling_electrical_test' => $qualityForm->cabling_electrical_test,
            'suspected_supplier_list' => $qualityForm->suspected_supplier_list,
            'suspected_traceability' => $qualityForm->suspected_traceability,
            'suspected_fake_packaging' => $qualityForm->suspected_fake_packaging,
            'inspected_by' => $qualityForm->inspected_by,
            'approved_by' => $qualityForm->approved_by,
            'technician_id' => $qualityForm->technician_id,
            'assigned_to' => $qualityForm->assigned_to,
            'status' => $qualityForm->status,
            'surec_id' =>$qualityForm->newSurecId,
        ]);
    }
    public function updated(QualityForm $qualityForm)
    {
        // Log the updated data
        Log::info('The form has been updated:', [
            'document_date' => $qualityForm->document_date,
            'document_no' => $qualityForm->document_no,
            'part_stock_number' => $qualityForm->part_stock_number,
            'quality_report_number' => $qualityForm->quality_report_number,
            'part_description' => $qualityForm->part_description,
            'product_revision' => $qualityForm->product_revision,
            'batch_quantity' => $qualityForm->batch_quantity,
            'inspected_quantity' => $qualityForm->inspected_quantity,
            'technical_drawing_qdms' => $qualityForm->technical_drawing_qdms,
            'technical_drawing_qdms_file' => $qualityForm->technical_drawing_qdms_file,
            'mechanical_measurements' => $qualityForm->mechanical_measurements,
            'mechanical_measurements_file' => $qualityForm->mechanical_measurements_file,
            'calibration_equipment' => $qualityForm->calibration_equipment,
            'calibration_equipment_file' => $qualityForm->calibration_equipment_file,
            'electrical_optical_test' => $qualityForm->electrical_optical_test,
            'supplier_measurement' => $qualityForm->supplier_measurement,
            'environmental_conditions' => $qualityForm->environmental_conditions,
            'special_process_tests' => $qualityForm->special_process_tests,
            'quality_conformance_certificate' => $qualityForm->quality_conformance_certificate,
            'shipping_packaging' => $qualityForm->shipping_packaging,
            'counterfeit_suspected' => $qualityForm->counterfeit_suspected,
            'shelf_life' => $qualityForm->shelf_life,
            'product_type' => $qualityForm->product_type,
            'mechanical_raw_material' => $qualityForm->mechanical_raw_material,
            'mechanical_paint' => $qualityForm->mechanical_paint,
            'mechanical_exterior' => $qualityForm->mechanical_exterior,
            'mechanical_welding_documents' => $qualityForm->mechanical_welding_documents,
            'electronics_shipping' => $qualityForm->electronics_shipping,
            'electronics_pcb_certificate' => $qualityForm->electronics_pcb_certificate,
            'electronics_special_process' => $qualityForm->electronics_special_process,
            'electronics_pcb_mechanical' => $qualityForm->electronics_pcb_mechanical,
            'electronics_visual_inspection' => $qualityForm->electronics_visual_inspection,
            'electronics_electrical_test' => $qualityForm->electronics_electrical_test,
            'component_shipping' => $qualityForm->component_shipping,
            'component_lot_certificate' => $qualityForm->component_lot_certificate,
            'component_visual_inspection' => $qualityForm->component_visual_inspection,
            'component_electrical_test' => $qualityForm->component_electrical_test,
            'component_measurement' => $qualityForm->component_measurement,
            'cabling_mechanical_test' => $qualityForm->cabling_mechanical_test,
            'cabling_visual_inspection' => $qualityForm->cabling_visual_inspection,
            'cabling_electrical_test' => $qualityForm->cabling_electrical_test,
            'suspected_supplier_list' => $qualityForm->suspected_supplier_list,
            'suspected_traceability' => $qualityForm->suspected_traceability,
            'suspected_fake_packaging' => $qualityForm->suspected_fake_packaging,
            'inspected_by' => $qualityForm->inspected_by,
            'approved_by' => $qualityForm->approved_by,
            'technician_id' => $qualityForm->technician_id,
            'assigned_to' => $qualityForm->assigned_to,
            'status' => $qualityForm->status,
        ]);
    }
}
