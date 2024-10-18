@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center animate-header">Reddedilen Formlar</h1>
        <hr> <!-- Alt çizgi eklendi -->

        @if ($rejectedForms->isEmpty())
            <p class="text-center">Şu anda reddedilen süreç bulunmamaktadır.</p>
        @else
            <!-- Reddedilen Formlar için tablo -->
            <table id="rejectedFormsTable" class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Belge Tarihi</th>
                        <th>Parça Stok Numarası</th>
                        <th>Kalite Raporu Numarası</th>
                        <th>Ürün Açıklaması</th>
                        <th>Parti Miktarı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rejectedForms as $form)
                        <tr>
                            <td>{{ $form->document_date }}</td>
                            <td>{{ $form->part_stock_number }}</td>
                            <td>{{ $form->quality_report_number }}</td>
                            <td>{{ $form->part_description }}</td>
                            <td>{{ $form->batch_quantity }}</td>
                            <td class="text-center">
                                <!-- Düzenle Butonu -->
                                <a href="{{ route('form.edit', $form->id) }}" class="btn btn-primary btn-sm mx-1 animate-btn">
                                    <i class="fas fa-pencil-alt"></i> Düzenle
                                </a>

                                <!-- Sil Butonu -->
                                <button class="btn btn-danger btn-sm mx-1 animate-btn delete-btn" data-id="{{ $form->id }}">
                                    <i class="fas fa-trash-alt"></i> Sil
                                </button>

                                <!-- Delete Form -->
                                <form id="delete-form-{{ $form->id }}" action="{{ route('form.delete', $form->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- DataTables & FontAwesome JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#rejectedFormsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Turkish.json"
                },
                "paging": true,
                "searching": true,
                "ordering": true,
                "pageLength": 5,
                "lengthChange": true,
                "columnDefs": [{
                    "targets": 5,
                    "orderable": false,
                    "searchable": false
                }]
            });

            // SweetAlert for delete confirmation
            $('.delete-btn').on('click', function () {
                var formId = $(this).data('id');
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu işlemi geri alamazsınız!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, sil!',
                    cancelButtonText: 'İptal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the corresponding form to delete the record
                        document.getElementById('delete-form-' + formId).submit();
                    }
                });
            });
        });
    </script>

    <!-- CSS Animasyonlar -->
    <style>
        .btn {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.1);
            background-color: #28a745 !important;
        }

        tr {
            transition: background-color 0.3s ease;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .container {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

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
    </style>
@endsection
