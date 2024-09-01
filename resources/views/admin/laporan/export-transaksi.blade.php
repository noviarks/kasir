<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Id Transaksi</th>
            <th>Tl Transaksi</th>
            <th>Subtotal Harga</th>
            <th>Subtotal Diskon</th>
            <th>Total Bayar</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp

        @foreach($data_transaksi as $row)
            <tr>
                <td>{{ $no++; }}</td>
                <td>{{ $row->id }}</td>
                <td>{{ date('d/m/Y',strtotime($row->tanggal)) }}</td>
                <td>Rp {{ number_format($row->subtotal_harga) }}</td>
                <td>Rp {{ number_format($row->subtotal_diskon) }}</td>
                <td>Rp {{ number_format($row->total_bayar) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

                  
