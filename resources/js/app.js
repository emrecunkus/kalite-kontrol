document.addEventListener('DOMContentLoaded', function () {
    let inventoryRowIndex = 0;
    let toleranceRowIndex = 0;

    // Envanter Satırı Ekleme
    document.getElementById('addInventoryRow').addEventListener('click', function () {
        inventoryRowIndex++;
        const inventoryRows = document.getElementById('inventoryRows');
        const newRow = `
          <div class="row mb-3 inventory-row">
            <div class="col-md-5">
              <label for="inventoryNo_${inventoryRowIndex}" class="form-label">Envanter No</label>
              <select class="form-select inventory-no" id="inventoryNo_${inventoryRowIndex}" name="inventoryNo[]" required>
                <option value="" selected disabled>Envanter Seç</option>
                <option value="ENV001">ENV001</option>
                <option value="ENV002">ENV002</option>
                <option value="ENV003">ENV003</option>
              </select>
            </div>
            <div class="col-md-5">
              <label for="calibrationNo_${inventoryRowIndex}" class="form-label">Kalibrasyon No</label>
              <input type="text" class="form-control calibration-no" id="calibrationNo_${inventoryRowIndex}" name="calibrationNo[]" readonly>
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <button type="button" class="btn btn-danger remove-row">Sil</button>
            </div>
          </div>
        `;
        inventoryRows.insertAdjacentHTML('beforeend', newRow);
    });

    // Tolerans Satırı Ekleme
    document.getElementById('addToleranceRow').addEventListener('click', function () {
        toleranceRowIndex++;
        const toleranceRows = document.getElementById('toleranceRows');
        const newRow = `
          <div class="row mb-3 tolerance-row">
            <div class="col-md-3">
              <label for="tolerance_${toleranceRowIndex}" class="form-label">Tolerans</label>
              <input type="text" class="form-control" id="tolerance_${toleranceRowIndex}" name="tolerance[]" required>
            </div>
            <div class="col-md-3">
              <label for="measurement_${toleranceRowIndex}" class="form-label">Ölçü</label>
              <input type="text" class="form-control" id="measurement_${toleranceRowIndex}" name="measurement[]" required>
            </div>
            <div class="col-md-3">
              <label for="result_${toleranceRowIndex}" class="form-label">Ölçüm Sonucu</label>
              <input type="text" class="form-control" id="result_${toleranceRowIndex}" name="result[]" required>
            </div>
            <div class="col-md-3">
              <label for="decision_${toleranceRowIndex}" class="form-label">Karar</label>
              <input type="text" class="form-control" id="decision_${toleranceRowIndex}" name="decision[]">
            </div>
            <div class="col-md-12 mt-2">
              <label for="explanation_${toleranceRowIndex}" class="form-label">Açıklama</label>
              <textarea class="form-control" id="explanation_${toleranceRowIndex}" name="explanation[]"></textarea>
            </div>
            <div class="col-md-12 d-flex justify-content-end mt-2">
              <button type="button" class="btn btn-danger remove-row">Sil</button>
            </div>
          </div>
        `;
        toleranceRows.insertAdjacentHTML('beforeend', newRow);
    });

    // Satır Silme
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('.row').remove();
        }
    });

    // Envanter No Seçimine Göre Kalibrasyon No Doldurma
    document.addEventListener('change', function (e) {
        if (e.target && e.target.classList.contains('inventory-no')) {
            const calibrationNoField = e.target.closest('.inventory-row').querySelector('.calibration-no');
            const selectedValue = e.target.value;

            // Kalibrasyon No eşleştirme (örnek veriler)
            const calibrationData = {
                'ENV001': 'CAL001',
                'ENV002': 'CAL002',
                'ENV003': 'CAL003',
            };

            calibrationNoField.value = calibrationData[selectedValue] || '';
        }
    });
});
