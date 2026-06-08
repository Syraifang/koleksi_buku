@extends('layouts.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-cart"></i>
            </span> Point of Sales (Mesin Kasir)
        </h3>
    </div>

    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info mb-4">Scan / Cari Barang</h4>
                    
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Kode Barang (Lalu tekan Enter)</label>
                        <input type="text" id="input-kode" class="form-control" placeholder="Contoh: B001" onkeypress="cariBarang(event)">
                        <small id="status-cari" class="text-danger mt-1 d-none">Barang tidak ditemukan!</small>
                    </div>

                    <div class="form-group mb-3">
                        <label>Nama Barang</label>
                        <input type="text" id="input-nama" class="form-control" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label>Harga (Rp)</label>
                        <input type="number" id="input-harga" class="form-control" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label>Jumlah</label>
                        <input type="number" id="input-jumlah" class="form-control" value="1" min="1" onchange="cekJumlah()">
                    </div>

                    <button type="button" id="btn-tambah" onclick="tambahKeKeranjang()" class="btn btn-gradient-info w-100" disabled>
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-success mb-4">Daftar Belanja</h4>
                    
                    <div class="table-responsive" style="min-height: 250px;">
                        <table class="table table-bordered table-striped" id="tabel-kasir">
                            <thead class="bg-gradient-dark text-white">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="isi-keranjang">
                                </tbody>
                        </table>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h2>Total: <span id="label-total" class="text-success font-weight-bold">Rp 0</span></h2>
                        <button type="button" id="btn-bayar" onclick="prosesBayar()" class="btn btn-lg btn-gradient-success" disabled>
                            <i class="mdi mdi-cash-multiple"></i> BAYAR SEKARANG
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const csrfToken = '{{ csrf_token() }}';

    function cariBarang(event) {
        if (event.key === "Enter" || event.keyCode === 13) {
            let kodeBarang = document.getElementById("input-kode").value.trim();
            let statusCari = document.getElementById("status-cari");

            if(kodeBarang === "") return;

            document.getElementById("input-nama").value = "Mencari...";
            document.getElementById("input-harga").value = "";
            document.getElementById("input-jumlah").value = 1;
            document.getElementById("btn-tambah").disabled = true;
            statusCari.classList.add("d-none");

            axios.post('{{ route("kasir.cari") }}', {
                _token: csrfToken,
                id_barang: kodeBarang
            })
            .then(function (response) {
                if (response.data.status === 'success') {
                    document.getElementById("input-nama").value = response.data.data.nama;
                    document.getElementById("input-harga").value = response.data.data.harga;
                    
                    cekJumlah(); 
                } else {
                    document.getElementById("input-nama").value = "";
                    statusCari.classList.remove("d-none");
                }
            })
            .catch(function (error) {
                console.error("Error AJAX:", error);
                document.getElementById("input-nama").value = "Terjadi Kesalahan Jaringan!";
            });
        }
    }

    function cekJumlah() {
        let jumlah = parseInt(document.getElementById("input-jumlah").value);
        let nama = document.getElementById("input-nama").value;
        let btnTambah = document.getElementById("btn-tambah");

        if (nama !== "" && nama !== "Mencari..." && nama !== "Terjadi Kesalahan Jaringan!" && jumlah > 0) {
            btnTambah.disabled = false;
        } else {
            btnTambah.disabled = true;
        }
    }

    function tambahKeKeranjang() {
        let kode = document.getElementById("input-kode").value;
        let nama = document.getElementById("input-nama").value;
        let harga = parseInt(document.getElementById("input-harga").value);
        let jumlah = parseInt(document.getElementById("input-jumlah").value);
        let subtotal = harga * jumlah;

        let tbody = document.getElementById("isi-keranjang");
        let barisYangSudahAda = document.getElementById("row-" + kode);

        if (barisYangSudahAda) {
            let inputJumlahLama = document.getElementById("qty-" + kode);
            let jumlahBaru = parseInt(inputJumlahLama.value) + jumlah;
            let subtotalBaru = harga * jumlahBaru;

            inputJumlahLama.value = jumlahBaru;
            document.getElementById("subtotal-" + kode).innerText = subtotalBaru;
            document.getElementById("subtotal-" + kode).setAttribute("data-val", subtotalBaru);
        } 
        else {
            let barisBaru = `
                <tr id="row-${kode}" class="item-keranjang">
                    <td class="cell-kode">${kode}</td>
                    <td>${nama}</td>
                    <td>${harga}</td>
                    <td>
                        <input type="number" id="qty-${kode}" class="form-control form-control-sm cell-jumlah" value="${jumlah}" min="1" onchange="updateSubtotal('${kode}', ${harga})">
                    </td>
                    <td id="subtotal-${kode}" class="cell-subtotal font-weight-bold" data-val="${subtotal}">${subtotal}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusBaris('${kode}')"><i class="mdi mdi-delete"></i></button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += barisBaru;
        }

        kalkulasiTotal();

        document.getElementById("input-kode").value = "";
        document.getElementById("input-nama").value = "";
        document.getElementById("input-harga").value = "";
        document.getElementById("input-jumlah").value = 1;
        document.getElementById("btn-tambah").disabled = true;
        document.getElementById("input-kode").focus();
    }

    function updateSubtotal(kode, harga) {
        let inputJumlah = document.getElementById("qty-" + kode);
        let jumlahBaru = parseInt(inputJumlah.value);

        if (jumlahBaru < 1) {
            jumlahBaru = 1;
            inputJumlah.value = 1;
        }

        let subtotalBaru = harga * jumlahBaru;
        document.getElementById("subtotal-" + kode).innerText = subtotalBaru;
        document.getElementById("subtotal-" + kode).setAttribute("data-val", subtotalBaru);

        kalkulasiTotal();
    }

    function hapusBaris(kode) {
        document.getElementById("row-" + kode).remove();
        kalkulasiTotal();
    }

    function kalkulasiTotal() {
        let daftarSubtotal = document.querySelectorAll(".cell-subtotal");
        let total = 0;

        daftarSubtotal.forEach(function(elemen) {
            total += parseInt(elemen.getAttribute("data-val"));
        });

        document.getElementById("label-total").innerText = "Rp " + total.toLocaleString('id-ID');
        
        let btnBayar = document.getElementById("btn-bayar");
        if (total > 0) {
            btnBayar.disabled = false;
        } else {
            btnBayar.disabled = true;
        }
    }

    function prosesBayar() {
        let btnBayar = document.getElementById("btn-bayar");
        
        btnBayar.disabled = true;
        btnBayar.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menyimpan Transaksi...';

        let items = [];
        let barisTabel = document.querySelectorAll(".item-keranjang");
        let totalKeseluruhan = 0;

        barisTabel.forEach(function(row) {
            let kode = row.querySelector(".cell-kode").innerText;
            let jumlah = parseInt(row.querySelector(".cell-jumlah").value);
            let subtotal = parseInt(row.querySelector(".cell-subtotal").getAttribute("data-val"));

            totalKeseluruhan += subtotal;

            items.push({
                id_barang: kode,
                jumlah: jumlah,
                subtotal: subtotal
            });
        });

        axios.post('{{ route("kasir.bayar") }}', {
            _token: csrfToken,
            items: items,
            total: totalKeseluruhan
        })
        .then(function (response) {
            if (response.data.status === 'success') {
                Swal.fire(
                    'Berhasil!',
                    response.data.message,
                    'success'
                );

                document.getElementById("isi-keranjang").innerHTML = "";
                kalkulasiTotal();
            } else {
                Swal.fire('Error!', response.data.message, 'error');
            }
        })
        .catch(function (error) {
            console.error(error);
            Swal.fire('Error!', 'Terjadi kesalahan sistem saat menyimpan data.', 'error');
        })
        .finally(function() {
            btnBayar.innerHTML = '<i class="mdi mdi-cash-multiple"></i> BAYAR SEKARANG';
            if (totalKeseluruhan === 0) btnBayar.disabled = true; // Tetap matikan jika keranjang sudah kosong
        });
    }
</script>
@endsection