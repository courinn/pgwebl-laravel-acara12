@extends('layout/template')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
        <h3 class="text-center">Daftar Titik (Points)</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="pointstable">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                        <th>Dibuat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Cek jika ada data --}}
                    @forelse ($points as $index => $p)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td class="text-center">
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt="{{ $p->image }}" width="150">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ $p->user_created ?? 'Tidak diketahui' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data titik yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    <div class="card mt-4">
        <div class="card-header">
        <h3 class="text-center">Daftar Garis (Polylines)</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="polylinestable">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                        <th>Dibuat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Cek jika ada data --}}
                    @forelse ($polylines as $index => $p)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td class="text-center">
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt="{{ $p->image }}" width="150">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ $p->user_created ?? 'Tidak diketahui' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data garis yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>




    <div class="card mt-4">
        <div class="card-header">
        <h3 class="text-center">Daftar Area (Polygons)</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="polygonstable">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                        <th>Dibuat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Cek jika ada data --}}
                    @forelse ($polygons as $index => $p)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td class="text-center">
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt="{{ $p->image }}" width="150">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ $p->user_created ?? 'Tidak diketahui' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data poligon yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
<script>
    let table1 = new DataTable('#pointstable');
    let table2 = new DataTable('#polylinestable');
    let table3 = new DataTable('#polygonstable');

</script>
@endsection


