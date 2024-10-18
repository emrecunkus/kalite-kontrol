<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Models\QualityForm;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class QualityFormControllerTest extends TestCase
{
    use WithoutMiddleware; // Disable middleware like authentication

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_stores_quality_form_with_mocking()
    {
        // Mock file storage for file uploads
        Storage::fake('local');

        // Mock the QualityForm model
        $mockedQualityForm = Mockery::mock('alias:App\Models\QualityForm');
        
        // Expect the `create` method to be called once and return a dummy response
        $mockedQualityForm->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($input) {
                // Burada tüm alanları kontrol ediyoruz
                return $input['document_date'] === '2024-09-26' &&
                       $input['part_stock_number'] === '12345' &&
                       $input['quality_report_number'] === 'QRN123' &&
                       $input['part_description'] === 'Description' &&
                       $input['product_revision'] === 'RevA' &&
                       $input['batch_quantity'] == 100 &&
                       $input['inspected_quantity'] == 95 &&
                       $input['technical_drawing_qdms'] === 'Technical details' &&
                       $input['mechanical_measurements'] === 'Measured properly' &&
                       $input['calibration_equipment'] === 'Calibrated tools' &&
                       $input['electrical_optical_test'] === 'Passed' &&
                       $input['supplier_measurement'] === 'Supplier Measured' &&
                       $input['environmental_conditions'] === 'Normal' &&
                       $input['special_process_tests'] === 'Process OK' &&
                       $input['quality_conformance_certificate'] === 'Certificate attached' &&
                       $input['shipping_packaging'] === 'Boxed' &&
                       $input['counterfeit_suspected'] === 'No' &&
                       $input['shelf_life'] === '12 months' &&
                       $input['product_type'] === json_encode(['mechanical', 'electrical']) &&
                       $input['mechanical_raw_material'] === 'Steel' &&
                       $input['mechanical_paint'] === 'Blue' &&
                       $input['mechanical_exterior'] === 'Smooth finish' &&
                       $input['mechanical_welding_documents'] === 'Weld OK' &&
                       $input['electronics_shipping'] === 'Packaged' &&
                       $input['electronics_pcb_certificate'] === 'PCB Certificate OK' &&
                       $input['electronics_special_process'] === 'Special process verified' &&
                       $input['electronics_pcb_mechanical'] === 'Mechanical tests passed' &&
                       $input['electronics_visual_inspection'] === 'Visually OK' &&
                       $input['electronics_electrical_test'] === 'Electrical tests passed' &&
                       $input['component_shipping'] === 'Packed in a box' &&
                       $input['component_lot_certificate'] === 'Lot certificate OK' &&
                       $input['component_visual_inspection'] === 'Visual inspection passed' &&
                       $input['component_electrical_test'] === 'Electrical tests OK' &&
                       $input['component_measurement'] === 'Measured correctly' &&
                       $input['cabling_mechanical_test'] === 'Cable test passed' &&
                       $input['cabling_visual_inspection'] === 'Cable visually OK' &&
                       $input['cabling_electrical_test'] === 'Cable electrical test passed' &&
                       $input['suspected_supplier_list'] === 'No issues with supplier' &&
                       $input['suspected_traceability'] === 'Traceability OK' &&
                       $input['suspected_fake_packaging'] === 'No fake packaging' &&
                       $input['inspected_by'] === 'Inspector Name' &&
                       $input['approved_by'] === 'Approver Name' &&
                       $input['technician_id'] === 2 &&
                       $input['assigned_to'] === 'cagatay.cakir' &&
                       $input['status'] === 'pending';
            }))
            ->andReturnSelf(); // Return itself or a dummy object

        // Dummy files for testing file uploads
        $technical_drawing_qdms_file = UploadedFile::fake()->create('technical_drawing_qdms.pdf', 100);
        $mechanical_measurements_file = UploadedFile::fake()->create('mechanical_measurements.pdf', 100);
        $calibration_equipment_file = UploadedFile::fake()->create('calibration_equipment.pdf', 100);

        // Simulate a POST request with all form data
        $response = $this->post('/form', [
            'document_date' => '2024-09-26',
            'part_stock_number' => '12345',
            'quality_report_number' => 'QRN123',
            'part_description' => 'Description',
            'product_revision' => 'RevA',
            'batch_quantity' => 100,
            'inspected_quantity' => 95,
            'technical_drawing_qdms' => 'Technical details',
            'technical_drawing_qdms_file' => $technical_drawing_qdms_file,
            'mechanical_measurements' => 'Measured properly',
            'mechanical_measurements_file' => $mechanical_measurements_file,
            'calibration_equipment' => 'Calibrated tools',
            'calibration_equipment_file' => $calibration_equipment_file,
            'electrical_optical_test' => 'Passed',
            'supplier_measurement' => 'Supplier Measured',
            'environmental_conditions' => 'Normal',
            'special_process_tests' => 'Process OK',
            'quality_conformance_certificate' => 'Certificate attached',
            'shipping_packaging' => 'Boxed',
            'counterfeit_suspected' => 'No',
            'shelf_life' => '12 months',
            'product_type' => ['mechanical', 'electrical'],
            'mechanical_raw_material' => 'Steel',
            'mechanical_paint' => 'Blue',
            'mechanical_exterior' => 'Smooth finish',
            'mechanical_welding_documents' => 'Weld OK',
            'electronics_shipping' => 'Packaged',
            'electronics_pcb_certificate' => 'PCB Certificate OK',
            'electronics_special_process' => 'Special process verified',
            'electronics_pcb_mechanical' => 'Mechanical tests passed',
            'electronics_visual_inspection' => 'Visually OK',
            'electronics_electrical_test' => 'Electrical tests passed',
            'component_shipping' => 'Packed in a box',
            'component_lot_certificate' => 'Lot certificate OK',
            'component_visual_inspection' => 'Visual inspection passed',
            'component_electrical_test' => 'Electrical tests OK',
            'component_measurement' => 'Measured correctly',
            'cabling_mechanical_test' => 'Cable test passed',
            'cabling_visual_inspection' => 'Cable visually OK',
            'cabling_electrical_test' => 'Cable electrical test passed',
            'suspected_supplier_list' => 'No issues with supplier',
            'suspected_traceability' => 'Traceability OK',
            'suspected_fake_packaging' => 'No fake packaging',
            'inspected_by' => 'Inspector Name',
            'approved_by' => 'Approver Name',
        ]);

        // Assert that a file was stored
        Storage::disk('local')->assertExists('files/' . $technical_drawing_qdms_file->hashName());

        // Assert that the user was redirected to the dashboard
        $response->assertRedirect(route('dashboard'));

        // Assert that the session has the success message
        $response->assertSessionHas('success', 'Form başarıyla oluşturuldu!');
    }
}
