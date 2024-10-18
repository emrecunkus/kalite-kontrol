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
        'supplier_measurement', // Tedarikçi Ölçüm Sonuçları
        'environmental_conditions', // Çevre Koşulları Test Sonuçları
        'special_process_tests', // Özel Proses Test Sonuçları
        'quality_conformance_certificate', // Kalite Uygunluk Belgesi
        'shipping_packaging', // Ürün Sevkiyat ve Paketleme
        'counterfeit_suspected', // Sahte Ürün Şüphesi
        'shelf_life', // Raf Ömrü
        'product_type', // Ürün Tipi (JSON formatında olabilir)
        'product_name', // Ürün Adı - Zorunlu alan
        'mechanical_raw_material', // Ham Madde
        'mechanical_paint', // Boya/Kaplama
        'mechanical_exterior', // Dış Görünüm
        'mechanical_welding_documents', // Kaynak Prosedürü
        'electronics_shipping', // Elektronik Sevkiyat
        'electronics_pcb_certificate', // PCB Sertifikası
        'electronics_special_process', // Elektronik Özel Prosesler
        'electronics_pcb_mechanical', // PCB Mekanik Sonuçlar
        'electronics_visual_inspection', // Elektronik Görsel Denetim
        'electronics_electrical_test', // Elektriksel Test Sonuçları
        'component_shipping', // Komponent Sevkiyat
        'component_lot_certificate', // LOT Numarası
        'component_visual_inspection', // Komponent Görsel Denetim
        'component_electrical_test', // Komponent Elektriksel Test
        'component_measurement', // Komponent Ölçümleri
        'cabling_mechanical_test', // Kablaj Mekanik Test
        'cabling_visual_inspection', // Kablaj Görsel Denetim
        'cabling_electrical_test', // Kablaj Elektriksel Test
        'suspected_supplier_list', // Tedarikçi Listesi
        'suspected_traceability', // İzlenebilirlik
        'suspected_fake_packaging', // Şüpheli Paketleme
        'inspected_by', // Kontrol Eden
        'approved_by', // Onaylayan
        'technician_id', // Formu dolduran tekniker
        'engineer_id', // Formu onaylayan mühendis
        'status', // Formun durumu (Onaylandı, Reddedildi)
        'assigned_to', // Atanmış mühendis
        'surec_id',
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
