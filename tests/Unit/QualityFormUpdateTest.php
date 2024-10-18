<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Models\QualityForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QualityFormUpdateTest extends TestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * JSON verilerini okumak için bir yardımcı fonksiyon.
     */
    private function getTestData()
    {
        // test_data.json dosyasını oku
        $json = file_get_contents(base_path('tests/test_data.json'));
        return json_decode($json, true); // Veriyi bir diziye çevir
    }

    /** @test */
    public function it_updates_quality_form_with_mocking()
    {
        // Fake the storage for file uploads
        Storage::fake('local');

        // JSON verilerini çek
        $testData = $this->getTestData();

        // Create a form using a factory
        $form = QualityForm::factory()->create([
            'document_date' => '2024-09-25',
            'part_stock_number' => 'XYZ123',
            'quality_report_number' => 'QRN123',
            'part_description' => 'Description',
            'product_revision' => 'RevA',
            'batch_quantity' => 100,
            'inspected_quantity' => 95,
        ]);

        // Dummy files for testing file uploads
        $technical_drawing_qdms_file = UploadedFile::fake()->create('technical_drawing_qdms.pdf', 100);
        $mechanical_measurements_file = UploadedFile::fake()->create('mechanical_measurements.pdf', 100);
        $calibration_equipment_file = UploadedFile::fake()->create('calibration_equipment.pdf', 100);

        // Simulate a PUT request to update the form
        $response = $this->put(route('form.update', $form->id), array_merge($testData, [
            'technical_drawing_qdms_file' => $technical_drawing_qdms_file,
            'mechanical_measurements_file' => $mechanical_measurements_file,
            'calibration_equipment_file' => $calibration_equipment_file,
        ]));

        // Assert the response status
        $response->assertStatus(302);

        // Assert the form has been updated in the database
        $this->assertDatabaseHas('quality_forms', [
            'id' => $form->id,
            'document_date' => $testData['document_date'],
            'part_stock_number' => $testData['part_stock_number'],
            'quality_report_number' => $testData['quality_report_number'],
            'part_description' => $testData['part_description'],
            'product_revision' => $testData['product_revision'],
            'batch_quantity' => $testData['batch_quantity'],
            'inspected_quantity' => $testData['inspected_quantity'],
        ]);

        // Assert that files were "uploaded"
       // Assert that files were "uploaded"
        Storage::disk('local')->assertExists('files/' . $technical_drawing_qdms_file->hashName());
        Storage::disk('local')->assertExists('files/' . $mechanical_measurements_file->hashName());
        Storage::disk('local')->assertExists('files/' . $calibration_equipment_file->hashName());


        // Assert that the session has the success message
        $response->assertSessionHas('success', 'Form başarıyla güncellendi!');
    }
}
