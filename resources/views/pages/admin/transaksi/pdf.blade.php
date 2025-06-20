<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #007bff;
        }

        .header h1 {
            color: #2c3e50;
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: bold;
        }

        .header p {
            color: #6c757d;
            margin: 0;
            font-size: 14px;
        }

        .period {
            background: #e3f2fd;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 10px;
            color: #1976d2;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #343a40;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e8f4fd;
        }

        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-batal {
            background: #f8d7da;
            color: #721c24;
        }

        .price {
            font-weight: 600;
            color: #28a745;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                padding: 20px;
            }

            tr:hover {
                background-color: transparent;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Transaksi</h1>
            <p>Rekapitulasi Data Transaksi</p>
            <div class="period">
                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} -
                {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                    <tr>
                        <td>{{ $transaksi->id_transaksi_222336 }}</td>
                        <td>{{ $transaksi->pelanggan->name ?? 'N/A' }}</td>
                        <td>{{ $transaksi->produk->nama_222336 ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('d-m-Y') }}</td>
                        <td class="price">Rp {{ number_format($transaksi->harga_total_222336, 0, ',', '.') }}</td>
                        <td>
                            <span class="status status-{{ $transaksi->status_222336 }}">
                                {{ ucfirst($transaksi->status_222336) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">
                            Tidak ada data transaksi pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            Dicetak pada: {{ date('d M Y H:i') }}
        </div>
    </div>
</body>

</html>
