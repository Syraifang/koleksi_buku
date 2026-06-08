@extends('layouts.master')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Daftar Koleksi Buku </h3>
    <a href="{{ route('buku.create') }}" class="btn btn-gradient-primary btn-icon-text">
        <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Buku 
    </a>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Judul </th>
                            <th> Penulis </th>
                            <th> Kategori </th>
                            <th> Tahun </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $b)
                        <tr>
                            <td>{{ $b->judul }}</td>
                            <td>{{ $b->penulis }}</td>
                            <td>{{ $b->kategori->nama_kategori }}</td>
                            <td>{{ $b->tahun_terbit }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada koleksi buku. Silakan tambah data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection