<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Struk {{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th,
        td {
            border: 1px solid #ddd;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Laporan Transaksi {{ ucfirst($title) }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Id</th>
                <th>Status</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Catatan</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->transaksi_id }}</td>
                <td>{{ $data->status == 1 ? 'Lunas' : 'Belum Lunas' }}</td>
                <td>{{ $data->nama_transaksi }}</td>
                <td>Rp{{ number_format($data->nominal, 0, ',', '.') }}</td>
                <td>{{ $data->catatan }}</td>
                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: right;">Total Transaksi:</td>
                <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
