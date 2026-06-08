@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-info text-white me-2">
                <i class="mdi mdi-map-marker-multiple"></i>
            </span> Data Wilayah Indonesia
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Pilih Wilayah Tempat Tinggal</h4>
                    
                    <form>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Provinsi</label>
                            <select id="provinsi" class="form-select form-control" onchange="loadKota()">
                                <option value="0">-- Sedang Memuat Data... --</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Kota / Kabupaten</label>
                            <select id="kota" class="form-select form-control" onchange="loadKecamatan()" disabled>
                                <option value="0">-- Pilih Provinsi Terlebih Dahulu --</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Kecamatan</label>
                            <select id="kecamatan" class="form-select form-control" onchange="loadKelurahan()" disabled>
                                <option value="0">-- Pilih Kota Terlebih Dahulu --</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Kelurahan / Desa</label>
                            <select id="kelurahan" class="form-select form-control" disabled>
                                <option value="0">-- Pilih Kecamatan Terlebih Dahulu --</option>
                            </select>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const baseURL = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    document.addEventListener("DOMContentLoaded", function() {
        loadProvinsi();
    });

    function loadProvinsi() {
        let selectProvinsi = document.getElementById("provinsi");
        selectProvinsi.innerHTML = '<option value="0">-- Sedang Memuat Data... --</option>';

        axios.get(`${baseURL}/provinces.json`)
            .then(function (response) {
                let data = response.data;
                selectProvinsi.innerHTML = '<option value="0">-- Pilih Provinsi --</option>';
                
                data.forEach(function(item) {
                    selectProvinsi.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
            })
            .catch(function (error) {
                console.error("Gagal memuat provinsi:", error);
                selectProvinsi.innerHTML = '<option value="0">-- Gagal Memuat Data --</option>';
            });
    }

    function loadKota() {
        let idProvinsi = document.getElementById("provinsi").value;
        let selectKota = document.getElementById("kota");
        let selectKecamatan = document.getElementById("kecamatan");
        let selectKelurahan = document.getElementById("kelurahan");

        selectKecamatan.innerHTML = '<option value="0">-- Pilih Kota Terlebih Dahulu --</option>';
        selectKecamatan.disabled = true;
        selectKelurahan.innerHTML = '<option value="0">-- Pilih Kecamatan Terlebih Dahulu --</option>';
        selectKelurahan.disabled = true;

        if (idProvinsi === "0") {
            selectKota.innerHTML = '<option value="0">-- Pilih Provinsi Terlebih Dahulu --</option>';
            selectKota.disabled = true;
            return;
        }

        selectKota.disabled = false;
        selectKota.innerHTML = '<option value="0">-- Sedang Memuat Data... --</option>';

        axios.get(`${baseURL}/regencies/${idProvinsi}.json`)
            .then(function (response) {
                let data = response.data;
                selectKota.innerHTML = '<option value="0">-- Pilih Kota / Kabupaten --</option>';
                data.forEach(function(item) {
                    selectKota.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
            });
    }

    function loadKecamatan() {
        let idKota = document.getElementById("kota").value;
        let selectKecamatan = document.getElementById("kecamatan");
        let selectKelurahan = document.getElementById("kelurahan");

        selectKelurahan.innerHTML = '<option value="0">-- Pilih Kecamatan Terlebih Dahulu --</option>';
        selectKelurahan.disabled = true;

        if (idKota === "0") {
            selectKecamatan.innerHTML = '<option value="0">-- Pilih Kota Terlebih Dahulu --</option>';
            selectKecamatan.disabled = true;
            return;
        }

        selectKecamatan.disabled = false;
        selectKecamatan.innerHTML = '<option value="0">-- Sedang Memuat Data... --</option>';

        axios.get(`${baseURL}/districts/${idKota}.json`)
            .then(function (response) {
                let data = response.data;
                selectKecamatan.innerHTML = '<option value="0">-- Pilih Kecamatan --</option>';
                data.forEach(function(item) {
                    selectKecamatan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
            });
    }

    function loadKelurahan() {
        let idKecamatan = document.getElementById("kecamatan").value;
        let selectKelurahan = document.getElementById("kelurahan");

        if (idKecamatan === "0") {
            selectKelurahan.innerHTML = '<option value="0">-- Pilih Kecamatan Terlebih Dahulu --</option>';
            selectKelurahan.disabled = true;
            return;
        }

        selectKelurahan.disabled = false;
        selectKelurahan.innerHTML = '<option value="0">-- Sedang Memuat Data... --</option>';

        axios.get(`${baseURL}/villages/${idKecamatan}.json`)
            .then(function (response) {
                let data = response.data;
                selectKelurahan.innerHTML = '<option value="0">-- Pilih Kelurahan / Desa --</option>';
                data.forEach(function(item) {
                    selectKelurahan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
            });
    }
</script>
@endsection