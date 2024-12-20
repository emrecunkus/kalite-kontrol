<div class="modal fade" id="dynamicFormModal" tabindex="-1" aria-labelledby="dynamicFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dynamicFormModalLabel">Tedarik Kalite Kontrol Formu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Envanter ve Kalibrasyon Bilgileri -->
                <h6>Envanter ve Kalibrasyon Bilgileri</h6>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="inventoryNo" class="form-label">Envanter No</label>
                        <select class="form-select inventory-no" id="inventoryNo" name="inventory_no">
                            <option value="" selected disabled>Envanter Seç</option>
                            <option value="ENV001">ENV001</option>
                            <option value="ENV002">ENV002</option>
                            <option value="ENV003">ENV003</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="calibrationNo" class="form-label">Kalibrasyon No</label>
                        <input type="text" class="form-control" id="calibrationNo" name="calibration_no" readonly>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-primary" id="addInventoryRow">
                            <i class="fas fa-plus-circle"></i> Ekle
                        </button>
                    </div>
                </div>

                <!-- Kaydedilen Envanter ve Kalibrasyon Satırları -->
                <h6>Eklenen Satırlar</h6>
                <table class="table table-bordered" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Envanter No</th>
                            <th>Kalibrasyon No</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dinamik satırlar burada görünecek -->
                    </tbody>
                </table>

                <!-- Tolerans ve Ölçüm Bilgileri -->
                <h6>Tolerans ve Ölçüm Bilgileri</h6>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="tolerance" class="form-label">Tolerans</label>
                        <input type="text" class="form-control" id="tolerance" name="tolerance">
                    </div>
                    <div class="col-md-2">
                        <label for="measurement" class="form-label">Ölçü</label>
                        <input type="text" class="form-control" id="measurement" name="measurement">
                    </div>
                    <div class="col-md-2">
                        <label for="result" class="form-label">Ölçüm Sonucu</label>
                        <input type="text" class="form-control" id="result" name="result">
                    </div>
                    <div class="col-md-2">
                        <label for="decision" class="form-label">Karar</label>
                        <input type="text" class="form-control" id="decision" name="decision">
                    </div>
                    <div class="col-md-4">
                        <label for="explanation" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="explanation" name="explanation"></textarea>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-primary" id="addMeasurementRow">
                            <i class="fas fa-plus-circle"></i> Ekle
                        </button>
                    </div>
                </div>

                <!-- Kaydedilen Ölçüm Bilgileri Tablosu -->
                <h6>Eklenen Ölçüm Bilgileri</h6>
                <table class="table table-bordered" id="measurementTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tolerans</th>
                            <th>Ölçü</th>
                            <th>Ölçüm Sonucu</th>
                            <th>Karar</th>
                            <th>Açıklama</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dinamik ölçüm satırları burada görünecek -->
                    </tbody>
                </table>

                <!-- Kaydet ve Temizle Butonları -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="saveModalData">
                        <i class="fas fa-save"></i> Kaydet
                    </button>
                    <button type="button" class="btn btn-warning" id="clearModalData">
                        <i class="fas fa-trash-alt"></i> Temizle
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let inventoryIndex = 1;
    let measurementIndex = 1;

    // Inventory ekleme işlemi
    document.getElementById('addInventoryRow').addEventListener('click', function () {
        const inventoryNo = document.getElementById('inventoryNo').value;
        const calibrationNo = document.getElementById('calibrationNo').value;

        if (!inventoryNo || !calibrationNo) {
            Swal.fire('Hata!', 'Lütfen gerekli alanları doldurun!', 'error');
            return;
        }

        const tableBody = document.querySelector('#inventoryTable tbody');
        const row = `
            <tr>
                <td>${inventoryIndex}</td>
                <td><input type="hidden" name="inventory_data[${inventoryIndex}][inventory_no]" value="${inventoryNo}">${inventoryNo}</td>
                <td><input type="hidden" name="inventory_data[${inventoryIndex}][calibration_no]" value="${calibrationNo}">${calibrationNo}</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row);
        inventoryIndex++;

        Swal.fire('Başarılı!', 'Envanter bilgisi başarıyla eklendi.', 'success');
    });

    // Measurement ekleme işlemi
    document.getElementById('addMeasurementRow').addEventListener('click', function () {
        const tolerance = document.getElementById('tolerance').value;
        const measurement = document.getElementById('measurement').value;
        const result = document.getElementById('result').value;
        const decision = document.getElementById('decision').value;
        const explanation = document.getElementById('explanation').value;

        if (!tolerance || !measurement || !result) {
            Swal.fire('Hata!', 'Lütfen gerekli alanları doldurun!', 'error');
            return;
        }

        const tableBody = document.querySelector('#measurementTable tbody');
        const row = `
            <tr>
                <td>${measurementIndex}</td>
                <td><input type="hidden" name="measurement_data[${measurementIndex}][tolerance]" value="${tolerance}">${tolerance}</td>
                <td><input type="hidden" name="measurement_data[${measurementIndex}][measurement]" value="${measurement}">${measurement}</td>
                <td><input type="hidden" name="measurement_data[${measurementIndex}][result]" value="${result}">${result}</td>
                <td><input type="hidden" name="measurement_data[${measurementIndex}][decision]" value="${decision}">${decision}</td>
                <td><input type="hidden" name="measurement_data[${measurementIndex}][explanation]" value="${explanation}">${explanation}</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row);
        measurementIndex++;

        Swal.fire('Başarılı!', 'Ölçüm bilgisi başarıyla eklendi.', 'success');
    });

    // Satır silme işlemi
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    // Envanter No seçimi değiştiğinde Kalibrasyon No'yu doldurma
    document.getElementById('inventoryNo').addEventListener('change', function () {
        const calibrationData = {
            'ENV001': 'CAL001',
            'ENV002': 'CAL002',
            'ENV003': 'CAL003'
        };
        document.getElementById('calibrationNo').value = calibrationData[this.value] || '';
    });

    // Temizle butonu işlemi
    document.getElementById('clearModalData').addEventListener('click', function () {
        Swal.fire({
            title: 'Tüm veriler temizlenecek!',
            text: 'Bu işlem geri alınamaz. Devam etmek istiyor musunuz?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, temizle',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#inventoryTable tbody').innerHTML = '';
                document.querySelector('#measurementTable tbody').innerHTML = '';
                inventoryIndex = 1;
                measurementIndex = 1;
                Swal.fire('Temizlendi!', 'Tüm veriler silindi.', 'success');
            }
        });
    });

    // Kaydet butonu işlemi
    document.getElementById('saveModalData').addEventListener('click', function () {
        Swal.fire({
            title: 'Veriler Kaydediliyor',
            text: 'Tablodaki tüm veriler kaydedilecek ve ana forma dönecektir.',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Tamam'
        }).then(() => {
            $('#dynamicFormModal').modal('hide');
        });
    });
});
</script>
