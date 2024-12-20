@extends('layouts.app')

@section('content')
<div class="container">
    <h2>TKKF/ FR-KYM-247 Formu Düzenle</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

     <!-- Hata Mesajları -->
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form id="form" action="{{ route('form.update_technician', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Form güncellemesi için -->

        <!-- Doküman Bilgileri -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="document_date" class="form-label">Doküman Tarihi</label>
                <input type="date" class="form-control" id="document_date" name="document_date" value="{{ $form->document_date }}" required    @if($disabled) disabled @endif>
            </div>
            <div class="col-md-6">
                <label for="document_no" class="form-label">Doküman No</label>
                <input type="text" class="form-control" id="document_no" name="document_no" value="{{ $form->document_no }}" readonly>
            </div>
        </div>

        <!-- Parça Bilgileri -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="part_stock_number" class="form-label">Parça Stok Numarası</label>
                <input type="text" class="form-control" id="part_stock_number" name="part_stock_number" value="{{ $form->part_stock_number }}" required    @if($disabled) disabled @endif>
            </div>
            <div class="col-md-6">
                <label for="quality_report_number" class="form-label">Tedarik Kalite Kontrol Rapor Numarası</label>
                <input type="text" class="form-control" id="quality_report_number" name="quality_report_number" value="{{ $form->quality_report_number }}" required    @if($disabled) disabled @endif>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="part_description" class="form-label">Parça Stok Tanımı</label>
                <input type="text" class="form-control" id="part_description" name="part_description" value="{{ $form->part_description }}" required    @if($disabled) disabled @endif>
            </div>
            <div class="col-md-6">
                <label for="product_revision" class="form-label">Kontrol Edilen Ürün Revizyonu</label>
                <input type="text" class="form-control" id="product_revision" name="product_revision" value="{{ $form->product_revision }}" required    @if($disabled) disabled @endif>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="batch_quantity" class="form-label">Partide Gelen Parça Miktarı</label>
                <input type="number" class="form-control" id="batch_quantity" name="batch_quantity" value="{{ $form->batch_quantity }}" required    @if($disabled) disabled @endif>
            </div>
            <div class="col-md-6">
                <label for="inspected_quantity" class="form-label">Kontrol Edilen Parça Miktarı</label>
                <input type="number" class="form-control" id="inspected_quantity" name="inspected_quantity" value="{{ $form->inspected_quantity }}" required    @if($disabled) disabled @endif>
            </div>
        </div>

        <!-- Genel Sorular -->
        <div class="mb-3">
            <label>Teknik Resim QDMS'te var mı?</label>
            <div>
                <input type="radio" name="technical_drawing_qdms" value="evet" 
                       {{ $form->technical_drawing_qdms == 'evet' ? 'checked' : '' }} 
                       @if($disabled) disabled @endif> Evet
        
                <input type="radio" name="technical_drawing_qdms" value="hayır" 
                       {{ $form->technical_drawing_qdms == 'hayır' ? 'checked' : '' }} 
                       @if($disabled) disabled @endif> Hayır
        
                <input type="radio" name="technical_drawing_qdms" value="gd" 
                       {{ $form->technical_drawing_qdms == 'gd' ? 'checked' : '' }} 
                       @if($disabled) disabled @endif> G/D
        
                <input type="file" class="form-control mt-2" name="technical_drawing_qdms_file" 
                       @if($disabled) disabled @endif> <!-- Dosya yükleme alanı disabled -->
            </div>
        
            @if ($form->technical_drawing_qdms_file)
                <a href="{{ asset('storage/' . $form->technical_drawing_qdms_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>
        

        <div class="mb-3">
        <label>Genel mekanik ölçüm sonuçları uygun mu?</label>
        <div>
            <input type="radio" name="mechanical_measurements" value="evet" 
                {{ $form->mechanical_measurements == 'evet' ? 'checked' : '' }} 
                @if($disabled) disabled @endif> Evet

            <input type="radio" name="mechanical_measurements" value="hayır" 
                {{ $form->mechanical_measurements == 'hayır' ? 'checked' : '' }} 
                @if($disabled) disabled @endif> Hayır

            <input type="radio" name="mechanical_measurements" value="gd" 
                {{ $form->mechanical_measurements == 'gd' ? 'checked' : '' }} 
                @if($disabled) disabled @endif> G/D

            <input type="file" class="form-control mt-2" name="mechanical_measurements_file" 
                @if($disabled) disabled @endif> <!-- Dosya yükleme alanı disabled -->
        </div>
        
        @if ($form->mechanical_measurements_file)
            <a href="{{ asset('storage/' . $form->mechanical_measurements_file) }}" target="_blank">Dosyayı Görüntüle</a>
        @endif
        </div>


        <div class="mb-3">
            <label>Ölçüm yapılan ekipmanlar listesi, kalibrasyon numaraları eklenmeli mi?</label>
            <div>
                <input type="radio" name="calibration_equipment" value="evet" 
                    {{ $form->calibration_equipment == 'evet' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> Evet

                <input type="radio" name="calibration_equipment" value="hayır" 
                    {{ $form->calibration_equipment == 'hayır' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> Hayır

                <input type="radio" name="calibration_equipment" value="gd" 
                    {{ $form->calibration_equipment == 'gd' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> G/D

                <input type="file" class="form-control mt-2" name="calibration_equipment_file" 
                    @if($disabled) disabled @endif> <!-- Dosya yükleme alanı disabled -->
            </div>
            
            @if ($form->calibration_equipment_file)
                <a href="{{ asset('storage/' . $form->calibration_equipment_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>


        <div class="mb-3">
            <label>Elektriksel/optik ölçüm sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="electrical_optical_test" value="evet" 
                    {{ $form->electrical_optical_test == 'evet' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> Evet

                <input type="radio" name="electrical_optical_test" value="hayır" 
                    {{ $form->electrical_optical_test == 'hayır' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> Hayır

                <input type="radio" name="electrical_optical_test" value="gd" 
                    {{ $form->electrical_optical_test == 'gd' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> G/D

                <input type="file" class="form-control mt-2" name="electrical_optical_test_file" 
                    @if($disabled) disabled @endif> <!-- Dosya yükleme alanı disabled -->
            </div>

            @if ($form->electrical_optical_test_file)
                <a href="{{ asset('storage/' . $form->electrical_optical_test_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>


        <div class="mb-3">
            <label>Tedarikçi ölçüm/test sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="supplier_measurement" value="evet" 
                    {{ $form->supplier_measurement == 'evet' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> Evet

                <input type="radio" name="supplier_measurement" value="hayır" 
                    {{ $form->supplier_measurement == 'hayır' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> Hayır

                <input type="radio" name="supplier_measurement" value="gd" 
                    {{ $form->supplier_measurement == 'gd' ? 'checked' : '' }} 
                    @if($disabled) disabled @endif> G/D

                <input type="file" class="form-control mt-2" name="supplier_measurement_file" 
                    @if($disabled) disabled @endif> <!-- Dosya yükleme alanı disabled -->
            </div>

            @if ($form->supplier_measurement_file)
                <a href="{{ asset('storage/' . $form->supplier_measurement_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <div class="mb-3">
            <label>Çevre koşulları test sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="environmental_conditions" value="evet" {{ $form->environmental_conditions == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                <input type="radio" name="environmental_conditions" value="hayır" {{ $form->environmental_conditions == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                <input type="radio" name="environmental_conditions" value="gd" {{ $form->environmental_conditions == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                <input type="file" class="form-control mt-2" name="environmental_conditions_file" @if($disabled) disabled @endif>
            </div>
            @if ($form->environmental_conditions_file)
                <a href="{{ asset('storage/' . $form->environmental_conditions_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <div class="mb-3">
            <label>Özel proses test sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="special_process_tests" value="evet" {{ $form->special_process_tests == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                <input type="radio" name="special_process_tests" value="hayır" {{ $form->special_process_tests == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                <input type="radio" name="special_process_tests" value="gd" {{ $form->special_process_tests == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                <input type="file" class="form-control mt-2" name="special_process_tests_file" @if($disabled) disabled @endif>
            </div>
            @if ($form->special_process_tests_file)
                <a href="{{ asset('storage/' . $form->special_process_tests_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <div class="mb-3">
            <label>Ürün Kalite Uygunluk Belgesi mevcut mu, isterlere göre uygun mu?</label>
            <div>
                <input type="radio" name="quality_conformance_certificate" value="evet" {{ $form->quality_conformance_certificate == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                <input type="radio" name="quality_conformance_certificate" value="hayır" {{ $form->quality_conformance_certificate == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                <input type="radio" name="quality_conformance_certificate" value="gd" {{ $form->quality_conformance_certificate == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                <input type="file" class="form-control mt-2" name="quality_conformance_certificate_file" @if($disabled) disabled @endif>
            </div>
            @if ($form->quality_conformance_certificate_file)
                <a href="{{ asset('storage/' . $form->quality_conformance_certificate_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <div class="mb-3">
            <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
            <div>
                <input type="radio" name="shipping_packaging" value="evet" {{ $form->shipping_packaging == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                <input type="radio" name="shipping_packaging" value="hayır" {{ $form->shipping_packaging == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                <input type="radio" name="shipping_packaging" value="gd" {{ $form->shipping_packaging == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                <input type="file" class="form-control mt-2" name="shipping_packaging_file" @if($disabled) disabled @endif>
            </div>
            @if ($form->shipping_packaging_file)
                <a href="{{ asset('storage/' . $form->shipping_packaging_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <div class="mb-3">
            <label>Üründe sahte ya da taklit ürün süphesi var mı?</label>
            <div>
                <input type="radio" name="counterfeit_suspected" value="evet" {{ $form->counterfeit_suspected == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                <input type="radio" name="counterfeit_suspected" value="hayır" {{ $form->counterfeit_suspected == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                <input type="radio" name="counterfeit_suspected" value="gd" {{ $form->counterfeit_suspected == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                <input type="file" class="form-control mt-2" name="counterfeit_suspected_file" @if($disabled) disabled @endif>
            </div>
            @if ($form->counterfeit_suspected_file)
                <a href="{{ asset('storage/' . $form->counterfeit_suspected_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <div class="mb-3">
            <label>Ürün raf ömrü olan malzeme mi? SKT süreci başlatıldı mı?</label>
            <div>
                <input type="radio" name="shelf_life" value="evet" {{ $form->shelf_life == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                <input type="radio" name="shelf_life" value="hayır" {{ $form->shelf_life == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                <input type="radio" name="shelf_life" value="gd" {{ $form->shelf_life == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                <input type="file" class="form-control mt-2" name="shelf_life_file" @if($disabled) disabled @endif>
            </div>
            @if ($form->shelf_life_file)
                <a href="{{ asset('storage/' . $form->shelf_life_file) }}" target="_blank">Dosyayı Görüntüle</a>
            @endif
        </div>

        <h4>ÜRÜN BAZLI SEÇİM YAPINIZ</h4>
        @php
            $productTypes = $form->product_type ? json_decode($form->product_type, true) : [];
        @endphp

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="mechanical" name="product_type[]" value="mechanical" {{ in_array('mechanical', $productTypes) ? 'checked' : '' }} @if($disabled) disabled @endif>
            <label class="form-check-label" for="mechanical">Mekanik/Mechanical</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="electronics" name="product_type[]" value="electronics" {{ in_array('electronics', $productTypes) ? 'checked' : '' }} @if($disabled) disabled @endif>
            <label class="form-check-label" for="electronics">Elektronik/Electronics</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="component" name="product_type[]" value="component" {{ in_array('component', $productTypes) ? 'checked' : '' }} @if($disabled) disabled @endif>
            <label class="form-check-label" for="component">Komponent/Component</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cabling" name="product_type[]" value="cabling" {{ in_array('cabling', $productTypes) ? 'checked' : '' }} @if($disabled) disabled @endif>
            <label class="form-check-label" for="cabling">Kablaj/Cabling</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="suspected_fake" name="product_type[]" value="suspected_fake" {{ in_array('suspected_fake', $productTypes) ? 'checked' : '' }} @if($disabled) disabled @endif>
            <label class="form-check-label" for="suspected_fake">Şüpheli/Sahte Parça</label>
        </div>



        <!-- Mekanik Soruları -->
        <div id="mechanical-questions" class="product-section {{ in_array('mechanical', json_decode($form->product_type ?? '[]', true)) ? '' : 'd-none' }}">
            <h5>Mekanik Soruları</h5>
            <div class="mb-3">
                <label>Ürünün ham maddesi teknik isterlere uygun mu? Ham madde Kalite Uygunluk Belgesi mevcut mu?</label>
                <div>
                    <input type="radio" name="mechanical_raw_material" value="evet" {{ $form->mechanical_raw_material == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="mechanical_raw_material" value="hayır" {{ $form->mechanical_raw_material == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="mechanical_raw_material" value="gd" {{ $form->mechanical_raw_material == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_raw_material_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->mechanical_raw_material_file)
                <a href="{{ asset('storage/' . $form->mechanical_raw_material_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Ürün boyası/kaplaması uygun mu? Boya/kaplama Kalite Uygunluk Belgesi mevcut mu?</label>
                <div>
                    <input type="radio" name="mechanical_paint" value="evet" {{ $form->mechanical_paint == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="mechanical_paint" value="hayır" {{ $form->mechanical_paint == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="mechanical_paint" value="gd" {{ $form->mechanical_paint == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_paint_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->mechanical_paint_file)
                <a href="{{ asset('storage/' . $form->mechanical_paint_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Ürün dış görünüşünde ezik, çizik ve boya sorunları var mı? Görsel kontroller uygun mu?</label>
                <div>
                    <input type="radio" name="mechanical_exterior" value="evet" {{ $form->mechanical_exterior == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="mechanical_exterior" value="hayır" {{ $form->mechanical_exterior == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="mechanical_exterior" value="gd" {{ $form->mechanical_exterior == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_exterior_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->mechanical_exterior_file)
                <a href="{{ asset('storage/' . $form->mechanical_exterior_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Özel kaynak prosedür uygunluk belgeleri mevcut mu? WPS, WPQR, Penetrant test sonuçları mevcut mu?</label>
                <div>
                    <input type="radio" name="mechanical_welding_documents" value="evet" {{ $form->mechanical_welding_documents == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="mechanical_welding_documents" value="hayır" {{ $form->mechanical_welding_documents == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="mechanical_welding_documents" value="gd" {{ $form->mechanical_welding_documents == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_welding_documents_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->mechanical_welding_documents_file)
                <a href="{{ asset('storage/' . $form->mechanical_welding_documents_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>
        </div>

        <!-- Elektronik Soruları -->
        <div id="electronics-questions" class="product-section {{ in_array('electronics', json_decode($form->product_type ?? '[]', true)) ? '' : 'd-none' }}">
            <h5>Elektronik Soruları</h5>

            <div class="mb-3">
                <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_shipping" value="evet" {{ $form->electronics_shipping == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="electronics_shipping" value="hayır" {{ $form->electronics_shipping == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="electronics_shipping" value="gd" {{ $form->electronics_shipping == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="electronics_shipping_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->electronics_shipping_file)
                <a href="{{ asset('storage/' . $form->electronics_shipping_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Boş BDK (Baskı Devre Kartı) Kalite Uygunluk Belgesi mevcut mu?</label>
                <div>
                    <input type="radio" name="electronics_pcb_certificate" value="evet" {{ $form->electronics_pcb_certificate == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="electronics_pcb_certificate" value="hayır" {{ $form->electronics_pcb_certificate == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="electronics_pcb_certificate" value="gd" {{ $form->electronics_pcb_certificate == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="electronics_pcb_certificate_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->electronics_pcb_certificate_file)
                <a href="{{ asset('storage/' . $form->electronics_pcb_certificate_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Özel proses (krimpleme, lehim, konformal kaplama vs.) test sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_special_process" value="evet" {{ $form->electronics_special_process == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="electronics_special_process" value="hayır" {{ $form->electronics_special_process == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="electronics_special_process" value="gd" {{ $form->electronics_special_process == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="electronics_special_process_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->electronics_special_process_file)
                <a href="{{ asset('storage/' . $form->electronics_special_process_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>
        </div>

        <!-- Onay Bölümları -->
        <!-- Komponent Soruları -->
        <div id="component-questions" class="product-section {{ in_array('component', json_decode($form->product_type ?? '[]', true)) ? '' : 'd-none' }}">
            <h5>Komponent Soruları</h5>
            <div class="mb-3">
                <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
                <div>
                    <input type="radio" name="component_shipping" value="evet" {{ $form->component_shipping == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="component_shipping" value="hayır" {{ $form->component_shipping == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="component_shipping" value="gd" {{ $form->component_shipping == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="component_shipping_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->component_shipping_file)
                <a href="{{ asset('storage/' . $form->component_shipping_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Ürünün Kalite Uygunluk Belgesi, LOT numarası uygun mu?</label>
                <div>
                    <input type="radio" name="component_lot_certificate" value="evet" {{ $form->component_lot_certificate == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="component_lot_certificate" value="hayır" {{ $form->component_lot_certificate == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="component_lot_certificate" value="gd" {{ $form->component_lot_certificate == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="component_lot_certificate_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->component_lot_certificate_file)
                <a href="{{ asset('storage/' . $form->component_lot_certificate_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Göz denetim sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="component_visual_inspection" value="evet" {{ $form->component_visual_inspection == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="component_visual_inspection" value="hayır" {{ $form->component_visual_inspection == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="component_visual_inspection" value="gd" {{ $form->component_visual_inspection == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="component_visual_inspection_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->component_visual_inspection_file)
                <a href="{{ asset('storage/' . $form->component_visual_inspection_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Elektriksel/Fonksiyonel test sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="component_electrical_test" value="evet" {{ $form->component_electrical_test == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="component_electrical_test" value="hayır" {{ $form->component_electrical_test == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="component_electrical_test" value="gd" {{ $form->component_electrical_test == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="component_electrical_test_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->component_electrical_test_file)
                <a href="{{ asset('storage/' . $form->component_electrical_test_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Elektriksel ölçüm sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="component_measurement" value="evet" {{ $form->component_measurement == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="component_measurement" value="hayır" {{ $form->component_measurement == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="component_measurement" value="gd" {{ $form->component_measurement == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="component_measurement_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->component_measurement_file)
                <a href="{{ asset('storage/' . $form->component_measurement_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>
        </div>

        <!-- Kablaj Soruları -->
        <div id="cabling-questions" class="product-section {{ in_array('cabling', json_decode($form->product_type ?? '[]', true)) ? '' : 'd-none' }}">
            <h5>Kablaj Soruları</h5>
            <div class="mb-3">
                <label>Kablo, konnektör ve kablajın mekanik ölçü ve denetimi sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="cabling_mechanical_test" value="evet" {{ $form->cabling_mechanical_test == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="cabling_mechanical_test" value="hayır" {{ $form->cabling_mechanical_test == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="cabling_mechanical_test" value="gd" {{ $form->cabling_mechanical_test == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="cabling_mechanical_test_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->cabling_mechanical_test_file)
                <a href="{{ asset('storage/' . $form->cabling_mechanical_test_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Göz denetimi sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="cabling_visual_inspection" value="evet" {{ $form->cabling_visual_inspection == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="cabling_visual_inspection" value="hayır" {{ $form->cabling_visual_inspection == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="cabling_visual_inspection" value="gd" {{ $form->cabling_visual_inspection == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="cabling_visual_inspection_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->cabling_visual_inspection_file)
                <a href="{{ asset('storage/' . $form->cabling_visual_inspection_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Elektriksel test sonuçları uygun mu? Üretici test raporları mevcut mu?</label>
                <div>
                    <input type="radio" name="cabling_electrical_test" value="evet" {{ $form->cabling_electrical_test == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="cabling_electrical_test" value="hayır" {{ $form->cabling_electrical_test == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="cabling_electrical_test" value="gd" {{ $form->cabling_electrical_test == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="cabling_electrical_test_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->cabling_electrical_test_file)
                <a href="{{ asset('storage/' . $form->cabling_electrical_test_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>
        </div>

        <!-- Şüpheli/Sahte Parça Soruları -->
        <div id="suspected_fake-questions" class="product-section {{ in_array('suspected_fake', json_decode($form->product_type ?? '[]', true)) ? '' : 'd-none' }}">
            <h5>Şüpheli/Sahte Parça Soruları</h5>
            <div class="mb-3">
                <label>Ürünün tedarikçisi/distribütörü onaylı tedarikçi listesinde mi?</label>
                <div>
                    <input type="radio" name="suspected_supplier_list" value="evet" {{ $form->suspected_supplier_list == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="suspected_supplier_list" value="hayır" {{ $form->suspected_supplier_list == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="suspected_supplier_list" value="gd" {{ $form->suspected_supplier_list == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="suspected_supplier_list_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->suspected_supplier_list_file)
                <a href="{{ asset('storage/' . $form->suspected_supplier_list_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Ürünün orijinal üreticisine olan izlenebilirliğini gösteren kaynaklar mevcut mu?</label>
                <div>
                    <input type="radio" name="suspected_traceability" value="evet" {{ $form->suspected_traceability == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="suspected_traceability" value="hayır" {{ $form->suspected_traceability == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="suspected_traceability" value="gd" {{ $form->suspected_traceability == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="suspected_traceability_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->suspected_traceability_file)
                <a href="{{ asset('storage/' . $form->suspected_traceability_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>

            <div class="mb-3">
                <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
                <div>
                    <input type="radio" name="suspected_fake_packaging" value="evet" {{ $form->suspected_fake_packaging == 'evet' ? 'checked' : '' }} @if($disabled) disabled @endif> Evet
                    <input type="radio" name="suspected_fake_packaging" value="hayır" {{ $form->suspected_fake_packaging == 'hayır' ? 'checked' : '' }} @if($disabled) disabled @endif> Hayır
                    <input type="radio" name="suspected_fake_packaging" value="gd" {{ $form->suspected_fake_packaging == 'gd' ? 'checked' : '' }} @if($disabled) disabled @endif> G/D
                    <input type="file" class="form-control mt-2" name="suspected_fake_packaging_file" @if($disabled) disabled @endif>
                </div>
                @if ($form->suspected_fake_packaging_file)
                <a href="{{ asset('storage/' . $form->suspected_fake_packaging_file) }}" target="_blank">Dosyayı Görüntüle</a>
                @endif
            </div>
        </div>

       

        <!-- Onay Bölümü -->
        <div class="row mt-5">
            <div class="col-md-6">
                <label for="inspected_by" class="form-label">Kontrol Eden (Inspected By)</label>
                <input type="text" class="form-control" id="inspected_by" name="inspected_by" value="{{ $form->inspected_by }}"  @if($disabled) disabled @endif> 
            </div>
            <div class="col-md-6">
                <label for="approved_by" class="form-label">Onaylayan (Approved By)</label>
                <input type="text" class="form-control" id="approved_by" name="approved_by" value="{{ $form->approved_by }}"  @if($disabled) disabled @endif> 
            </div>
        </div>

   <!-- Submit Button -->
    <button type="button" class="btn btn-primary mt-4" id="submitBtn" @if($disabled) disabled @endif>Onayla</button>
    
        
    </form>
    <form id="rejectForm" action="{{ route('form.reject', $form->id) }}" method="POST">
    @csrf
    @method('POST') <!-- Reddetme işlemi için de PUT kullanıyoruz -->
  
</form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productCheckboxes = document.querySelectorAll('input[name="product_type[]"]');
        const inputs = {
            technical_drawing_qdms_file: document.getElementById('technical_drawing_qdms_file'),
            mechanical_measurements_file: document.getElementById('mechanical_measurements_file'),
            calibration_equipment_file: document.getElementById('calibration_equipment_file'),
            electrical_optical_test_file: document.getElementById('electrical_optical_test_file'),
            supplier_measurement_file: document.getElementById('supplier_measurement_file'),
            environmental_conditions_file: document.getElementById('environmental_conditions_file'),
            special_process_tests_file: document.getElementById('special_process_tests_file'),
            quality_conformance_certificate_file: document.getElementById('quality_conformance_certificate_file'),
            shipping_packaging_file: document.getElementById('shipping_packaging_file'),
            counterfeit_suspected_file: document.getElementById('counterfeit_suspected_file'),
            shelf_life_file: document.getElementById('shelf_life_file'),
            mechanical_raw_material_file: document.getElementById('mechanical_raw_material_file'),
            mechanical_paint_file: document.getElementById('mechanical_paint_file'),
            mechanical_exterior_file: document.getElementById('mechanical_exterior_file'),
            mechanical_welding_documents_file: document.getElementById('mechanical_welding_documents_file'),
            electronics_shipping_file: document.getElementById('electronics_shipping_file'),
            electronics_pcb_certificate_file: document.getElementById('electronics_pcb_certificate_file'),
            electronics_special_process_file: document.getElementById('electronics_special_process_file'),
            component_shipping_file: document.getElementById('component_shipping_file'),
            component_lot_certificate_file: document.getElementById('component_lot_certificate_file'),
            component_visual_inspection_file: document.getElementById('component_visual_inspection_file'),
            component_electrical_test_file: document.getElementById('component_electrical_test_file'),
            component_measurement_file: document.getElementById('component_measurement_file'),
            cabling_mechanical_test_file: document.getElementById('cabling_mechanical_test_file'),
            cabling_visual_inspection_file: document.getElementById('cabling_visual_inspection_file'),
            cabling_electrical_test_file: document.getElementById('cabling_electrical_test_file'),
            suspected_supplier_list_file: document.getElementById('suspected_supplier_list_file'),
            suspected_traceability_file: document.getElementById('suspected_traceability_file'),
            suspected_fake_packaging_file: document.getElementById('suspected_fake_packaging_file')
        };

        // Dosya linklerini takip et
        const links = {
            technical_drawing_qdms_file: document.getElementById('technical_drawing_qdms_link'),
            mechanical_measurements_file: document.getElementById('mechanical_measurements_link'),
            calibration_equipment_file: document.getElementById('calibration_equipment_link'),
            electrical_optical_test_file: document.getElementById('electrical_optical_test_link'),
            supplier_measurement_file: document.getElementById('supplier_measurement_link'),
            environmental_conditions_file: document.getElementById('environmental_conditions_link'),
            special_process_tests_file: document.getElementById('special_process_tests_link'),
            quality_conformance_certificate_file: document.getElementById('quality_conformance_certificate_link'),
            shipping_packaging_file: document.getElementById('shipping_packaging_link'),
            counterfeit_suspected_file: document.getElementById('counterfeit_suspected_link'),
            shelf_life_file: document.getElementById('shelf_life_link'),
            mechanical_raw_material_file: document.getElementById('mechanical_raw_material_link'),
            mechanical_paint_file: document.getElementById('mechanical_paint_link'),
            mechanical_exterior_file: document.getElementById('mechanical_exterior_link'),
            mechanical_welding_documents_file: document.getElementById('mechanical_welding_documents_link'),
            electronics_shipping_file: document.getElementById('electronics_shipping_link'),
            electronics_pcb_certificate_file: document.getElementById('electronics_pcb_certificate_link'),
            electronics_special_process_file: document.getElementById('electronics_special_process_link'),
            component_shipping_file: document.getElementById('component_shipping_link'),
            component_lot_certificate_file: document.getElementById('component_lot_certificate_link'),
            component_visual_inspection_file: document.getElementById('component_visual_inspection_link'),
            component_electrical_test_file: document.getElementById('component_electrical_test_link'),
            component_measurement_file: document.getElementById('component_measurement_link'),
            cabling_mechanical_test_file: document.getElementById('cabling_mechanical_test_link'),
            cabling_visual_inspection_file: document.getElementById('cabling_visual_inspection_link'),
            cabling_electrical_test_file: document.getElementById('cabling_electrical_test_link'),
            suspected_supplier_list_file: document.getElementById('suspected_supplier_list_link'),
            suspected_traceability_file: document.getElementById('suspected_traceability_link'),
            suspected_fake_packaging_file: document.getElementById('suspected_fake_packaging_link')
        };

        // Her dosya input'una bir event listener ekle
        Object.keys(inputs).forEach(function(key) {
            if (inputs[key]) {
                inputs[key].addEventListener('change', function () {
                    if (links[key]) {
                        links[key].style.display = 'none';
                    }
                });
            }
        });
        productCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const section = document.getElementById(this.id + '-questions');
                if (this.checked) {
                    section.classList.remove('d-none');
                } else {
                    section.classList.add('d-none');
                }
            });
        });
    });
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        // SweetAlert onay penceresi
        Swal.fire({
            title: 'Bu form onayınızın ardından tekrar mühendise yönlendirilecektir.',
            text: "Onaylıyor musunuz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Onayla',
            cancelButtonText: 'Hayır, İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log("you here");
                // Formu onayla ve gönder
                document.getElementById('form').submit();
            }
        })
    });

   
</script>

@endsection
