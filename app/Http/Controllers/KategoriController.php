<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the kategori produk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriProduk::all();
        return view('pages.users.kategori', compact('kategori'));
    }

    /**
     * Display the specified kategori.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = KategoriProduk::findOrFail($id);
        return view('pages.users.produkbykategori', compact('kategori'));
    }
}
