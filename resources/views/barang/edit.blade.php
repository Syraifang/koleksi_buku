@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-info text-white me-2">
                <i class="mdi mdi-pencil"></i>
            </span> Edit Tag Harga
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Form Edit Barang (ID: {{ $barang->id_barang }})</h4>
                    
                    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="harga">Harga (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" value="{{ $barang->harga }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-gradient-info me-2">Simpan Perubahan</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection