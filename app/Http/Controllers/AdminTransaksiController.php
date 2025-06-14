<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;  // Tambahkan ini
use Carbon\Carbon;
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

        // Selalu ambil data transaksi
        $query = Transaksi::with(['pelanggan', 'produk']);

        // Jika ada filter tanggal, terapkan filter
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_transaksi_222336', [$startDate, $endDate]);
        }

        // Ambil semua data dengan urutan tanggal terbaru
        $transaksis = $query->orderBy('tanggal_transaksi_222336', 'desc')->get();

        return view('pages.admin.transaksi.laporan', compact('transaksis', 'startDate', 'endDate'));
    }

    /**
     * Mengekspor data laporan ke PDF.
     */
    public function exportPdf(Request $request)
    {
        // 1. Ubah validasi menjadi opsional (nullable)
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        // 2. Buat query dinamis menggunakan when()
        $query = Transaksi::with(['pelanggan', 'produk']);

        // Terapkan filter hanya jika kedua tanggal diisi
        $query->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            // Tambahkan waktu 23:59:59 ke tanggal akhir agar data di hari itu ikut terambil
            $endOfDay = Carbon::parse($endDate)->endOfDay();
            return $q->whereBetween('tanggal_transaksi_222336', [$startDate, $endOfDay]);
        });

        $transaksis = $query->orderBy('tanggal_transaksi_222336', 'asc')->get();

        // 3. Buat nama file dinamis
        if ($startDate && $endDate) {
            $fileName = 'laporan-transaksi-' . $startDate . '-sampai-' . $endDate . '.pdf';
        } else {
            $fileName = 'laporan-transaksi-semua-periode-' . date('Y-m-d') . '.pdf';
        }

        // Load view dan data ke PDF
        $pdf = PDF::loadView('pages.admin.transaksi.pdf', compact('transaksis', 'startDate', 'endDate'));

        // Unduh PDF
        return $pdf->download($fileName);
    }
}
