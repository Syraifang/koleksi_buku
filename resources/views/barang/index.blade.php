@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Data Barang UMKM
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Tag Harga</h4>
                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('barang.cetak') }}" method="POST" target="_blank">
                        @csrf
                        
                        <div class="row mb-4 mt-3 align-items-end">
                            <div class="col-md-3">
                                <label>Mulai dari Kolom (X) - Maks 5</label>
                                <input type="number" name="start_x" class="form-control" min="1" max="5" value="1" required>
                            </div>
                            <div class="col-md-3">
                                <label>Mulai dari Baris (Y) - Maks 8</label>
                                <input type="number" name="start_y" class="form-control" min="1" max="8" value="1" required>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn btn-gradient-success me-2">
                                    <i class="mdi mdi-printer"></i> Cetak Label Terpilih
                                </button>
                                <a href="{{ route('barang.create') }}" class="btn btn-gradient-primary">
                                    <i class="mdi mdi-plus"></i> Tambah Barang Baru
                                </a>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tabel-barang">
                                <thead class="bg-gradient-primary text-white">
                                    <tr>
                                        <th width="5%">Pilih</th> <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Tanggal Input</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barang as $item)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="id_barang[]" value="{{ $item->id_barang }}">
                                        </td>
                                        <td>{{ $item->id_barang }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->timestamp }}</td>
                                        <td>
                                            <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-sm btn-info">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus barang ini?')) { document.getElementById('delete-form-{{ $item->id_barang }}').submit(); }">Hapus</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    @foreach($barang as $item)
                    <form id="delete-form-{{ $item->id_barang }}" action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style-page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<style>
    #tabel-barang th { text-align: center; font-weight: bold; }
    #tabel-barang td { vertical-align: middle; }
</style>
@endpush

@push('script-page')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabel-barang').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            },
            "columnDefs": [
                { "orderable": false, "targets": [0, 5] } 
            ]
        });
    });
</script>
@endpush