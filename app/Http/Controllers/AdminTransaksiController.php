<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;  // Tambahkan ini
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'produk'])
            ->orderBy('tanggal_transaksi_222336', 'desc')
            ->get();

        return view('pages.admin.transaksi.index', compact('transaksis'));
    }

    // Mengubah status transaksi

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            // DIUBAH: Sesuaikan dengan daftar status yang baru
            'status' => 'required|in:pending,dikemas,dikirim,selesai'
        ]);

        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['success' => false, 'message' => 'Transaksi tidak ditemukan.'], 404);
        }

        $transaksi->status_222336 = $request->status;
        $transaksi->save();

        return response()->json(['success' => true, 'message' => 'Status transaksi berhasil diperbarui.']);
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->findOrFail($id);
        return view('pages.admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Menampilkan halaman laporan dengan filter tanggal.
     */
    public function laporan(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $transaksis = [];

        if ($startDate && $endDate) {
            $transaksis = Transaksi::with(['pelanggan', 'produk'])
                ->whereBetween('tanggal_transaksi_222336', [$startDate, $endDate])
                ->orderBy('tanggal_transaksi_222336', 'asc')
                ->get();
        }

        return view('pages.admin.transaksi.laporan', compact('transaksis', 'startDate', 'endDate'));
    }

    /**
     * Mengekspor data laporan ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $transaksis = Transaksi::with(['pelanggan', 'produk'])
            ->whereBetween('tanggal_transaksi_222336', [$startDate, $endDate])
            ->orderBy('tanggal_transaksi_222336', 'asc')
            ->get();

        // Membuat PDF
        $pdf = PDF::loadView('pages.admin.transaksi.pdf', compact('transaksis', 'startDate', 'endDate'));

        // Mengatur nama file PDF yang akan diunduh
        $fileName = 'laporan-transaksi-' . $startDate . '-sampai-' . $endDate . '.pdf';

        // Mengunduh PDF
        return $pdf->download($fileName);
    }
}
