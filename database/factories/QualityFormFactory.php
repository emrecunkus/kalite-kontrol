<?php

namespace Database\Factories;

use App\Models\QualityForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class QualityFormFactory extends Factory
{
    protected $model = QualityForm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_date' => $this->faker->date(),
            'part_stock_number' => $this->faker->lexify('???-????'),
            'quality_report_number' => $this->faker->bothify('QR-###??'),
            'part_description' => $this->faker->sentence(),
            'product_revision' => $this->faker->lexify('Rev?'),
            'batch_quantity' => $this->faker->numberBetween(1, 500),
            'inspected_quantity' => $this->faker->numberBetween(1, 500),
            'technical_drawing_qdms' => $this->faker->sentence(),
            'mechanical_measurements' => $this->faker->sentence(),
            'calibration_equipment' => $this->faker->sentence(),
            'electrical_optical_test' => $this->faker->sentence(),
            'supplier_measurement' => $this->faker->sentence(),
            'environmental_conditions' => $this->faker->sentence(),
            'special_process_tests' => $this->faker->sentence(),
            'quality_conformance_certificate' => $this->faker->sentence(),
            'shipping_packaging' => $this->faker->sentence(),
            'counterfeit_suspected' => $this->faker->word(),
            'shelf_life' => $this->faker->numberBetween(1, 24) . ' months',
            'product_type' => json_encode($this->faker->randomElements(['mechanical', 'electrical', 'component', 'cabling'], 2)),
            'mechanical_raw_material' => $this->faker->sentence(),
            'mechanical_paint' => $this->faker->sentence(),
            'mechanical_exterior' => $this->faker->sentence(),
            'mechanical_welding_documents' => $this->faker->sentence(),
            'electronics_shipping' => $this->faker->sentence(),
            'electronics_pcb_certificate' => $this->faker->sentence(),
            'electronics_special_process' => $this->faker->sentence(),
            'electronics_pcb_mechanical' => $this->faker->sentence(),
            'electronics_visual_inspection' => $this->faker->sentence(),
            'electronics_electrical_test' => $this->faker->sentence(),
            'component_shipping' => $this->faker->sentence(),
            'component_lot_certificate' => $this->faker->sentence(),
            'component_visual_inspection' => $this->faker->sentence(),
            'component_electrical_test' => $this->faker->sentence(),
            'component_measurement' => $this->faker->sentence(),
            'cabling_mechanical_test' => $this->faker->sentence(),
            'cabling_visual_inspection' => $this->faker->sentence(),
            'cabling_electrical_test' => $this->faker->sentence(),
            'suspected_supplier_list' => $this->faker->sentence(),
            'suspected_traceability' => $this->faker->sentence(),
            'suspected_fake_packaging' => $this->faker->sentence(),
            'inspected_by' => $this->faker->name(),
            'approved_by' => $this->faker->name(),
            'technician_id' => $this->faker->numberBetween(1, 10),
            'engineer_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'assigned_to' => $this->faker->userName(),
        ];
    }
}
