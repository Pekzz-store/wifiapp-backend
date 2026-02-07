<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h3 { margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #f0f0f0; }
        .right { text-align: right; }
    </style>
</head>
<body>

<h2>LAPORAN PEMBAYARAN WIFI</h2>
<p>
    Bulan: <strong>{{ $bulan }}</strong> /
    Tahun: <strong>{{ $tahun }}</strong>
</p>

<hr>

<h3>RINGKASAN</h3>
<table>
    <tr>
        <td>Total Pelanggan</td>
        <td class="right">{{ $sudahBayar->count() + $belumBayar->count() }}</td>
    </tr>
    <tr>
        <td>Sudah Bayar</td>
        <td class="right">{{ $sudahBayar->count() }}</td>
    </tr>
    <tr>
        <td>Belum Bayar</td>
        <td class="right">{{ $belumBayar->count() }}</td>
    </tr>
    <tr>
        <th>Total Pemasukan</th>
        <th class="right">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
    </tr>
</table>

<br>

<h3>DAFTAR SUDAH BAYAR</h3>
<table>
    <thead>
        <tr>
            <th>PPPoE</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sudahBayar as $p)
        <tr>
            <td>{{ $p->pppoe_username }}</td>
            <td>{{ $p->nama_pelanggan }}</td>
            <td class="right">Rp {{ number_format($p->jumlah,0,',','.') }}</td>
            <td>{{ strtoupper($p->metode) }}</td>
            <td>{{ $p->paid_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

<h3>DAFTAR BELUM BAYAR</h3>
<table>
    <thead>
        <tr>
            <th>PPPoE</th>
            <th>Nama</th>
            <th>Tagihan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($belumBayar as $p)
        <tr>
            <td>{{ $p->pppoe_username }}</td>
            <td>{{ $p->nama_pelanggan }}</td>
            <td class="right">Rp {{ number_format($p->jumlah,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
