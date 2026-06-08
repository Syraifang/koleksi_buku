@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-plus"></i>
            </span> Tambah Tag Harga
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Form Data Barang</h4>
                    
                    <form id="form-barang" action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama barang" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="harga">Harga (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Contoh: 15000" required>
                        </div>
                        
                       <button type="button" id="tombol-simpan" onclick="prosesSimpan()" class="btn btn-gradient-primary me-2">Simpan Data</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-light">Batal</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
        function prosesSimpan() {
            let form = document.getElementById("form-barang");
            let tombol = document.getElementById("tombol-simpan");
            
            if (!form.checkValidity()) {
                form.reportValidity();
            } else {
                tombol.disabled = true;
                
                tombol.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
                
                form.submit();
            }
        }
    </script>
</div>
@endsection