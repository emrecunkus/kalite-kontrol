<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityForm extends Model
{
    use HasFactory;

    // Kitle atama için izin verilen alanlar
    protected $fillable = [
        'product_name', 
        'document_date', // Doküman Tarihi
        'document_no', // Doküman No
        'part_stock_number', // Parça Stok Numarası
        'quality_report_number', // Tedarik Kalite Kontrol Rapor Numarası
        'part_description', // Parça Stok Tanımı
        'product_revision', // Ürün Revizyonu
        'batch_quantity', // Gelen Parça Miktarı
        'inspected_quantity', // Kontrol Edilen Parça Miktarı
        'technical_drawing_qdms', // Teknik Resim QDMS
        'technical_drawing_qdms_file', // Teknik Resim Dosya Eki
        'mechanical_measurements', // Mekanik Ölçüm Sonuçları
        'mechanical_measurements_file', // Mekanik Ölçüm Dosya Eki
        'calibration_equipment', // Ölçüm Ekipmanları
        'calibration_equipment_file', // Ekipman Dosya Eki
        'electrical_optical_test', // Elektriksel/Optik Test
        'electrical_optical_test_file', // Elektriksel/Optik Test Dosya Eki
        'supplier_measurement', // Tedarikçi Ölçüm Sonuçları
        'supplier_measurement_file', // Tedarikçi Ölçüm Dosya Eki
        'environmental_conditions', // Çevre Koşulları Test Sonuçları
        'environmental_conditions_file', // Çevre Koşulları Dosya Eki
        'special_process_tests', // Özel Proses Test Sonuçları
        'special_process_tests_file', // Özel Proses Test Dosya Eki
        'quality_conformance_certificate', // Kalite Uygunluk Belgesi
        'quality_conformance_certificate_file', // Kalite Uygunluk Dosya Eki
        'shipping_packaging', // Ürün Sevkiyat ve Paketleme
        'shipping_packaging_file', // Ürün Sevkiyat ve Paketleme Dosya Eki
        'counterfeit_suspected', // Sahte Ürün Şüphesi
        'counterfeit_suspected_file', // Sahte Ürün Şüphesi Dosya Eki
        'shelf_life', // Raf Ömrü
        'shelf_life_file', // Raf Ömrü Dosya Eki
        'product_type', // Ürün Tipi (JSON formatında olabilir)
        'product_name', // Ürün Adı - Zorunlu alan
        'mechanical_raw_material', // Ham Madde
        'mechanical_raw_material_file', // Ham Madde Dosya Eki
        'mechanical_paint', // Boya/Kaplama
        'mechanical_paint_file', // Boya/Kaplama Dosya Eki
        'mechanical_exterior', // Dış Görünüm
        'mechanical_exterior_file', // Dış Görünüm Dosya Eki
        'mechanical_welding_documents', // Kaynak Prosedürü
        'mechanical_welding_documents_file', // Kaynak Prosedürü Dosya Eki
        'electronics_shipping', // Elektronik Sevkiyat
        'electronics_shipping_file', // Elektronik Sevkiyat Dosya Eki
        'electronics_pcb_certificate', // PCB Sertifikası
        'electronics_pcb_certificate_file', // PCB Sertifikası Dosya Eki
        'electronics_special_process', // Elektronik Özel Prosesler
        'electronics_special_process_file', // Elektronik Özel Proses Dosya Eki
        'electronics_pcb_mechanical', // PCB Mekanik Sonuçlar
        'electronics_pcb_mechanical_file', // PCB Mekanik Sonuçlar Dosya Eki
        'electronics_visual_inspection', // Elektronik Görsel Denetim
        'electronics_visual_inspection_file', // Elektronik Görsel Denetim Dosya Eki
        'electronics_electrical_test', // Elektriksel Test Sonuçları
        'electronics_electrical_test_file', // Elektriksel Test Sonuç Dosya Eki
        'component_shipping', // Komponent Sevkiyat
        'component_shipping_file', // Komponent Sevkiyat Dosya Eki
        'component_lot_certificate', // LOT Numarası
        'component_lot_certificate_file', // LOT Numarası Dosya Eki
        'component_visual_inspection', // Komponent Görsel Denetim
        'component_visual_inspection_file', // Komponent Görsel Denetim Dosya Eki
        'component_electrical_test', // Komponent Elektriksel Test
        'component_electrical_test_file', // Komponent Elektriksel Test Dosya Eki
        'component_measurement', // Komponent Ölçümleri
        'component_measurement_file', // Komponent Ölçümleri Dosya Eki
        'cabling_mechanical_test', // Kablaj Mekanik Test
        'cabling_mechanical_test_file', // Kablaj Mekanik Test Dosya Eki
        'cabling_visual_inspection', // Kablaj Görsel Denetim
        'cabling_visual_inspection_file', // Kablaj Görsel Denetim Dosya Eki
        'cabling_electrical_test', // Kablaj Elektriksel Test
        'cabling_electrical_test_file', // Kablaj Elektriksel Test Dosya Eki
        'suspected_supplier_list', // Tedarikçi Listesi
        'suspected_supplier_list_file', // Tedarikçi Listesi Dosya Eki
        'suspected_traceability', // İzlenebilirlik
        'suspected_traceability_file', // İzlenebilirlik Dosya Eki
        'suspected_fake_packaging', // Şüpheli Paketleme
        'suspected_fake_packaging_file', // Şüpheli Paketleme Dosya Eki
        'inspected_by', // Kontrol Eden
        'approved_by', // Onaylayan
        'technician_id', // Formu dolduran tekniker
        'engineer_id', // Formu onaylayan mühendis
        'status', // Formun durumu (Onaylandı, Reddedildi)
        'assigned_to', // Atanmış mühendis
        'surec_id',
        'inventory_data',
        'measurement_data'
    ];


    // Teknisyen ve mühendis ilişkisi
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function engineer()
    {
        return $this->belongsTo(User::class, 'engineer_id');
    }
}
