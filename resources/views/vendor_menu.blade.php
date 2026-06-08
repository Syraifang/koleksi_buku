@extends('layouts.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-danger text-white me-2">
                <i class="mdi mdi-store"></i>
            </span> Manajemen Menu Vendor
        </h3>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire('Berhasil!', '{{ session("success") }}', 'success');
            });
        </script>
    @endif

    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-danger mb-4">Tambah Menu Baru</h4>
                    <form action="{{ route('vendor.menu.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Nama Menu</label>
                            <input type="text" name="nama_menu" class="form-control" placeholder="Contoh: Nasi Goreng Spesial" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 15000" required>
                        </div>
                        <button type="submit" class="btn btn-gradient-danger w-100">
                            <i class="mdi mdi-plus"></i> Simpan Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-dark mb-4">Daftar Menu Tersedia</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-dark text-white">
                                <tr>
                                    <th width="10%">ID</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->idmenu }}</td>
                                        <td>{{ $menu->nama_menu }}</td>
                                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Belum ada menu yang didaftarkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection