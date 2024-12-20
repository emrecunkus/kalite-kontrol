@extends('layouts.app') @section('content')
<div class="container">
    <!-- Doküman Bilgileri -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="surec_id" class="form-label">FORM ID</label>
            <input type="text" class="form-control" id="surec_id" name="surec_id" value="{{ $formattedSurecId }}" readonly>
        </div>
    </div>
    <h2 class="form-title">TKKF/ FR-KYM-247 Form</h2>

    <!-- Başarı Mesajı -->
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

    <form id="form" action="{{ route('quality_forms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf



        <div class="row mb-3">
            <div class="col-md-6">
                <label for="document_date" class="form-label">Doküman Tarihi</label>
                <input type="date" class="form-control" id="document_date" name="document_date" required>
            </div>
            
            <div class="col-md-6">
                <label for="document_no" class="form-label">Doküman No</label>
                <input type="text" class="form-control" id="document_no" name="document_no" value="TKKF/ FR-KYM-247" readonly>
            </div>
        </div>

        <!-- Parça Bilgileri -->
        <!-- Parça Bilgileri -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="part_stock_number" class="form-label">Parça Stok Numarası</label>
                <input type="text" class="form-control" id="part_stock_number" name="part_stock_number" placeholder="Stok Kodu veya Adı Girin..." autocomplete="off">
                <ul class="list-group" id="suggestions" style="position: absolute; z-index: 1000; max-height: 200px; overflow-y: auto;"></ul>
            </div>
            
            <div class="col-md-6">
                <label for="quality_report_number" class="form-label">Tedarik Kalite Kontrol Rapor Numarası</label>
                <input type="text" class="form-control" id="quality_report_number" name="quality_report_number" value="{{ $newQualityReportNumber ?? '' }}" readonly required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="part_description" class="form-label">Parça Stok Tanımı</label>
                <input type="text" class="form-control" id="part_description" name="part_description" readonly required>
            </div>
            <div class="col-md-6">
                <label for="product_revision" class="form-label">Kontrol Edilen Ürün Revizyonu</label>
                <input type="text" class="form-control" id="product_revision" name="product_revision" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="batch_quantity" class="form-label">Partide Gelen Parça Miktarı</label>
                <input type="number" class="form-control" id="batch_quantity" name="batch_quantity" required>
            </div>
            <div class="col-md-6">
                <label for="inspected_quantity" class="form-label">Kontrol Edilen Parça Miktarı</label>
                <input type="number" class="form-control" id="inspected_quantity" name="inspected_quantity" required>
            </div>

       
        </div>

        <!-- Modal Çağırma Butonu -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dynamicFormModal">
                Envanter ve Kalibrasyon Ekle
            </button>
        </div>
        @include('components.inventory-modal')
       


        <!-- Genel Bölüm -->
        <h4>Genel</h4>

        <!-- Genel Sorular -->
        <div class="mb-3">
            <label>Teknik Resim QDMS te var mı?</label>
            <div>
                <input type="radio" name="technical_drawing_qdms" value="evet" id="qdms_evet"> Evet
                <input type="radio" name="technical_drawing_qdms" value="hayır" id="qdms_hayir"> Hayır
                <input type="radio" name="technical_drawing_qdms" value="gd" id="qdms_gd"> G/D
                <input type="file" class="form-control mt-2" name="technical_drawing_qdms_file">
            </div>
        </div>


        <div class="mb-3">
            <label>Genel mekanik ölçüm sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="mechanical_measurements" value="evet"> Evet
                <input type="radio" name="mechanical_measurements" value="hayır"> Hayır
                <input type="radio" name="mechanical_measurements" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="mechanical_measurements_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Ölçüm yapılan ekipmanlar listesi, kalibrasyon numaraları eklenmeli mi?</label>
            <div>
                <input type="radio" name="calibration_equipment" value="evet"> Evet
                <input type="radio" name="calibration_equipment" value="hayır"> Hayır
                <input type="radio" name="calibration_equipment" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="calibration_equipment_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Elektriksel/optik ölçüm sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="electrical_optical_test" value="evet"> Evet
                <input type="radio" name="electrical_optical_test" value="hayır"> Hayır
                <input type="radio" name="electrical_optical_test" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="electrical_optical_test_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Tedarikçi ölçüm/test sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="supplier_measurement" value="evet"> Evet
                <input type="radio" name="supplier_measurement" value="hayır"> Hayır
                <input type="radio" name="supplier_measurement" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="supplier_measurement_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Çevre koşulları test sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="environmental_conditions" value="evet"> Evet
                <input type="radio" name="environmental_conditions" value="hayır"> Hayır
                <input type="radio" name="environmental_conditions" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="environmental_conditions_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Özel proses test sonuçları uygun mu?</label>
            <div>
                <input type="radio" name="special_process_tests" value="evet"> Evet
                <input type="radio" name="special_process_tests" value="hayır"> Hayır
                <input type="radio" name="special_process_tests" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="special_process_tests_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Ürün Kalite Uygunluk Belgesi mevcut mu, isterlere göre uygun mu?</label>
            <div>
                <input type="radio" name="quality_conformance_certificate" value="evet"> Evet
                <input type="radio" name="quality_conformance_certificate" value="hayır"> Hayır
                <input type="radio" name="quality_conformance_certificate" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="quality_conformance_certificate_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
            <div>
                <input type="radio" name="shipping_packaging" value="evet"> Evet
                <input type="radio" name="shipping_packaging" value="hayır"> Hayır
                <input type="radio" name="shipping_packaging" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="shipping_packaging_file">
            </div>
        </div>

        <div class="mb-3">
            <label>Üründe sahte ya da taklit ürün süphesi var mı?</label>
            <div>
                <input type="radio" name="counterfeit_suspected" value="evet"> Evet
                <input type="radio" name="counterfeit_suspected" value="hayır"> Hayır
                <input type="radio" name="counterfeit_suspected" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="counterfeit_suspected_file">
            </div>
        </div>


        <div class="mb-3">
            <label>Ürün raf ömrü olan malzeme mi? SKT süreci başlatıldı mı?</label>
            <div>
                <input type="radio" name="shelf_life" value="evet"> Evet
                <input type="radio" name="shelf_life" value="hayır"> Hayır
                <input type="radio" name="shelf_life" value="gd"> G/D
                <input type="file" class="form-control mt-2" name="shelf_life_file">
            </div>
        </div>

        <!-- Ürün Bazlı Seçim -->
        <h4>ÜRÜN BAZLI SEÇİM YAPINIZ</h4>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="mechanical" name="product_type[]" value="mechanical">
            <label class="form-check-label" for="mechanical">Mekanik/Mechanical</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="electronics" name="product_type[]" value="electronics">
            <label class="form-check-label" for="electronics">Elektronik/Electronics</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="component" name="product_type[]" value="component">
            <label class="form-check-label" for="component">Komponent/Component</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cabling" name="product_type[]" value="cabling">
            <label class="form-check-label" for="cabling">Kablaj/Cabling</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="suspected_fake" name="product_type[]" value="suspected_fake">
            <label class="form-check-label" for="suspected_fake">Şüpheli/Sahte Parça</label>
        </div>

        <!-- Mekanik Soruları -->
        <div id="mechanical-questions" class="product-section d-none">
            <h5>Mekanik Soruları</h5>
            <div class="mb-3">
                <label>Ürünün ham maddesi teknik isterlere uygun mu? Ham madde Kalite Uygunluk Belgesi mevcut mu?</label>
                <div>
                    <input type="radio" name="mechanical_raw_material" value="evet"> Evet
                    <input type="radio" name="mechanical_raw_material" value="hayır"> Hayır
                    <input type="radio" name="mechanical_raw_material" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_raw_material_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Ürün boyası/kaplaması uygun mu? Boya/kaplama Kalite Uygunluk Belgesi mevcut mu?</label>
                <div>
                    <input type="radio" name="mechanical_paint" value="evet"> Evet
                    <input type="radio" name="mechanical_paint" value="hayır"> Hayır
                    <input type="radio" name="mechanical_paint" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_paint_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Ürün dış görünüşünde ezik, çizik ve boya sorunları var mı? Görsel kontroller uygun mu?</label>
                <div>
                    <input type="radio" name="mechanical_exterior" value="evet"> Evet
                    <input type="radio" name="mechanical_exterior" value="hayır"> Hayır
                    <input type="radio" name="mechanical_exterior" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_exterior_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Özel kaynak prosedür uygunluk belgeleri mevcut mu? WPS, WPQR, Penetrant test sonuçları mevcut mu?</label>
                <div>
                    <input type="radio" name="mechanical_welding_documents" value="evet"> Evet
                    <input type="radio" name="mechanical_welding_documents" value="hayır"> Hayır
                    <input type="radio" name="mechanical_welding_documents" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="mechanical_welding_documents_file">
                </div>
            </div>
        </div>

        <!-- Elektronik Soruları -->
        <div id="electronics-questions" class="product-section d-none">
            <h5>Elektronik Soruları</h5>

            <div class="mb-3">
                <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_shipping" value="evet"> Evet
                    <input type="radio" name="electronics_shipping" value="hayır"> Hayır
                    <input type="radio" name="electronics_shipping" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="electronics_shipping_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Boş BDK (Baskı Devre Kartı) Kalite Uygunluk Belgesi mevcut mu?</label>
                <div>
                    <input type="radio" name="electronics_pcb_certificate" value="evet"> Evet
                    <input type="radio" name="electronics_pcb_certificate" value="hayır"> Hayır
                    <input type="radio" name="electronics_pcb_certificate" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="electronics_pcb_certificate_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Özel proses (krimpleme, lehim, konformal kaplama vs.) test sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_special_process" value="evet"> Evet
                    <input type="radio" name="electronics_special_process" value="hayır"> Hayır
                    <input type="radio" name="electronics_special_process" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="electronics_special_process_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Boş BDK mekanik ölçüleri sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_pcb_mechanical" value="evet"> Evet
                    <input type="radio" name="electronics_pcb_mechanical" value="hayır"> Hayır
                    <input type="radio" name="electronics_pcb_mechanical" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="electronics_pcb_mechanical_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Göz denetim sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_visual_inspection" value="evet"> Evet
                    <input type="radio" name="electronics_visual_inspection" value="hayır"> Hayır
                    <input type="radio" name="electronics_visual_inspection" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="electronics_visual_inspection_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Elektriksel test sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="electronics_electrical_test" value="evet"> Evet
                    <input type="radio" name="electronics_electrical_test" value="hayır"> Hayır
                    <input type="radio" name="electronics_electrical_test" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="electronics_electrical_test_file">
                </div>
            </div>
        </div>

        <!-- Komponent Soruları -->
        <div id="component-questions" class="product-section d-none">
            <h5>Komponent Soruları</h5>

            <div class="mb-3">
                <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
                <div>
                    <input type="radio" name="component_shipping" value="evet"> Evet
                    <input type="radio" name="component_shipping" value="hayır"> Hayır
                    <input type="radio" name="component_shipping" value="hayır"> Hayır
                    <input type="radio" name="component_shipping" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="component_shipping_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Ürünün Kalite Uygunluk Belgesi, LOT numarası uygun mu?</label>
                <div>
                    <input type="radio" name="component_lot_certificate" value="evet"> Evet
                    <input type="radio" name="component_lot_certificate" value="hayır"> Hayır
                    <input type="radio" name="component_lot_certificate" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="component_lot_certificate_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Göz denetim sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="component_visual_inspection" value="evet"> Evet
                    <input type="radio" name="component_visual_inspection" value="hayır"> Hayır
                    <input type="radio" name="component_visual_inspection" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="component_visual_inspection_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Elektriksel/Fonksiyonel test sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="component_electrical_test" value="evet"> Evet
                    <input type="radio" name="component_electrical_test" value="hayır"> Hayır
                    <input type="radio" name="component_electrical_test" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="component_electrical_test_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Elektriksel ölçüm sonuçları uygun mu?</label>
                <div>
                    <input type="radio" name="component_measurement" value="evet"> Evet
                    <input type="radio" name="component_measurement" value="hayır"> Hayır
                    <input type="radio" name="component_measurement" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="component_measurement_file">
                </div>
            </div>
        </div>

        <!-- Kablaj Soruları -->
        <div id="cabling-questions" class="product-section d-none">
            <h5>Kablaj Soruları</h5>

            <div class="mb-3">
                <label>Kablo, konnektör ve kablajın mekanik ölçü ve denetimi sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="cabling_mechanical_test" value="evet"> Evet
                    <input type="radio" name="cabling_mechanical_test" value="hayır"> Hayır
                    <input type="radio" name="cabling_mechanical_test" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="cabling_mechanical_test_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Göz denetimi sonucu uygun mu?</label>
                <div>
                    <input type="radio" name="cabling_visual_inspection" value="evet"> Evet
                    <input type="radio" name="cabling_visual_inspection" value="hayır"> Hayır
                    <input type="radio" name="cabling_visual_inspection" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="cabling_visual_inspection_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Elektriksel test sonuçları uygun mu? Üretici test raporları mevcut mu?</label>
                <div>
                    <input type="radio" name="cabling_electrical_test" value="evet"> Evet
                    <input type="radio" name="cabling_electrical_test" value="hayır"> Hayır
                    <input type="radio" name="cabling_electrical_test" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="cabling_electrical_test_file">
                </div>
            </div>
        </div>

        <!-- Şüpheli/Sahte Parça Soruları -->
        <div id="suspected_fake-questions" class="product-section d-none">
            <h5>Şüpheli/Sahte Parça Soruları</h5>

            <div class="mb-3">
                <label>Ürünün tedarikçisi/distribütörü onaylı tedarikçi listesinde mi?</label>
                <div>
                    <input type="radio" name="suspected_supplier_list" value="evet"> Evet
                    <input type="radio" name="suspected_supplier_list" value="hayır"> Hayır
                    <input type="radio" name="suspected_supplier_list" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="suspected_supplier_list_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Ürünün orijinal üreticisine olan izlenebilirliğini gösteren kaynaklar mevcut mu?</label>
                <div>
                    <input type="radio" name="suspected_traceability" value="evet"> Evet
                    <input type="radio" name="suspected_traceability" value="hayır"> Hayır
                    <input type="radio" name="suspected_traceability" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="suspected_traceability_file">
                </div>
            </div>

            <div class="mb-3">
                <label>Ürün sevkiyat ve paketlemesi uygun mu?</label>
                <div>
                    <input type="radio" name="suspected_fake_packaging" value="evet"> Evet
                    <input type="radio" name="suspected_fake_packaging" value="hayır"> Hayır
                    <input type="radio" name="suspected_fake_packaging" value="gd"> G/D
                    <input type="file" class="form-control mt-2" name="suspected_fake_packaging_file">
                </div>
            </div>
        </div>

        <!-- Onay Bölümü -->
        <div class="row mt-5">
            <!-- Kontrol Eden (Inspected By) Alanı -->
            <div class="col-md-6">
                <label for="inspected_by" class="form-label">Kontrol Eden (Inspected By)</label>
                <input type="text" class="form-control" id="inspected_by" name="inspected_by"
                       value="{{ session('role') === 'tekniker' ? session('name') : '' }}" readonly>
            </div>
            
            <!-- Onaylayan (Approved By) Alanı -->
            <div class="col-md-6">
                <label for="approved_by" class="form-label">Onaylayan (Approved By)</label>
                <input type="text" class="form-control" id="approved_by" name="approved_by"
                       value="{{ session('role') === 'mühendis' ? session('name') : '' }}" readonly>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="button" class="btn btn-primary mt-4" id="submitBtn">Onayla</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
            const productCheckboxes = document.querySelectorAll('input[name="product_type[]"]');
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
            title: 'Bu form onayınızın ardından iligli mühendise yönlendirilecektir.',
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
    document.addEventListener('DOMContentLoaded', function () {
        const partStockNumber = document.getElementById('part_stock_number');
        const partDescription = document.getElementById('part_description');

        partStockNumber.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const description = selectedOption.getAttribute('data-description');

            // Parça Stok Tanımını dolduruyoruz
            partDescription.value = description || '';
        });


        // Mevcut tarihi al
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2); // Gün'ü iki haneli yap
        var month = ("0" + (today.getMonth() + 1)).slice(-2); // Ay'ı iki haneli yap (0 bazlı olduğu için +1)
        var year = today.getFullYear();

        // Tarihi yyyy-mm-dd formatına getir
        var currentDate = year + "-" + month + "-" + day;

        // document_date input'una güncel tarihi ata
        document.getElementById('document_date').value = currentDate;
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputField = document.getElementById('part_stock_number');
        const suggestionBox = document.getElementById('suggestions');
        const descriptionField = document.getElementById('part_description'); // Stok adı için alan

        inputField.addEventListener('input', function () {
            const query = inputField.value;

            if (query.length > 2) { // En az 3 karakterden sonra arama yap
                fetch(`/autocomplete-stocks?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionBox.innerHTML = ''; // Önce listeyi temizle

                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = `${item.stok_kodu} - ${item.stok_adi}`;
                            li.setAttribute('data-kodu', item.stok_kodu);
                            li.setAttribute('data-adi', item.stok_adi);

                            // Tıklanınca stok kodu ve stok adını doldur
                            li.addEventListener('click', function () {
                                inputField.value = this.getAttribute('data-kodu'); // Stok kodunu doldur
                                descriptionField.value = this.getAttribute('data-adi'); // Stok adını doldur
                                suggestionBox.innerHTML = ''; // Listeyi temizle
                            });

                            suggestionBox.appendChild(li);
                        });
                    });
            } else {
                suggestionBox.innerHTML = ''; // Eğer karakter azsa önerileri temizle
            }
        });

        // Input alanı dışında bir yere tıklanınca öneri listesini gizle
        document.addEventListener('click', function (event) {
            if (!inputField.contains(event.target) && !suggestionBox.contains(event.target)) {
                suggestionBox.innerHTML = '';
            }
        });
    });
</script>





@endsection