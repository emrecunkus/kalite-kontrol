@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Gönderdiğiniz Formlar</h1>
        <hr class="my-4">


        @if ($forms->isEmpty())
            <div class="alert alert-info text-center">Şu anda onaya gönderilmiş süreç bulunmamaktadır.</div>
        @else
            <table id="submittedFormsTable" class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Belge Tarihi</th>
                        <th>Parça Stok Numarası</th>
                        <th>Kalite Raporu Numarası</th>
                        <th>Ürün Açıklaması</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $form)
                        <tr class="text-center">
                            <td>{{ \Carbon\Carbon::parse($form->document_date)->format('d.m.Y') }}</td>
                            <td>{{ $form->part_stock_number }}</td>
                            <td>{{ $form->quality_report_number }}</td>
                            <td>{{ $form->part_description }}</td>
                            <td>
                                @if ($form->status === 'pending')
                                    <span class="badge bg-warning text-dark">Beklemede</span>
                                @elseif ($form->status === 'approved')
                                    <span class="badge bg-success">Onaylandı</span>
                                @elseif ($form->status === 'rejected')
                                    <span class="badge bg-danger">Reddedildi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom Script for DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#submittedFormsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Turkish.json"
                },
                "pageLength": 10, // Her sayfada 5 kayıt göster
                "lengthMenu": [5, 10, 25, 50], // Sayfa başına kayıt sayısı seçenekleri
                "order": [[0, 'desc']], // Tarihe göre varsayılan sıralama (son belge tarihi önce)
                "responsive": true, // Tablo mobil uyumlu olsun
                "autoWidth": false, // Otomatik genişlik ayarlarını devre dışı bırak
                "searching": true, // Arama özelliğini etkinleştir
                "paging": true, // Sayfalama etkin
                "info": true // Tablo altındaki bilgi alanını etkinleştir
            });
        });
    </script>
@endsection
