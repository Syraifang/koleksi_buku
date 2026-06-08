@extends('layouts.master') {{-- Ini perintah untuk meminjam kerangka master --}}

@section('content') {{-- Ini perintah untuk memasukkan konten ke bagian @yield('content') di master --}}
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Daftar Kategori
    </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kategori Buku</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th> # </th>
                            <th> Nama Kategori </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">Data kategori kosong.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection