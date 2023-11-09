<html>
    <head>
        <title>{{ $title }}</title>
        <style>

            #tabel
            {
            font-size:15px;
            border-collapse:collapse;
            }
            #tabel  td
            {
            padding-left:5px;
            border: 1px solid black;
            }

            hr { 
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>
    </head>
    <body style='font-family:tahoma; font-size:8pt;' onload="window.print()">
    @foreach($data_transaksi as $row)
        <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
                <b>PT CANTIK GEMILANG</b></br>Jl. Raya Perning No. 120, Jetis, Mojokerto</span></br>
                <span style='font-size:14pt;'>Telp. : (0321) 6865431</span><hr>
                <span style='font-size:12pt'>Kode: {{ $row->id }} Tgl: {{ date('d/m/Y H:m',strtotime($row->created_at)) }} Kasir: {{ ucwords($row->user_kasir->name) }} 
                </span><hr>
            </td>
        </table>
        

        <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td width='2%'>No</td>
                <td width='10%'>Barang</td>
                <td width='4%'>Qty</td>
                <td width='18%'>Total Harga</td>
                <td width='18%'>Total Diskon</td>
                <tr>
                    <td colspan='5'><hr></td>
                </tr>
            </tr>
            @php 
                $no = 1;
            @endphp
            
            @foreach($data_detail_transaksi as $detail)
            <tr align='center'>
                <td style='vertical-align:top'>{{ $no++ }}</td>
                <td style='vertical-align:top;text-align:left; padding-left:10px'>{{ $detail->nama }}</td>
                <td style='vertical-align:top;'>{{ $detail->qty }}</td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ $detail->total_harga }}</td>
                <td style='text-align:right; vertical-align:top'>{{ $detail->total_diskon }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan='5'><hr></td>
            </tr>
            <tr>
                <td colspan = '4'>
                    <div style='text-align:right'>Subtotal Harga : </div>
                </td>
                <td style='text-align:right; font-size:16pt;'>{{ number_format($row->subtotal_harga) }}</td>
            </tr>
            <tr>
                <td colspan = '4'>
                    <div style='text-align:right; color:black'>Subtotal Diskon : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>{{ number_format($row->subtotal_diskon) }}</td>
            </tr>
            <tr>
                <td colspan = '4'>
                    <div style='text-align:right; color:black'>Total Bayar : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>{{ number_format($row->total_bayar) }}</td>
            </tr>
            <tr>
                <td colspan = '4'>
                    <div style='text-align:right; color:black'>Pembayaran : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>{{ number_format($row->pembayaran) }}</td>
            </tr>
            <tr>
                <td colspan = '4'>
                    <div style='text-align:right; color:black'>Kembalian : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>{{ number_format($row->kembalian) }}</td> 
            </tr>
            <tr>
                <td colspan='5'><hr></td>
            </tr>
        </table>
        
        <table style='width:350; font-size:12pt;margin-top:20px;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table></center>
    @endforeach
    </body>
</html>