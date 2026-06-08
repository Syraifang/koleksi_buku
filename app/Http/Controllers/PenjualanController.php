<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('kasir');
    }

    public function cariBarang(Request $request)
    {
        $barang = DB::table('barang')->where('id_barang', $request->id_barang)->first();
        
        if ($barang) {
            return response()->json([
                'status' => 'success',
                'data' => $barang
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak ditemukan!'
            ]);
        }
    }

    public function simpanTransaksi(Request $request)
    {
        $items = $request->items;
        $total = $request->total;

        if (!$items || count($items) == 0) {
            return response()->json(['status' => 'error', 'message' => 'Keranjang masih kosong!']);
        }

        DB::beginTransaction();
        try {
            $penjualanId = DB::table('penjualan')->insertGetId([
                'total' => $total
            ]);

            foreach ($items as $item) {
                DB::table('penjualan_detail')->insert([
                    'id_penjualan' => $penjualanId,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal']
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success', 
                'message' => 'Transaksi berhasil disimpan ke Database!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error', 
                'message' => 'Gagal menyimpan: ' . $e->getMessage()
            ]);
        }
    }
}