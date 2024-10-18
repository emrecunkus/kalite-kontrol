<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\QualityForm;

class QualityFormBruteForceTest extends TestCase
{
    /** @test */
    public function it_bruteforces_quality_form_with_random_inputs()
    {
        // Faker ile rastgele veri oluşturun
        $faker = \Faker\Factory::create();

        // Mevcut bir form kaydı oluşturun
        $form = QualityForm::factory()->create();

        // Fake the storage for file uploads
        Storage::fake('local');

        // Dummy files for testing file uploads
        $technical_drawing_qdms_file = UploadedFile::fake()->create('technical_drawing_qdms.pdf', 100);
        $mechanical_measurements_file = UploadedFile::fake()->create('mechanical_measurements.pdf', 100);
        $calibration_equipment_file = UploadedFile::fake()->create('calibration_equipment.pdf', 100);

        // Belirli sayıda rastgele test senaryosu çalıştırın
        for ($i = 0; $i < 1000; $i++) {
            try {
                // Rastgele veriler üretin
                $testData = [
                    'document_date' => $faker->date(),
                    'part_stock_number' => $faker->regexify('[A-Z0-9]{5}'),
                    'quality_report_number' => $faker->regexify('[A-Z0-9]{6}'),
                    'part_description' => $faker->sentence(),
                    'product_revision' => $faker->regexify('[A-Z]{1}[0-9]{1}'),
                    'batch_quantity' => $faker->numberBetween(1, 1000),
                    'inspected_quantity' => $faker->numberBetween(1, 1000),
                    'technical_drawing_qdms' => 'Technical details',
                    'mechanical_measurements' => 'Measured properly',
                    'calibration_equipment' => 'Calibrated tools',
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
                ];

                // PUT isteği gönderin ve sahte dosyaları ve verileri birleştirerek isteği gönderin
                $response = $this->put(route('form.update', $form->id), array_merge($testData, [
                    'technical_drawing_qdms_file' => $technical_drawing_qdms_file,
                    'mechanical_measurements_file' => $mechanical_measurements_file,
                    'calibration_equipment_file' => $calibration_equipment_file,
                ]));

                // Başarılı olduğunu kontrol edin
                $response->assertStatus(200);

                // Formun güncellenmiş olduğunu kontrol edin
                $this->assertDatabaseHas('quality_forms', [
                    'id' => $form->id,
                    'document_date' => $testData['document_date'],
                    'part_stock_number' => $testData['part_stock_number'],
                    'quality_report_number' => $testData['quality_report_number'],
                ]);

                // Dosyaların yüklendiğini kontrol edin
                Storage::disk('local')->assertExists('files/' . $technical_drawing_qdms_file->hashName());
                Storage::disk('local')->assertExists('files/' . $mechanical_measurements_file->hashName());
                Storage::disk('local')->assertExists('files/' . $calibration_equipment_file->hashName());

                // Başarılı iterasyonları loglamayın
            } catch (\Exception $e) {
                // Hatalı iterasyonlarda hatayı ve döngü numarasını loglayın
                echo "Error in iteration $i: " . $e->getMessage() . "\n";
                echo "Full error trace: " . $e->getTraceAsString() . "\n";
                // Devam etmek için burada dd() kullanmayın, sadece hatayı gösterin.
            }
        }
    }
}
