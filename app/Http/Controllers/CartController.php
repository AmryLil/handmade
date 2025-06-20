<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the user's cart
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil keranjang dengan relasi
        $cart = $user->cart()->with(['items.product.kategori'])->first();

        // Jika belum ada keranjang, kirim data kosong ke view
        if (!$cart) {
            return view('pages.users.keranjang', [
                'cart'       => null,
                'items'      => [],
                'total'      => 0,
                'item_count' => 0
            ]);
        }

        $total = $cart->items->sum(function ($item) {
            return $item->quantity_222336 * $item->price_222336;
        });

        return view('pages.users.keranjang', [
            'cart'       => $cart,
            'items'      => $cart->items,
            'total'      => $total,
            'item_count' => $cart->items->sum('quantity_222336')
        ]);
    }

    /**
     * Add item to cart
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|exists:produk_222336,id_222336',
            'quantity'   => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $product = Produk::find($request->product_id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Check stock availability
        if ($product->jumlah_222336 < $request->quantity) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error'           => 'Insufficient stock',
                    'available_stock' => $product->jumlah_222336
                ], 400);
            }
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $product->jumlah_222336);
        }

        DB::beginTransaction();

        try {
            // Get or create cart
            $cart = $user->cart()->firstOrCreate([
                'user_id_222336' => $user->email_222336
            ]);

            // Check if item already exists in cart
            $existingItem = $cart->items()->where('product_id_222336', $request->product_id)->first();

            if ($existingItem) {
                // Update quantity
                $newQuantity = $existingItem->quantity_222336 + $request->quantity;

                // Check total stock
                if ($product->jumlah_222336 < $newQuantity) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'error'           => 'Insufficient stock for total quantity',
                            'available_stock' => $product->jumlah_222336,
                            'current_in_cart' => $existingItem->quantity_222336
                        ], 400);
                    }
                    return back()->with('error', 'Stok tidak mencukupi untuk total jumlah. Stok tersedia: ' . $product->jumlah_222336 . ', Sudah di keranjang: ' . $existingItem->quantity_222336);
                }

                $existingItem->update([
                    'quantity_222336' => $newQuantity,
                    'price_222336'    => $product->harga_222336  // Update with current price
                ]);

                $cartItem = $existingItem;
            } else {
                // Create new cart item
                $cartItem = CartItem::create([
                    'cart_id_222336'    => $cart->id_222336,
                    'product_id_222336' => $request->product_id,
                    'quantity_222336'   => $request->quantity,
                    'price_222336'      => $product->harga_222336
                ]);
            }

            DB::commit();

            // Load relationships for response
            $cartItem->load('product');

            if ($request->expectsJson()) {
                return response()->json([
                    'message'   => 'Item added to cart successfully',
                    'cart_item' => $cartItem
                ], 201);
            }

            return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Failed to add item to cart', 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal menambahkan produk ke keranjang: ' . $e->getMessage());
        }
    }

    /**
     * Update cart item quantity
     */
    public function updateItem(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cartItem = CartItem::whereHas('cart', function ($query) use ($user) {
            $query->where('user_id_222336', $user->email_222336);
        })->where('id_222336', $itemId)->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $product = $cartItem->product;

        // Check stock availability
        if ($product->jumlah_222336 < $request->quantity) {
            return response()->json([
                'error'           => 'Insufficient stock',
                'available_stock' => $product->jumlah_222336
            ], 400);
        }

        $cartItem->update([
            'quantity_222336' => $request->quantity,
            'price_222336'    => $product->harga_222336  // Update with current price
        ]);

        $cartItem->load('product');

        return response()->json([
            'message'   => 'Cart item updated successfully',
            'cart_item' => $cartItem
        ]);
    }

    /**
     * Remove item from cart
     */
    public function removeItem($itemId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cartItem = CartItem::whereHas('cart', function ($query) use ($user) {
            $query->where('user_id_222336', $user->email_222336);
        })->where('id_222336', $itemId)->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart successfully'
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clearCart()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cart = $user->cart;

        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json([
            'message' => 'Cart cleared successfully'
        ]);
    }

    /**
     * Get cart summary (item count and total)
     */
    public function summary()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cart = $user->cart()->with('items')->first();

        if (!$cart) {
            return response()->json([
                'item_count' => 0,
                'total'      => 0
            ]);
        }

        $itemCount = $cart->items->sum('quantity_222336');
        $total     = $cart->items->sum(function ($item) {
            return $item->quantity_222336 * $item->price_222336;
        });

        return response()->json([
            'item_count' => $itemCount,
            'total'      => $total
        ]);
    }

    /**
     * Check if product is in cart
     */
    public function checkProduct($productId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cart = $user->cart;

        if (!$cart) {
            return response()->json([
                'in_cart'  => false,
                'quantity' => 0
            ]);
        }

        $cartItem = $cart->items()->where('product_id_222336', $productId)->first();

        return response()->json([
            'in_cart'      => $cartItem ? true : false,
            'quantity'     => $cartItem ? $cartItem->quantity_222336 : 0,
            'cart_item_id' => $cartItem ? $cartItem->id_222336 : null
        ]);
    }

    /**
     * Validate cart before checkout
     */
    public function validateCart()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cart = $user->cart()->with(['items.product'])->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'valid' => false,
                'error' => 'Cart is empty'
            ], 400);
        }

        $errors     = [];
        $validItems = [];

        foreach ($cart->items as $item) {
            $product = $item->product;

            if (!$product) {
                $errors[] = "Product not found for cart item {$item->id_222336}";
                continue;
            }

            if ($product->jumlah_222336 < $item->quantity_222336) {
                $errors[] = "Insufficient stock for {$product->nama_222336}. Available: {$product->jumlah_222336}, Requested: {$item->quantity_222336}";
                continue;
            }

            // Check if price has changed
            if ($product->harga_222336 != $item->price_222336) {
                $item->update(['price_222336' => $product->harga_222336]);
            }

            $validItems[] = $item;
        }

        if (!empty($errors)) {
            return response()->json([
                'valid'  => false,
                'errors' => $errors
            ], 400);
        }

        $total = collect($validItems)->sum(function ($item) {
            return $item->quantity_222336 * $item->price_222336;
        });

        return response()->json([
            'valid'      => true,
            'items'      => $validItems,
            'total'      => $total,
            'item_count' => collect($validItems)->sum('quantity_222336')
        ]);
    }
}
