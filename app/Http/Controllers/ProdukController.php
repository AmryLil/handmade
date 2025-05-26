<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
  /**
   * Display a listing of the products.
   */
  public function index()
  {
    $produk = Produk::with('kategori')->latest()->paginate(10);
    return view('pages.admin.produk.index', compact('produk'));
  }

  /**
   * Show the form for creating a new product.
   */
  public function create()
  {
    $kategori = KategoriProduk::all();
    return view('pages.admin.produk.create', compact('kategori'));
  }

  /**
   * Store a newly created product in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'id_222336'          => 'required|string|max:255',
      'nama_222336'        => 'required|string|max:255',
      'deskripsi_222336'   => 'required|string',
      'harga_222336'       => 'required|numeric|min:0',
      'kategori_id_222336' => 'required|exists:kategori_produk_222336,id_222336',
      'jumlah_222336'      => 'required|integer|min:0',
      'image'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
      $image                        = $request->file('image');
      $filename                     = 'produk_' . time() . '.' . $image->getClientOriginalExtension();
      $path                         = $image->storeAs('produk', $filename, 'public');
      $validated['path_img_222336'] = $path;
    }

    Produk::create($validated);

    return redirect()
      ->route('admin.produk.index')
      ->with('success', 'Produk berhasil ditambahkan!');
  }

  /**
   * Display the specified product.
   */
  public function show(Produk $produk)
  {
    return view('pages.admin.produk.show', compact('produk'));
  }

  /**
   * Show the form for editing the specified product.
   */
  public function edit(Produk $produk)
  {
    $kategori = KategoriProduk::all();
    return view('pages.admin.produk.edit', compact('produk', 'kategori'));
  }

  /**
   * Update the specified product in storage.
   */
  public function update(Request $request, Produk $produk)
  {
    $validated = $request->validate([
      'nama_222336'        => 'required|string|max:255',
      'deskripsi_222336'   => 'required|string',
      'harga_222336'       => 'required|numeric|min:0',
      'kategori_id_222336' => 'required|exists:kategori_produk_222336,id_222336',
      'jumlah_222336'      => 'required|integer|min:0',
      'image'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
      // Delete old image if exists
      if ($produk->path_img_222336 && Storage::disk('public')->exists($produk->path_img_222336)) {
        Storage::disk('public')->delete($produk->path_img_222336);
      }

      // Store new image
      $image                        = $request->file('image');
      $filename                     = 'produk_' . time() . '.' . $image->getClientOriginalExtension();
      $path                         = $image->storeAs('produk', $filename, 'public');
      $validated['path_img_222336'] = $path;
    }

    $produk->update($validated);

    return redirect()
      ->route('admin.produk.index')
      ->with('success', 'Produk berhasil diperbarui!');
  }

  /**
   * Remove the specified product from storage.
   */
  public function destroy(Produk $produk)
  {
    // Delete image if exists
    if ($produk->path_img_222336 && Storage::disk('public')->exists($produk->path_img_222336)) {
      Storage::disk('public')->delete($produk->path_img_222336);
    }

    $produk->delete();

    return redirect()
      ->route('admin.produk.index')
      ->with('success', 'Produk berhasil dihapus!');
  }
}
