@extends('layout/template')

@section('content')
<div class="container mt-5 mb-4">
    <div class="card shadow-lg border-0">
        <div class="card-header text-center">
            <h3 class="mb-0"><i class="fa-solid fa-map-pin me-2"></i> Daftar Kasus Stunting (Points)</h3>
        </div>
        <div class="card-body px-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle" id="pointstable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Nama Orang Tua</th>
                            <th>Gambar</th>
                            <th>Dibuat</th>
                            <th>Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($points as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->birth_date }}</td>
                                <td>{{ $p->description }}</td>
                                <td>
                                    @if ($p->image)
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="{{ $p->image }}">
                                    @else
                                        <span class="table-empty">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d-m-Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center table-empty">Belum ada data titik yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">

<!-- Custom Stylish Tabel -->
<style>
    /* Header Card */
    .card-header {
        background: linear-gradient(45deg, #1D2671, #C33764);
        border-bottom: none;
        padding: 1.2rem 1.5rem;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .card-header h3 {
        color: #fff;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card {
        border-radius: 0.75rem;
        overflow: hidden;
        border: none;
    }

    /* Table Styling */
    #pointstable {
        border-radius: 8px;
        overflow: hidden;
    }

    #pointstable thead {
        background: linear-gradient(to right, #1D2671, #C33764);
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    #pointstable tbody tr {
        transition: 0.2s ease-in-out;
    }

    #pointstable tbody tr:hover {
        background-color: #f1f3f5;
        cursor: pointer;
    }

    #pointstable td,
    #pointstable th {
        vertical-align: middle;
        text-align: center;
        padding: 12px 8px;
    }

    #pointstable td {
        font-size: 0.95rem;
    }

    /* Gambar */
    #pointstable img {
        max-height: 70px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        transition: transform 0.2s ease-in-out;
    }

    #pointstable img:hover {
        transform: scale(1.05);
    }

    /* Pagination dan Filter */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.375rem;
        background: linear-gradient(to right, #1D2671, #C33764);
        color: #fff !important;
        margin: 0 2px;
        padding: 6px 12px;
        font-weight: 500;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #C33764;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 0.9rem;
    }

    .dataTables_info {
        font-size: 0.875rem;
        color: #6c757d;
        padding-top: 10px;
    }

    /* Empty Message */
    .table-empty {
        color: #6c757d;
        font-style: italic;
        font-size: 0.95rem;
    }
</style>
@endsection




@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
<script>
    let table1 = new DataTable('#pointstable', {
        responsive: true,
        autoWidth: false,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari data...",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "›",
                previous: "‹"
            },
            emptyTable: "Tidak ada data tersedia"
        }
    });
</script>
@endsection



