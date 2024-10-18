@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Tüm Formlar</h1>
        <hr class="my-4">

        @if ($allProcesses->isEmpty())
            <p class="text-center">Şu anda herhangi bir süreç yok.</p>
        @else
            <!-- DataTable Tablomuz -->
            <table id="processesTable" class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Belge Tarihi</th>
                        <th>Parça Stok Numarası</th>
                        <th>Kalite Raporu Numarası</th>
                        <th>Ürün Açıklaması</th>
                        <th>Parti Miktarı</th>
                        <th>Durum</th> <!-- Status sütunu -->
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allProcesses as $process)
                        <tr>
                            <td>{{ $process->document_date }}</td>
                            <td>{{ $process->part_stock_number }}</td>
                            <td>{{ $process->quality_report_number }}</td>
                            <td>{{ $process->part_description }}</td>
                            <td>{{ $process->batch_quantity }}</td>
                            <td>{{ ucfirst($process->status) }}</td> <!-- Status durumu -->
                            <td class="text-center">
                                <!-- Büyüteç İkonu ile readonly sayfasına yönlendirme -->
                                <a href="{{ route('form.showReadOnly', $process->id) }}" class="btn btn-info btn-sm mx-1">
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
            $('#processesTable').DataTable({
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
                    "targets": 6, // İşlemler sütunu sıralanmasın
                    "orderable": false
                }]
            });
        });
    </script>
@endsection
