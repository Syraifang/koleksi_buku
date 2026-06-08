<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|integer',
        ]);

        $barang = new Barang();
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan!');
    }

   // Menampilkan form edit
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|integer',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus!');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|array',
            'start_x' => 'required|integer|min:1|max:5',
            'start_y' => 'required|integer|min:1|max:8',
        ]);

        $barang_terpilih = Barang::whereIn('id_barang', $request->id_barang)->get();
        $start_x = $request->start_x;
        $start_y = $request->start_y;

        $empty_labels = (($start_y - 1) * 5) + ($start_x - 1);

        $data_cetak = [];
        for ($i = 0; $i < $empty_labels; $i++) {
            $data_cetak[] = null;
        }
        foreach ($barang_terpilih as $item) {
            $data_cetak[] = $item;
        }

        // Generate PDF
        $pdf = Pdf::loadView('pdf.cetak_label', compact('data_cetak'))->setPaper('a4', 'portrait');
        return $pdf->download('Label_Harga_TnJ_108.pdf');
    }
}
