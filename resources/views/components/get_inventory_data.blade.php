<div class="modal fade" id="dynamicFormModal" tabindex="-1" aria-labelledby="dynamicFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dynamicFormModalLabel">Tedarik Kalite Kontrol Formu - Mevcut Veriler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Envanter ve Kalibrasyon Bilgileri -->
                <h6>Envanter ve Kalibrasyon Bilgileri</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Envanter No</th>
                            <th>Kalibrasyon No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($form->inventory_data ?? '[]', true) as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['inventory_no'] }}</td>
                                <td>{{ $item['calibration_no'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tolerans ve Ölçüm Bilgileri -->
                <h6>Tolerans ve Ölçüm Bilgileri</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tolerans</th>
                            <th>Ölçü</th>
                            <th>Ölçüm Sonucu</th>
                            <th>Karar</th>
                            <th>Açıklama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($form->measurement_data ?? '[]', true) as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['tolerance'] }}</td>
                                <td>{{ $item['measurement'] }}</td>
                                <td>{{ $item['result'] }}</td>
                                <td>{{ $item['decision'] }}</td>
                                <td>{{ $item['explanation'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
