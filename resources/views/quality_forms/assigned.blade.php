@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center animate-header">Onay Bekleyen Formlar</h1>
        <hr class="my-4"> <!-- Başlığın altına çizgi ekler -->

        @if ($forms->isEmpty())
            <p class="text-center">Şu anda onay bekleyen form yok.</p>
        @else
            <!-- DataTable Tablomuz -->
            <table id="formsTable" class="table table-striped table-hover table-bordered animate-table">
                <thead class="table-dark">
                    <tr>
                        <th>FORM ID</th>
                        <th>Belge Tarihi</th>
                        <th>Parça Stok Numarası</th>
                        <th>Kalite Raporu Numarası</th>
                        <th>Ürün Açıklaması</th>
                        <th>Parti Miktarı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $form)
                        <tr>
                            <td>{{ $form->surec_id }}</td>
                            <td>{{ $form->document_date }}</td>
                            <td>{{ $form->part_stock_number }}</td>
                            <td>{{ $form->quality_report_number }}</td>
                            <td>{{ $form->part_description }}</td>
                            <td>{{ $form->batch_quantity }}</td>
                            <td class="text-center">
                                <!-- Büyüteç İkonu ile Yeni Sayfaya Yönlendirme -->
                                <a href="{{ route('form.showReadOnly', $form->id) }}" class="btn btn-info btn-sm mx-1 animate-btn">
                                    <i class="fas fa-search"></i>
                                </a>

                                <!-- Düzenle İkonu ile Düzenleme Sayfasına Yönlendirme -->
                                <a href="{{ route('form.edit', $form->id) }}" class="btn btn-warning btn-sm mx-1 animate-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                @if ($form->status === 'pending' || $form->status === 'sent to engineer again')
                                    <!-- Onay Butonu -->
                                    {{--  <form action="{{ route('form.approve', $form->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mx-1 animate-btn">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>  --}}

                                    <!-- Reddet Butonu -->
                                    <form action="{{ route('form.reject', $form->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm mx-1 animate-btn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($form->status) }}</span>
                                @endif
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
            $('#formsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Turkish.json"
                },
                "paging": true,
                "searching": true,
                "ordering": true,
                "pageLength": 10,
                "lengthChange": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                    "targets": 5,
                    "orderable": false
                }]
            });
        });
    </script>

    <!-- CSS Animasyonlar -->
    <style>
        /* Başlık Animasyonu */
        h1.animate-header {
            opacity: 0;
            animation: slideDown 1s forwards;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tablo Animasyonu */
        .animate-table {
            opacity: 0;
            animation: fadeInTable 1s forwards;
        }

        @keyframes fadeInTable {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Buton Animasyonu */
        .animate-btn {
            transition: transform 0.2s, background-color 0.2s;
        }

        .animate-btn:hover {
            transform: scale(1.1);
            background-color: #17a2b8; /* Varsayılan olarak info buton rengi */
        }

        .btn-warning.animate-btn:hover {
            background-color: #ffc107;
        }

        .btn-success.animate-btn:hover {
            background-color: #28a745;
        }

        .btn-danger.animate-btn:hover {
            background-color: #dc3545;
        }

        /* Tablo Satır Animasyonu */
        tr {
            transition: background-color 0.3s ease;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Responsive ve estetik görünüm için */
        table {
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        table thead th {
            border: none;
            font-weight: bold;
            text-transform: uppercase;
        }

        table tbody td {
            border: none;
            padding: 10px 15px;
        }
    </style>
@endsection
