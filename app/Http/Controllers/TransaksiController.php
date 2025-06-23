<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    // Menampilkan riwayat transaksi user
    public function index()
    {
        $user       = Auth::user();
        $transaksis = Transaksi::where('id_pelanggan_222336', $user->email_222336)
            ->orderBy('tanggal_transaksi_222336', 'desc')
            ->get();

        return view('pages.users.transaksi', compact('transaksis'));
    }

    public function uploadBatch(Request $request)
    {
        $request->validate([
            'transaksi_ids' => 'required|string',  // Ubah ke string karena dari form akan jadi JSON string
            'bukti_tf'      => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();

        // Decode JSON string ke array
        $transaksiIds = json_decode($request->transaksi_ids, true);

        if (!$transaksiIds || !is_array($transaksiIds)) {
            return response()->json([
                'success' => false,
                'error'   => 'Data transaksi tidak valid'
            ], 400);
        }

        // Validasi semua transaksi milik user
        $validTransaksi = Transaksi::whereIn('id_transaksi_222336', $transaksiIds)
            ->where('id_pelanggan_222336', $user->email_222336)
            ->count();

        if ($validTransaksi !== count($transaksiIds)) {
            return response()->json([
                'success' => false,
                'error'   => 'Beberapa transaksi tidak valid'
            ], 400);
        }

        try {
            $path = $request->file('bukti_tf')->store('bukti_transfer', 'public');

            // Update semua transaksi
            Transaksi::whereIn('id_transaksi_222336', $transaksiIds)
                ->where('id_pelanggan_222336', $user->email_222336)
                ->update([
                    'bukti_tf_222336' => $path,
                    'status_222336'   => 'menunggu_konfirmasi'  // Update status juga
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Bukti pembayaran berhasil diupload'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Gagal mengupload bukti pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    // Perbaiki method checkout
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id_222336', $user->email_222336)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'success' => false,
                'error'   => 'Keranjang belanja kosong'
            ], 400);
        }

        DB::beginTransaction();
        try {
            $transaksiIds = [];
            $products     = [];
            $totalHarga   = 0;

            foreach ($cart->items as $item) {
                $produk = Produk::find($item->product_id_222336);

                if (!$produk) {
                    throw new \Exception('Produk tidak ditemukan');
                }

                // Cek stok
                if ($produk->jumlah_222336 < $item->quantity_222336) {
                    throw new \Exception('Stok produk ' . $produk->nama_222336 . ' tidak mencukupi. Stok tersedia: ' . $produk->jumlah_222336);
                }

                // Kurangi stok
                $produk->decrement('jumlah_222336', $item->quantity_222336);

                // Hitung total harga untuk item
                $hargaTotalItem = $item->quantity_222336 * $item->price_222336;  // Gunakan harga dari cart item
                $totalHarga    += $hargaTotalItem;

                // Buat transaksi
                $transaksi = Transaksi::create([
                    'id_pelanggan_222336'      => $user->email_222336,
                    'id_produk_222336'         => $produk->id_222336,
                    'jumlah_222336'            => $item->quantity_222336,
                    'harga_total_222336'       => $hargaTotalItem,
                    'status_222336'            => 'pending',
                    'tanggal_transaksi_222336' => now(),
                ]);

                $transaksiIds[] = $transaksi->id_transaksi_222336;

                // Simpan data produk untuk response
                $products[] = [
                    'nama'     => $produk->nama_222336,
                    'jumlah'   => $item->quantity_222336,
                    'harga'    => $item->price_222336,
                    'subtotal' => $hargaTotalItem,
                    'gambar'   => $produk->getImageUrlAttribute() ?? '/images/no-image.png'
                ];
            }

            // Kosongkan keranjang
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return response()->json([
                'success'       => true,
                'transaksi_ids' => $transaksiIds,
                'products'      => $products,
                'total'         => $totalHarga,
                'message'       => 'Checkout berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 400);
        }
    }

    public function completeCheckout(Request $request)
    {
        // 1. Validasi input, TERMASUK kode voucher sekarang
        $validatedData = $request->validate([
            'cart_items'   => 'required|json',
            'bukti_tf'     => 'required|image|max:2048',
            'kode_voucher' => 'nullable|string',  // Voucher boleh kosong
        ]);

        $user        = Auth::user();
        $cartItems   = json_decode($validatedData['cart_items'], true);
        $kodeVoucher = $validatedData['kode_voucher'];

        if (empty($cartItems)) {
            return response()->json(['success' => false, 'error' => 'Keranjang belanja kosong.'], 400);
        }

        // Gunakan DB Transaction untuk memastikan semua proses berhasil atau semua gagal.
        try {
            DB::beginTransaction();

            // --- TAHAP 1: KALKULASI HARGA ASLI & VALIDASI PRODUK ---
            // JANGAN PERNAH PERCAYA HARGA DARI FRONTEND, HITUNG ULANG DI SERVER!
            $hargaSubtotalAsli = 0;
            $itemsToProcess    = [];

            foreach ($cartItems as $item) {
                // Gunakan findOrFail untuk otomatis error jika produk tidak ditemukan
                $produk = \App\Models\Produk::findOrFail($item['id']);

                if ($produk->jumlah_222336 < $item['jumlah']) {
                    throw new \Exception('Stok produk ' . $produk->nama_222336 . ' tidak mencukupi.');
                }

                $hargaItemAsli      = $produk->harga_222336 * $item['jumlah'];
                $hargaSubtotalAsli += $hargaItemAsli;

                $itemsToProcess[] = [
                    'produk'     => $produk,
                    'jumlah'     => $item['jumlah'],
                    'harga_asli' => $hargaItemAsli
                ];
            }

            // --- TAHAP 2: VALIDASI & PENERAPAN VOUCHER ---
            $persentaseDiskon = 0;
            $voucherValid     = null;  // Variabel untuk menyimpan voucher yang valid

            if ($kodeVoucher) {
                // Cari voucher berdasarkan KODE, KEPEMILIKAN USER, dan STATUS
                $voucher = \App\Models\Voucher::where('kode_voucher_222336', $kodeVoucher)
                    ->where('id_user_222336', $user->email_222336)
                    ->where('status_222336', 'tersedia')
                    ->where('tanggal_kadaluarsa_222336', '>=', now())
                    ->first();

                // Jika voucher tidak ditemukan atau tidak valid, lempar error
                if (!$voucher) {
                    throw new \Exception('Kode voucher tidak valid, sudah dipakai, atau kadaluarsa.');
                }

                // Jika valid, simpan voucher dan persentase diskonnya
                $voucherValid     = $voucher;
                $persentaseDiskon = $voucher->persentase_diskon_222336;
            }

            // --- TAHAP 3: FINALISASI & PEMBUATAN TRANSAKSI ---

            $filePath = $request->file('bukti_tf')->store('bukti_transfer', 'public');

            foreach ($itemsToProcess as $procItem) {
                $hargaItemFinal = $procItem['harga_asli'];

                // Jika ada diskon, POTONG HARGANYA di sini
                if ($persentaseDiskon > 0) {
                    $potongan        = ($hargaItemFinal * $persentaseDiskon) / 100;
                    $hargaItemFinal -= $potongan;
                }

                // Kurangi stok
                $procItem['produk']->decrement('jumlah_222336', $procItem['jumlah']);

                // Buat transaksi dengan harga final
                \App\Models\Transaksi::create([
                    'id_pelanggan_222336'      => $user->email_222336,
                    'id_produk_222336'         => $procItem['produk']->id_222336,
                    'jumlah_222336'            => $procItem['jumlah'],
                    'harga_total_222336'       => $hargaItemFinal,  // <-- HARGA SUDAH TERPOTONG
                    'status_222336'            => 'pending',
                    'bukti_tf_222336'          => $filePath,
                    'tanggal_transaksi_222336' => now(),
                ]);
            }

            // --- TAHAP 4: "BAKAR" VOUCHER & KOSONGKAN KERANJANG ---

            // Jika ada voucher yang valid, UBAH STATUSNYA
            if ($voucherValid) {
                $voucherValid->update([
                    'status_222336' => 'terpakai'
                    // Anda juga bisa mengisi 'id_booking_terpakai' jika perlu
                ]);
            }

            // Kosongkan keranjang
            $cartInDb = \App\Models\Cart::where('user_id_222336', $user->email_222336)->first();
            if ($cartInDb) {
                $cartInDb->items()->delete();
                $cartInDb->delete();
            }

            // Jika semua berhasil, commit perubahan ke database
            DB::commit();

            return response()->json([
                'success'      => true,
                'message'      => 'Checkout berhasil! Pesanan Anda sedang diproses.',
                'redirect_url' => route('vouchers.my')  // Arahkan ke halaman riwayat atau voucher
            ]);
        } catch (\Exception $e) {
            // Jika ada error di mana pun, batalkan semua perubahan
            DB::rollBack();

            // Kirim pesan error yang jelas ke frontend
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 422);  // Gunakan status 422 untuk error validasi/logika
        }
    }

    // // Proses checkout
    // public function checkout(Request $request)
    // {
    //     $user = Auth::user();
    //     $cart = Cart::where('user_id_222336', $user->email_222336)->first();

    //     if (!$cart || $cart->items->isEmpty()) {
    //         return redirect()->back()->with('error', 'Keranjang belanja kosong');
    //     }

    //     DB::beginTransaction();
    //     try {
    //         foreach ($cart->items as $item) {
    //             $produk = Produk::find($item->product_id_222336);

    //             // Cek stok
    //             if ($produk->jumlah_222336 < $item->quantity_222336) {
    //                 throw new \Exception('Stok produk ' . $produk->nama_222336 . ' tidak mencukupi');
    //             }

    //             // Kurangi stok
    //             $produk->decrement('jumlah_222336', $item->quantity_222336);

    //             // Buat transaksi
    //             Transaksi::create([
    //                 'id_pelanggan_222336'      => $user->email_222336,
    //                 'id_produk_222336'         => $produk->id_222336,
    //                 'jumlah_222336'            => $item->quantity_222336,
    //                 'harga_total_222336'       => $item->quantity_222336 * $produk->harga_222336,
    //                 'status_222336'            => 'pending',
    //                 'tanggal_transaksi_222336' => now(),
    //             ]);
    //         }

    //         // Kosongkan keranjang
    //         $cart->items()->delete();
    //         $cart->delete();

    //         DB::commit();
    //         return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil! Silakan upload bukti transfer');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }

    // Upload bukti transfer
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $user      = Auth::user();

        // Validasi kepemilikan transaksi
        if ($transaksi->id_pelanggan_222336 !== $user->email_222336) {
            abort(403, 'Unauthorized action');
        }

        if ($request->hasFile('bukti_tf')) {
            // Hapus bukti lama jika ada
            if ($transaksi->bukti_tf_222336) {
                Storage::delete('public/' . $transaksi->bukti_tf_222336);
            }

            // Simpan file baru
            $path = $request->file('bukti_tf')->store('bukti_transfer', 'public');
            $transaksi->update(['bukti_tf_222336' => $path]);
        }

        return redirect()->back()->with('success', 'Bukti transfer berhasil diupload');
    }
}
