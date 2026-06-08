@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <h2>Selamat Datang</h2>
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Fitur Cetak PDF</h4>
                    <p class="card-description"> Silakan pilih format dokumen yang ingin diunduh: </p>
                    
                    <div class="mt-4">
                        <a href="{{ route('pdf.sertifikat') }}" class="btn btn-block btn-gradient-info btn-icon-text mb-3 w-100 text-start">
                            <i class="mdi mdi-printer btn-icon-prepend"></i> Cetak Sertifikat A4 (Landscape)
                        </a>
                        <br>
                        <a href="{{ route('pdf.undangan') }}" class="btn btn-block btn-gradient-success btn-icon-text w-100 text-start">
                            <i class="mdi mdi-file-pdf btn-icon-prepend"></i> Cetak Undangan Resmi (Portrait)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style-page')
    @endpush

@push('script-page')
    @endpush