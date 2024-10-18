@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Tamamlanmış Raporlar</h1>
        <hr class="my-4"> <!-- Başlığın altına çizgi ekler -->

        @if ($finishedProcesses->isEmpty())
            <p class="text-center">Şu anda finished olan süreç bulunmamaktadır.</p>
        @else
            <!-- DataTable Tablomuz -->
            <table id="finishedProcessesTable" class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Form id</th> <!-- surec_id -->
                        <th>Belge Tarihi</th>
                        <th>Parça Stok Numarası</th>
                        <th>Kalite Raporu Numarası</th>
                        <th>Ürün Açıklaması</th>
                        <th>Parti Miktarı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finishedProcesses as $form)
                        <tr>
                            <td>{{ $form->surec_id }}</td> <!-- surec_id gösteriliyor -->
                            <td>{{ $form->document_date }}</td>
                            <td>{{ $form->part_stock_number }}</td>
                            <td>{{ $form->quality_report_number }}</td>
                            <td>{{ $form->part_description }}</td>
                            <td>{{ $form->batch_quantity }}</td>
                            <td class="text-center">
                                <!-- Büyüteç İkonu ile ReadOnly Olarak Yeni Sayfaya Yönlendirme -->
                                <a href="{{ route('form.showReadOnly', $form->id) }}" class="btn btn-info btn-sm mx-1">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Bootstrap ve DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <!-- JQuery, Bootstrap ve DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#finishedProcessesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Turkish.json"
                },
                "paging": true,         // Sayfalama
                "searching": true,      // Arama
                "ordering": true,       // Sıralama
                "pageLength": 10,        // Her sayfada gösterilecek kayıt sayısı
                "lengthChange": true,   // Kayıt sayısını değiştirme seçeneği
                "info": true,           // Tablo bilgisi gösterimi
                "autoWidth": false,     // Otomatik genişlik kapalı
                "responsive": true,     // Mobil uyumlu
                "columnDefs": [{
                    "targets": 5, // İşlemler sütunu sıralanmasın
                    "orderable": false
                }]
            });
        });
    </script>
@endsection
