<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QualityForm;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class QualityFormController extends Controller
{
    // Tekniker formu doldurur
    public function create()
    {
        $lastSurecId = QualityForm::max('surec_id') ?? 99999;
        $newSurecId = $lastSurecId + 1;
        session(['newSurecId' => $newSurecId]);
        return view('quality_forms.create', compact('newSurecId'));
    }

    // Tekniker formu kaydeder
    public function store(Request $request)
    {
        try {
            // Validation for new fields
            $validatedData = $request->validate([
                'document_date' => 'required|date',
                'part_stock_number' => 'required|string|max:255',
                'quality_report_number' => 'required|string|max:255',
                'part_description' => 'nullable|string',
                'product_revision' => 'nullable|string',
                'batch_quantity' => 'required|integer',
                'inspected_quantity' => 'required|integer',
                'technical_drawing_qdms' => 'nullable|string',
                'mechanical_measurements' => 'nullable|string',
                'calibration_equipment' => 'nullable|string',
                'electrical_optical_test' => 'nullable|string',
                'supplier_measurement' => 'nullable|string',
                'environmental_conditions' => 'nullable|string',
                'special_process_tests' => 'nullable|string',
                'quality_conformance_certificate' => 'nullable|string',
                'shipping_packaging' => 'nullable|string',
                'counterfeit_suspected' => 'nullable|string',
                'shelf_life' => 'nullable|string',
                'product_type' => 'nullable|array',
                'mechanical_raw_material' => 'nullable|string',
                'mechanical_paint' => 'nullable|string',
                'mechanical_exterior' => 'nullable|string',
                'mechanical_welding_documents' => 'nullable|string',
                'electronics_shipping' => 'nullable|string',
                'electronics_pcb_certificate' => 'nullable|string',
                'electronics_special_process' => 'nullable|string',
                'electronics_pcb_mechanical' => 'nullable|string',
                'electronics_visual_inspection' => 'nullable|string',
                'electronics_electrical_test' => 'nullable|string',
                'component_shipping' => 'nullable|string',
                'component_lot_certificate' => 'nullable|string',
                'component_visual_inspection' => 'nullable|string',
                'component_electrical_test' => 'nullable|string',
                'component_measurement' => 'nullable|string',
                'cabling_mechanical_test' => 'nullable|string',
                'cabling_visual_inspection' => 'nullable|string',
                'cabling_electrical_test' => 'nullable|string',
                'suspected_supplier_list' => 'nullable|string',
                'suspected_traceability' => 'nullable|string',
                'suspected_fake_packaging' => 'nullable|string',
                'inspected_by' => 'required|string|max:255',
                'approved_by' => 'required|string|max:255',
            ]);
    
            // Dosya yükleme işlemleri 'public' diskine yapılacak
            $fileFields = [
                'technical_drawing_qdms_file',
                'mechanical_measurements_file',
                'calibration_equipment_file',
                'electrical_optical_test_file',
                'supplier_measurement_file',
                'environmental_conditions_file',
                'special_process_tests_file',
                'quality_conformance_certificate_file',
                'shipping_packaging_file',
                'counterfeit_suspected_file',
                'shelf_life_file',
                'mechanical_raw_material_file',
                'mechanical_paint_file',
                'mechanical_exterior_file',
                'mechanical_welding_documents_file',
                'electronics_shipping_file',
                'electronics_pcb_certificate_file',
                'electronics_special_process_file',
                'component_shipping_file',
                'component_lot_certificate_file',
                'component_visual_inspection_file',
                'component_electrical_test_file',
                'component_measurement_file',
                'cabling_mechanical_test_file',
                'cabling_visual_inspection_file',
                'cabling_electrical_test_file',
                'suspected_supplier_list_file',
                'suspected_traceability_file',
                'suspected_fake_packaging_file'
            ];
    
            $uploadedFiles = [];
    
            foreach ($fileFields as $fileField) {
                if ($request->hasFile($fileField)) {
                    // Dosyayı public diskine kaydediyoruz
                    $uploadedFiles[$fileField] = $request->file($fileField)->store('files', 'public');
                }
            }
           // dd($uploadedFiles);
            // Form verilerini kaydetme
           // $newSurecId = session('newSurecId');
            $lastSurecId = QualityForm::max('surec_id') ?? 99999;
            $newSurecId = $lastSurecId + 1;

          //  dd($newSurecId);

          $newForm =QualityForm::create([
                'document_date' => $validatedData['document_date'] ?? null,
                'document_no' => 'TKKF/ FR-KYM-247',
                'part_stock_number' => $validatedData['part_stock_number'] ?? null,
                'quality_report_number' => $validatedData['quality_report_number'] ?? null,
                'part_description' => $validatedData['part_description'] ?? null,
                'product_revision' => $validatedData['product_revision'] ?? null,
                'batch_quantity' => $validatedData['batch_quantity'] ?? null,
                'inspected_quantity' => $validatedData['inspected_quantity'] ?? null,
                'technical_drawing_qdms' => $validatedData['technical_drawing_qdms'] ?? null,
                'technical_drawing_qdms_file' => $uploadedFiles['technical_drawing_qdms_file'] ?? null,
                'mechanical_measurements' => $validatedData['mechanical_measurements'] ?? null,
                'mechanical_measurements_file' => $uploadedFiles['mechanical_measurements_file'] ?? null,
                'calibration_equipment' => $validatedData['calibration_equipment'] ?? null,
                'calibration_equipment_file' => $uploadedFiles['calibration_equipment_file'] ?? null,
                'electrical_optical_test' => $validatedData['electrical_optical_test'] ?? null,
                'electrical_optical_test_file' => $uploadedFiles['electrical_optical_test_file'] ?? null,
                'supplier_measurement' => $validatedData['supplier_measurement'] ?? null,
                'supplier_measurement_file' => $uploadedFiles['supplier_measurement_file'] ?? null,
                'environmental_conditions' => $validatedData['environmental_conditions'] ?? null,
                'environmental_conditions_file' => $uploadedFiles['environmental_conditions_file'] ?? null,
                'special_process_tests' => $validatedData['special_process_tests'] ?? null,
                'special_process_tests_file' => $uploadedFiles['special_process_tests_file'] ?? null,
                'quality_conformance_certificate' => $validatedData['quality_conformance_certificate'] ?? null,
                'quality_conformance_certificate_file' => $uploadedFiles['quality_conformance_certificate_file'] ?? null,
                'shipping_packaging' => $validatedData['shipping_packaging'] ?? null,
                'shipping_packaging_file' => $uploadedFiles['shipping_packaging_file'] ?? null,
                'counterfeit_suspected' => $validatedData['counterfeit_suspected'] ?? null,
                'counterfeit_suspected_file' => $uploadedFiles['counterfeit_suspected_file'] ?? null,
                'shelf_life' => $validatedData['shelf_life'] ?? null,
                'shelf_life_file' => $uploadedFiles['shelf_life_file'] ?? null,
                'product_type' => isset($validatedData['product_type']) ? json_encode($validatedData['product_type']) : null,
                'mechanical_raw_material' => $validatedData['mechanical_raw_material'] ?? null,
                'mechanical_raw_material_file' => $uploadedFiles['mechanical_raw_material_file'] ?? null,
                'mechanical_paint' => $validatedData['mechanical_paint'] ?? null,
                'mechanical_paint_file' => $uploadedFiles['mechanical_paint_file'] ?? null,
                'mechanical_exterior' => $validatedData['mechanical_exterior'] ?? null,
                'mechanical_exterior_file' => $uploadedFiles['mechanical_exterior_file'] ?? null,
                'mechanical_welding_documents' => $validatedData['mechanical_welding_documents'] ?? null,
                'mechanical_welding_documents_file' => $uploadedFiles['mechanical_welding_documents_file'] ?? null,
                'electronics_shipping' => $validatedData['electronics_shipping'] ?? null,
                'electronics_shipping_file' => $uploadedFiles['electronics_shipping_file'] ?? null,
                'electronics_pcb_certificate' => $validatedData['electronics_pcb_certificate'] ?? null,
                'electronics_pcb_certificate_file' => $uploadedFiles['electronics_pcb_certificate_file'] ?? null,
                'electronics_special_process' => $validatedData['electronics_special_process'] ?? null,
                'electronics_special_process_file' => $uploadedFiles['electronics_special_process_file'] ?? null,
                'component_shipping' => $validatedData['component_shipping'] ?? null,
                'component_shipping_file' => $uploadedFiles['component_shipping_file'] ?? null,
                'component_lot_certificate' => $validatedData['component_lot_certificate'] ?? null,
                'component_lot_certificate_file' => $uploadedFiles['component_lot_certificate_file'] ?? null,
                'component_visual_inspection' => $validatedData['component_visual_inspection'] ?? null,
                'component_visual_inspection_file' => $uploadedFiles['component_visual_inspection_file'] ?? null,
                'component_electrical_test' => $validatedData['component_electrical_test'] ?? null,
                'component_electrical_test_file' => $uploadedFiles['component_electrical_test_file'] ?? null,
                'component_measurement' => $validatedData['component_measurement'] ?? null,
                'component_measurement_file' => $uploadedFiles['component_measurement_file'] ?? null,
                'cabling_mechanical_test' => $validatedData['cabling_mechanical_test'] ?? null,
                'cabling_mechanical_test_file' => $uploadedFiles['cabling_mechanical_test_file'] ?? null,
                'cabling_visual_inspection' => $validatedData['cabling_visual_inspection'] ?? null,
                'cabling_visual_inspection_file' => $uploadedFiles['cabling_visual_inspection_file'] ?? null,
                'cabling_electrical_test' => $validatedData['cabling_electrical_test'] ?? null,
                'cabling_electrical_test_file' => $uploadedFiles['cabling_electrical_test_file'] ?? null,
                'suspected_supplier_list' => $validatedData['suspected_supplier_list'] ?? null,
                'suspected_supplier_list_file' => $uploadedFiles['suspected_supplier_list_file'] ?? null,
                'suspected_traceability' => $validatedData['suspected_traceability'] ?? null,
                'suspected_traceability_file' => $uploadedFiles['suspected_traceability_file'] ?? null,
                'suspected_fake_packaging' => $validatedData['suspected_fake_packaging'] ?? null,
                'suspected_fake_packaging_file' => $uploadedFiles['suspected_fake_packaging_file'] ?? null,
                'inspected_by' => $validatedData['inspected_by'] ?? '',
                'approved_by' => $validatedData['approved_by'] ?? '',
                'technician_id' => 2,
                'assigned_to' => 'cagatay.cakir',
                'status' => 'pending',
                'surec_id' => $newSurecId
            ]);
           // dd($newForm);
            
    
            return redirect()->route('dashboard')->with('success', 'Form başarıyla oluşturuldu! with surec id ' . $newSurecId);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    

    // Edit fonksiyonu
    public function edit($id)
    {
        $form = QualityForm::findOrFail($id);
        $disabled = false; // Düzenleme yapılabilir
        return view('quality_forms.edit', compact('form', 'disabled'));
    }

    // bu sadece readonly göstermek için
    public function showReadOnly($id)
    {
        $form = QualityForm::findOrFail($id);
        $disabled = true;
        return view('quality_forms.edit', compact('form', 'disabled'));
    }

    // Update fonksiyonu
   
    public function update(Request $request, $id)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'document_date' => 'required|date',
                'part_stock_number' => 'required|string|max:255',
                'quality_report_number' => 'required|string|max:255',
                'part_description' => 'nullable|string',
                'product_revision' => 'nullable|string',
                'batch_quantity' => 'required|integer',
                'inspected_quantity' => 'required|integer',
                'technical_drawing_qdms' => 'nullable|string',
                'mechanical_measurements' => 'nullable|string',
                'calibration_equipment' => 'nullable|string',
                'electrical_optical_test' => 'nullable|string',
                'supplier_measurement' => 'nullable|string',
                'environmental_conditions' => 'nullable|string',
                'special_process_tests' => 'nullable|string',
                'quality_conformance_certificate' => 'nullable|string',
                'shipping_packaging' => 'nullable|string',
                'counterfeit_suspected' => 'nullable|string',
                'shelf_life' => 'nullable|string',
                'product_type' => 'nullable|array',
                'mechanical_raw_material' => 'nullable|string',
                'mechanical_paint' => 'nullable|string',
                'mechanical_exterior' => 'nullable|string',
                'mechanical_welding_documents' => 'nullable|string',
                'electronics_shipping' => 'nullable|string',
                'electronics_pcb_certificate' => 'nullable|string',
                'electronics_special_process' => 'nullable|string',
                'electronics_pcb_mechanical' => 'nullable|string',
                'electronics_visual_inspection' => 'nullable|string',
                'electronics_electrical_test' => 'nullable|string',
                'component_shipping' => 'nullable|string',
                'component_lot_certificate' => 'nullable|string',
                'component_visual_inspection' => 'nullable|string',
                'component_electrical_test' => 'nullable|string',
                'component_measurement' => 'nullable|string',
                'cabling_mechanical_test' => 'nullable|string',
                'cabling_visual_inspection' => 'nullable|string',
                'cabling_electrical_test' => 'nullable|string',
                'suspected_supplier_list' => 'nullable|string',
                'suspected_traceability' => 'nullable|string',
                'suspected_fake_packaging' => 'nullable|string',
                'inspected_by' => 'required|string|max:255',
                'approved_by' => 'required|string|max:255',
            ]);
    
            $form = QualityForm::findOrFail($id);
    
            // Dosya yükleme işlemleri
            $fileFields = [
                'technical_drawing_qdms_file' => 'technical_drawing_qdms_file',
                'mechanical_measurements_file' => 'mechanical_measurements_file',
                'calibration_equipment_file' => 'calibration_equipment_file',
                'electrical_optical_test_file' => 'electrical_optical_test_file',
                'supplier_measurement_file' => 'supplier_measurement_file',
                'environmental_conditions_file' => 'environmental_conditions_file',
                'special_process_tests_file' => 'special_process_tests_file',
                'quality_conformance_certificate_file' => 'quality_conformance_certificate_file',
                'shipping_packaging_file' => 'shipping_packaging_file',
                'counterfeit_suspected_file' => 'counterfeit_suspected_file',
                'shelf_life_file' => 'shelf_life_file',
                'mechanical_raw_material_file' => 'mechanical_raw_material_file',
                'mechanical_paint_file' => 'mechanical_paint_file',
                'mechanical_exterior_file' => 'mechanical_exterior_file',
                'mechanical_welding_documents_file' => 'mechanical_welding_documents_file',
                'electronics_shipping_file' => 'electronics_shipping_file',
                'electronics_pcb_certificate_file' => 'electronics_pcb_certificate_file',
                'electronics_special_process_file' => 'electronics_special_process_file',
                'component_shipping_file' => 'component_shipping_file',
                'component_lot_certificate_file' => 'component_lot_certificate_file',
                'component_visual_inspection_file' => 'component_visual_inspection_file',
                'component_electrical_test_file' => 'component_electrical_test_file',
                'component_measurement_file' => 'component_measurement_file',
                'cabling_mechanical_test_file' => 'cabling_mechanical_test_file',
                'cabling_visual_inspection_file' => 'cabling_visual_inspection_file',
                'cabling_electrical_test_file' => 'cabling_electrical_test_file',
                'suspected_supplier_list_file' => 'suspected_supplier_list_file',
                'suspected_traceability_file' => 'suspected_traceability_file',
                'suspected_fake_packaging_file' => 'suspected_fake_packaging_file',
            ];
    
            $uploadedFiles = [];
    
            foreach ($fileFields as $field => $inputName) {
                if ($request->hasFile($inputName)) {
                    if ($form->$field && Storage::disk('public')->exists($form->$field)) {
                        Storage::disk('public')->delete($form->$field);
                    }
                    $uploadedFiles[$field] = $request->file($inputName)->store('files', 'public');
                } else {
                    $uploadedFiles[$field] = $form->$field;
                }
            }
    
            // Kullanıcı rolüne göre statü ve mesaj ayarlama
            $role = session('role');
            $status = $form->status;
            $successMessage = '';
    
            if ($role === 'tekniker') {
                // Tekniker tarafından güncelleniyorsa, mühendise gönderildi
                $status = 'sent to engineer again';
                $successMessage = 'Form başarıyla tekrar mühendise gönderildi.';
            } elseif ($role === 'mühendis') {
                // Mühendis tarafından finalize ediliyorsa, tamamlandı
                $status = 'finished';
                $successMessage = 'Form başarıyla tamamlandı.';
            }
    
            // Form verilerini güncelle
            $form->update([
                'document_date' => $validatedData['document_date'],
                'part_stock_number' => $validatedData['part_stock_number'],
                'quality_report_number' => $validatedData['quality_report_number'],
                'part_description' => $validatedData['part_description'] ?? null,
                'technical_drawing_qdms_file' => $uploadedFiles['technical_drawing_qdms_file'] ?? $form->technical_drawing_qdms_file,
                'mechanical_measurements_file' => $uploadedFiles['mechanical_measurements_file'] ?? $form->mechanical_measurements_file,
                'calibration_equipment_file' => $uploadedFiles['calibration_equipment_file'] ?? $form->calibration_equipment_file,
                'electrical_optical_test_file' => $uploadedFiles['electrical_optical_test_file'] ?? $form->electrical_optical_test_file,
                'supplier_measurement_file' => $uploadedFiles['supplier_measurement_file'] ?? $form->supplier_measurement_file,
                'environmental_conditions_file' => $uploadedFiles['environmental_conditions_file'] ?? $form->environmental_conditions_file,
                'special_process_tests_file' => $uploadedFiles['special_process_tests_file'] ?? $form->special_process_tests_file,
                'quality_conformance_certificate_file' => $uploadedFiles['quality_conformance_certificate_file'] ?? $form->quality_conformance_certificate_file,
                'shipping_packaging_file' => $uploadedFiles['shipping_packaging_file'] ?? $form->shipping_packaging_file,
                'counterfeit_suspected_file' => $uploadedFiles['counterfeit_suspected_file'] ?? $form->counterfeit_suspected_file,
                'shelf_life_file' => $uploadedFiles['shelf_life_file'] ?? $form->shelf_life_file,
                'product_type' => isset($validatedData['product_type']) ? json_encode($validatedData['product_type']) : $form->product_type,
                'mechanical_raw_material_file' => $uploadedFiles['mechanical_raw_material_file'] ?? $form->mechanical_raw_material_file,
                'mechanical_paint_file' => $uploadedFiles['mechanical_paint_file'] ?? $form->mechanical_paint_file,
                'mechanical_exterior_file' => $uploadedFiles['mechanical_exterior_file'] ?? $form->mechanical_exterior_file,
                'mechanical_welding_documents_file' => $uploadedFiles['mechanical_welding_documents_file'] ?? $form->mechanical_welding_documents_file,
                'electronics_shipping_file' => $uploadedFiles['electronics_shipping_file'] ?? $form->electronics_shipping_file,
                'electronics_pcb_certificate_file' => $uploadedFiles['electronics_pcb_certificate_file'] ?? $form->electronics_pcb_certificate_file,
                'electronics_special_process_file' => $uploadedFiles['electronics_special_process_file'] ?? $form->electronics_special_process_file,
                'component_shipping_file' => $uploadedFiles['component_shipping_file'] ?? $form->component_shipping_file,
                'component_lot_certificate_file' => $uploadedFiles['component_lot_certificate_file'] ?? $form->component_lot_certificate_file,
                'component_visual_inspection_file' => $uploadedFiles['component_visual_inspection_file'] ?? $form->component_visual_inspection_file,
                'component_electrical_test_file' => $uploadedFiles['component_electrical_test_file'] ?? $form->component_electrical_test_file,
                'component_measurement_file' => $uploadedFiles['component_measurement_file'] ?? $form->component_measurement_file,
                'cabling_mechanical_test_file' => $uploadedFiles['cabling_mechanical_test_file'] ?? $form->cabling_mechanical_test_file,
                'cabling_visual_inspection_file' => $uploadedFiles['cabling_visual_inspection_file'] ?? $form->cabling_visual_inspection_file,
                'cabling_electrical_test_file' => $uploadedFiles['cabling_electrical_test_file'] ?? $form->cabling_electrical_test_file,
                'suspected_supplier_list_file' => $uploadedFiles['suspected_supplier_list_file'] ?? $form->suspected_supplier_list_file,
                'suspected_traceability_file' => $uploadedFiles['suspected_traceability_file'] ?? $form->suspected_traceability_file,
                'suspected_fake_packaging_file' => $uploadedFiles['suspected_fake_packaging_file'] ?? $form->suspected_fake_packaging_file,
                'inspected_by' => $validatedData['inspected_by'],
                'approved_by' => $validatedData['approved_by'],
                'status' => $status, // Statü güncellemesi burada yapılır
            ]);
    
            return redirect()->route('form.edit', $form->id)->with('success', $successMessage);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    
    

    public function submittedForms(Request $request)
    {
        // Şu anda oturum açmış teknikeri alıyoruz
        $user = "tekniker";
        // Teknikerin gönderdiği Formları çekiyoruz
        $forms = QualityForm::get();
        return view('technician.submitted_forms', compact('forms'));
    }
    public function rejectedForms()
    {
        // Reddedilen Formlar çekiliyor
        $rejectedForms = QualityForm::where('status', 'rejected')->get();

        // 'rejected_forms' görünümüne veriler gönderiliyor
        return view('technician.rejected_forms', compact('rejectedForms'));
    }


    // Mühendis için atanmış Formları gösterir
    public function index(Request $request)
    {
        $username = $request->session()->get('username');
        $forms = QualityForm::where('assigned_to', $username)->get();

        return view('quality_forms.assigned', ['forms' => $forms]);
    }

    public function showAssignedForms(Request $request)
    {
        $username = $request->session()->get('username');
        Log::info('Session verileri:', $request->session()->all());
        if (!$username) {
            Log::warning('Kullanıcı adı session\'dan alınamadı.');
        } else {
            Log::info('Kullanıcı adı session\'dan başarıyla alındı.', ['username' => $username]);
        }

        $forms = QualityForm::where('assigned_to', $username)
                    ->where('status', 'pending')
                    ->get();


        return view('quality_forms.assigned', ['forms' => $forms]);
    }

    public function showReport()
    {
        // Finished olan Formlari çekiyoruz
        $finishedProcesses = QualityForm::where('status', 'finished')->get();

        // Görünüme veriler gönderiliyor
        return view('quality_forms.report', compact('finishedProcesses'));
    }
    public function showTumReport()
    {
        // Tüm olan Formlari çekiyoruz
        $allProcesses = QualityForm::get();


        // Görünüme veriler gönderiliyor
        return view('quality_forms.tum_report', compact('allProcesses'));
    }


    


    // Formu onayla
    public function approve(Request $request, $id)
    {
        $form = QualityForm::findOrFail($id);

        // Formu onayla ve engineer_id'yi güncelle
        $form->update([
            'status' => 'approved',
            'engineer_id' => auth()->id(),  // Oturum açmış mühendisin ID'si buraya kaydediliyor
        ]);

        return redirect()->route('mühendis.assigned')->with('success', 'Form onaylandı!');
    }

    // Formu reddet
    public function reject(Request $request, $id)
    {
        $form = QualityForm::findOrFail($id);

        // Formu reddet ve engineer_id'yi güncelle
        $form->update([
            'status' => 'rejected',
            'engineer_id' => auth()->id(),  // Oturum açmış mühendisin ID'si buraya kaydediliyor
        ]);

        return redirect()->route('mühendis.assigned')->with('success', 'Form reddedildi!');
    }

    // bu kendisine geri gönderilen bir süreci tamamen silmek için kullanılır
    public function delete($id)
    {
        // Veritabanından formu buluyoruz
        $form = QualityForm::find($id);

        if ($form) {
            $form->delete(); // Formu veritabanından siliyoruz
            return redirect()->route('technician.rejected_forms')->with('success', 'Form başarıyla silindi.');
        }

        return redirect()->route('technician.rejected_forms')->with('error', 'Form bulunamadı.');
    }

}
