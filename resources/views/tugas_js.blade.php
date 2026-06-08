@extends('layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    #tabel-js tbody tr { cursor: pointer; }
</style>

<div class="content-wrapper">
    
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-table"></i>
            </span> Tabel CRUD
        </h3>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Tambah</h4>
                    <form id="form-js">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" id="input-nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Barang</label>
                            <input type="number" id="input-harga" class="form-control" required>
                        </div>
                        <button type="button" id="btn-submit-js" onclick="tambahKeTabel()" class="btn btn-gradient-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tabel Data Sementara (Klik baris untuk Edit/Hapus)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tabel-js">
                            <thead class="bg-gradient-info text-white">
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody id="isi-tabel"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-success text-white me-2">
                <i class="mdi mdi-format-list-bulleted-type"></i>
            </span> Tugas DOM Select & Select2
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary">Select (Biasa)</h4>
                    <div class="form-group">
                        <label>Kota:</label>
                        <div class="input-group">
                            <input type="text" id="input-kota-1" class="form-control" placeholder="Ketik nama kota...">
                            <button type="button" class="btn btn-gradient-primary" onclick="tambahKotaBiasa()">Tambahkan</button>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label>Select Kota:</label>
                        <select id="select-kota-1" class="form-select form-control" onchange="updateKotaTerpilihBiasa()">
                            <option value="" disabled selected>-- Pilih Kota --</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <h5 class="text-muted">Kota Terpilih: <span id="teks-terpilih-1" class="text-dark font-weight-bold">-</span></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-success">Select 2 (Plugin)</h4>
                    <div class="form-group">
                        <label>Kota:</label>
                        <div class="input-group">
                            <input type="text" id="input-kota-2" class="form-control" placeholder="Ketik nama kota...">
                            <button type="button" class="btn btn-gradient-success" onclick="tambahKotaSelect2()">Tambahkan</button>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label>Select Kota:</label>
                        <select id="select-kota-2" class="form-control" style="width: 100%;">
                            <option value="" disabled selected>-- Pilih Kota --</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <h5 class="text-muted">Kota Terpilih: <span id="teks-terpilih-2" class="text-dark font-weight-bold">-</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail / Manipulasi Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-js">
                    <div class="form-group mb-3">
                        <label>ID Barang</label>
                        <input type="text" id="edit-id" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Barang</label>
                        <input type="text" id="edit-nama" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga Barang</label>
                        <input type="number" id="edit-harga" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="hapusRow()" class="btn btn-danger">Hapus</button>
                <button type="button" id="btn-ubah-js" onclick="ubahRow()" class="btn btn-success">Ubah</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#select-kota-2').select2({
            placeholder: "-- Pilih Kota --",
            allowClear: true
        });

        $('#select-kota-2').on('change', function() {
            let kotaTerpilih = $(this).val();
            document.getElementById('teks-terpilih-2').innerText = kotaTerpilih ? kotaTerpilih : "-";
        });
    });

    function tambahKotaBiasa() {
        let inputKota = document.getElementById("input-kota-1");
        let selectKota = document.getElementById("select-kota-1");
        let namaKota = inputKota.value.trim();

        if (namaKota !== "") {
            let opsiBaru = document.createElement("option");
            opsiBaru.value = namaKota;
            opsiBaru.text = namaKota;
            selectKota.appendChild(opsiBaru);
            inputKota.value = "";
        }
    }
    function updateKotaTerpilihBiasa() {
        document.getElementById("teks-terpilih-1").innerText = document.getElementById("select-kota-1").value;
    }

    function tambahKotaSelect2() {
        let inputKota = document.getElementById("input-kota-2");
        let namaKota = inputKota.value.trim();

        if (namaKota !== "") {
            let opsiBaru = new Option(namaKota, namaKota, true, true);
            $('#select-kota-2').append(opsiBaru).trigger('change');
            inputKota.value = "";
        }
    }

    let nomorId = 1001;
    let barisAktif = null;

    function tambahKeTabel() {
        let form = document.getElementById("form-js");
        let tombol = document.getElementById("btn-submit-js");
        let nama = document.getElementById("input-nama");
        let harga = document.getElementById("input-harga");
        let tbody = document.getElementById("isi-tabel");

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        tombol.disabled = true;
        tombol.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';

        setTimeout(function() {
            let barisBaru = document.createElement("tr");
            barisBaru.setAttribute("onclick", "bukaModalEdit(this)");
            barisBaru.innerHTML = `
                <td class="cell-id">ID-${nomorId}</td>
                <td class="cell-nama">${nama.value}</td>
                <td class="cell-harga" data-raw="${harga.value}">Rp ${parseInt(harga.value).toLocaleString('id-ID')}</td>
            `;
            tbody.appendChild(barisBaru);
            nomorId++;
            nama.value = ""; harga.value = "";
            tombol.disabled = false; tombol.innerHTML = "Submit";
        }, 1000);
    }

    function bukaModalEdit(rowElement) {
        barisAktif = rowElement;
        document.getElementById("edit-id").value = rowElement.querySelector(".cell-id").innerText;
        document.getElementById("edit-nama").value = rowElement.querySelector(".cell-nama").innerText;
        document.getElementById("edit-harga").value = rowElement.querySelector(".cell-harga").getAttribute("data-raw");
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }

    function ubahRow() {
        let formEdit = document.getElementById("form-edit-js");
        let tombolUbah = document.getElementById("btn-ubah-js");
        if (!formEdit.checkValidity()) { formEdit.reportValidity(); return; }

        tombolUbah.disabled = true;
        tombolUbah.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Mengubah...';

        setTimeout(function() {
            let namaBaru = document.getElementById("edit-nama").value;
            let hargaBaru = document.getElementById("edit-harga").value;
            barisAktif.querySelector(".cell-nama").innerText = namaBaru;
            barisAktif.querySelector(".cell-harga").innerText = "Rp " + parseInt(hargaBaru).toLocaleString('id-ID');
            barisAktif.querySelector(".cell-harga").setAttribute("data-raw", hargaBaru);
            
            bootstrap.Modal.getInstance(document.getElementById('modalEdit')).hide();
            tombolUbah.disabled = false; tombolUbah.innerHTML = "Ubah";
        }, 800);
    }

    function hapusRow() {
        if (confirm("Yakin hapus?")) {
            barisAktif.remove();
            bootstrap.Modal.getInstance(document.getElementById('modalEdit')).hide();
        }
    }
</script>
@endsection