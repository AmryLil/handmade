<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'produk'])
            ->orderBy('tanggal_transaksi_222336', 'desc')
            ->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    // Mengubah status transaksi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status_222336' => $request->status]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->findOrFail($id);
        return view('admin.transaksi.show', compact('transaksi'));
    }
}
