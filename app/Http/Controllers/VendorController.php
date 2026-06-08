<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
   
    public function index()
    {
        $menus = DB::table('menu')->where('idvendor', 1)->get();
        return view('vendor_menu', compact('menus'));
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric'
        ]);

        DB::table('menu')->insert([
            'idvendor' => 1, 
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'path_gambar' => null 
        ]);

        return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan!');
    }
}