<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KategoriAdminController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $kategori = KategoriProduk::all();
    return view('pages.admin.kategori.index', compact('kategori'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('pages.admin.kategori.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nama_222336'      => 'required|string|max:255',
      'deskripsi_222336' => 'required|string',
      'path_img_222336'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'tags_222336'      => 'nullable|string',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $data = $request->all();

    // Handle image upload
    if ($request->hasFile('path_img_222336')) {
      $file                    = $request->file('path_img_222336');
      $fileName                = time() . '_' . $file->getClientOriginalName();
      $filePath                = $file->storeAs('kategori_produk', $fileName, 'public');
      $data['path_img_222336'] = $filePath;
    }

    KategoriProduk::create($data);

    return redirect()
      ->route('admin.kategori_produk.index')
      ->with('success', 'Kategori produk berhasil dibuat.');
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $kategori = KategoriProduk::findOrFail($id);
    return view('pages.admin.kategori.show', compact('kategori'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $kategori = KategoriProduk::findOrFail($id);
    return view('pages.admin.kategori.edit', compact('kategori'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nama_222336'      => 'required|string|max:255',
      'deskripsi_222336' => 'required|string',
      'path_img_222336'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'tags_222336'      => 'nullable|string',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $kategori = KategoriProduk::findOrFail($id);
    $data     = $request->all();

    // Handle image upload
    if ($request->hasFile('path_img_222336')) {
      // Delete old image if exists
      if ($kategori->path_img_222336) {
        Storage::disk('public')->delete($kategori->path_img_222336);
      }

      $file                    = $request->file('path_img_222336');
      $fileName                = time() . '_' . $file->getClientOriginalName();
      $filePath                = $file->storeAs('kategori_produk', $fileName, 'public');
      $data['path_img_222336'] = $filePath;
    }

    $kategori->update($data);

    return redirect()
      ->route('admin.kategori_produk.index')
      ->with('success', 'Kategori produk berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $kategori = KategoriProduk::findOrFail($id);

    // Delete image if exists
    if ($kategori->path_img_222336) {
      Storage::disk('public')->delete($kategori->path_img_222336);
    }

    $kategori->delete();

    return redirect()
      ->route('admin.kategori_produk.index')
      ->with('success', 'Kategori produk berhasil dihapus.');
  }
}
