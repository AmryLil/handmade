<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukUserController extends Controller
{
  /**
   * Display a listing of the products.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // Start with a base query
    $query = Produk::with('kategori', 'gambar');

    // Apply search filter if present
    if ($request->has('search')) {
      $search = $request->input('search');
      $query
        ->where('nama_2222336', 'like', "%{$search}%")
        ->orWhere('deskripsi_2222336', 'like', "%{$search}%");
    }

    // Apply category filter if present
    if ($request->has('kategori')) {
      $kategoriId = $request->input('kategori');
      $query->where('kategori_id_2222336', $kategoriId);
    }

    // Apply price range filter if present
    if ($request->has('min_price')) {
      $query->where('harga_2222336', '>=', $request->input('min_price'));
    }

    if ($request->has('max_price')) {
      $query->where('harga_2222336', '<=', $request->input('max_price'));
    }

    // Apply sorting if present
    $sortBy = $request->input('sort', 'newest');  // Default to newest

    switch ($sortBy) {
      case 'price_asc':
        $query->orderBy('harga_2222336', 'asc');
        break;
      case 'price_desc':
        $query->orderBy('harga_2222336', 'desc');
        break;
      case 'name_asc':
        $query->orderBy('nama_2222336', 'asc');
        break;
      case 'name_desc':
        $query->orderBy('nama_2222336', 'desc');
        break;
      case 'newest':
      default:
        $query->orderBy('created_at', 'desc');
        break;
    }

    // Paginate the results
    $products = $query
      ->where('jumlah_2222336', '>', 0)
      ->paginate(12);

    // Get all categories for the filter sidebar
    $categories = KategoriProduk::all();

    return view('pages.users.toko', compact('products', 'categories'));
  }

  /**
   * Display the specified product.
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $product = Produk::with(['kategori', 'gambar', 'preview.user'])
      ->findOrFail($id);

    // Get related products (same category)
    $relatedProducts = Produk::where('kategori_id_2222336', $product->kategori_id_2222336)
      ->where('id_2222336', '!=', $id)
      ->where('jumlah_2222336', '>', 0)
      ->inRandomOrder()
      ->limit(4)
      ->get();

    return view('pages.users.produk', compact('product', 'relatedProducts'));
  }

  /**
   * Display products by category.
   *
   * @param  string  $categoryId
   * @return \Illuminate\Http\Response
   */
  public function byCategory($categoryId)
  {
    $category = KategoriProduk::findOrFail($categoryId);

    $products = Produk::where('kategori_id_2222336', $categoryId)
      ->where('jumlah_2222336', '>', 0)
      ->orderBy('created_at', 'desc')
      ->paginate(12);

    $categories = KategoriProduk::all();

    return view('user.products.by_category', compact('products', 'category', 'categories'));
  }

  /**
   * Display the homepage with featured products.
   *
   * @return \Illuminate\Http\Response
   */
  public function home()
  {
    // Get 3 newest products
    $newestProducts = Produk::where('jumlah_2222336', '>', 0)
      ->orderBy('created_at', 'desc')
      ->limit(3)
      ->get();

    // Get featured products (you might want to add a 'featured' column to your db later)
    $featuredProducts = Produk::where('jumlah_2222336', '>', 0)
      ->inRandomOrder()
      ->limit(8)
      ->get();

    // Get all product categories
    $categories = KategoriProduk::withCount(['produk' => function ($query) {
      $query->where('jumlah_2222336', '>', 0);
    }])
      ->having('produk_count', '>', 0)
      ->get();

    return view('pages.users.home', compact('newestProducts', 'featuredProducts', 'categories'));
  }

  /**
   * Search products.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  {
    $keyword = $request->input('keyword', '');

    $products = Produk::where(function ($query) use ($keyword) {
      $query
        ->where('nama_2222336', 'like', "%{$keyword}%")
        ->orWhere('deskripsi_2222336', 'like', "%{$keyword}%");
    })
      ->where('jumlah_2222336', '>', 0)
      ->orderBy('created_at', 'desc')
      ->paginate(12);

    $categories = KategoriProduk::all();

    return view('user.products.search', compact('products', 'categories', 'keyword'));
  }

  /**
   * Get products for quick search (AJAX).
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function quickSearch(Request $request)
  {
    $keyword = $request->input('keyword', '');

    $products = Produk::where(function ($query) use ($keyword) {
      $query
        ->where('nama_2222336', 'like', "%{$keyword}%")
        ->orWhere('deskripsi_2222336', 'like', "%{$keyword}%");
    })
      ->where('jumlah_2222336', '>', 0)
      ->orderBy('created_at', 'desc')
      ->limit(5)
      ->get();

    return response()->json($products);
  }

  /**
   * Display newest products.
   *
   * @return \Illuminate\Http\Response
   */
  public function newest()
  {
    $products = Produk::where('jumlah_2222336', '>', 0)
      ->orderBy('created_at', 'desc')
      ->paginate(12);

    $categories = KategoriProduk::all();

    return view('user.products.newest', compact('products', 'categories'));
  }

  /**
   * Filter products by price range.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function filterByPrice(Request $request)
  {
    $min = $request->input('min_price', 0);
    $max = $request->input('max_price', PHP_INT_MAX);

    $products = Produk::where('jumlah_2222336', '>', 0)
      ->whereBetween('harga_2222336', [$min, $max])
      ->orderBy('harga_2222336', 'asc')
      ->paginate(12);

    $categories = KategoriProduk::all();

    return view('user.products.price_filter', compact('products', 'categories', 'min', 'max'));
  }
}
