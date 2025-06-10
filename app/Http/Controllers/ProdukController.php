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
      'id_222336'          => 'required|string|max:255|unique:produk_222336,id_222336',
      'nama_222336'        => 'required|string|max:255',
      'deskripsi_222336'   => 'required|string',
      'harga_222336'       => 'required|numeric|min:0',
      'kategori_id_222336' => 'required|exists:kategori_produk_222336,id_222336',
      'jumlah_222336'      => 'required|integer|min:0',
      'image'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
      'id_222336.required'          => 'ID produk wajib diisi.',
      'id_222336.string'            => 'ID produk harus berupa teks.',
      'id_222336.max'               => 'ID produk maksimal 255 karakter.',
      'id_222336.unique'            => 'ID produk sudah digunakan.',
      'nama_222336.required'        => 'Nama produk wajib diisi.',
      'nama_222336.string'          => 'Nama produk harus berupa teks.',
      'nama_222336.max'             => 'Nama produk maksimal 255 karakter.',
      'deskripsi_222336.required'   => 'Deskripsi produk wajib diisi.',
      'deskripsi_222336.string'     => 'Deskripsi produk harus berupa teks.',
      'harga_222336.required'       => 'Harga produk wajib diisi.',
      'harga_222336.numeric'        => 'Harga produk harus berupa angka.',
      'harga_222336.min'            => 'Harga produk minimal 0.',
      'kategori_id_222336.required' => 'Kategori produk wajib dipilih.',
      'kategori_id_222336.exists'   => 'Kategori tidak ditemukan.',
      'jumlah_222336.required'      => 'Jumlah produk wajib diisi.',
      'jumlah_222336.integer'       => 'Jumlah produk harus berupa bilangan bulat.',
      'jumlah_222336.min'           => 'Jumlah produk minimal 0.',
      'image.required'              => 'Gambar produk wajib diunggah.',
      'image.image'                 => 'File harus berupa gambar.',
      'image.mimes'                 => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
      'image.max'                   => 'Ukuran gambar maksimal 2MB.',
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
