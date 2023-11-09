<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\HapusTransaksi;
use App\Models\DetailTransaksi;
use App\Models\HapusDetailTransaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(){
        $data = [
            'title'             => 'Transaksi',
            'data_transaksi'    => Transaksi::orderBy('id','desc')->get()
        ];

        session()->forget('cart');
        return view('kasir.transaksi.index',$data);
    }

    public function create(){
        $getRow = Transaksi::orderBy('id', 'desc')->first();
        if(isset($getRow)){
            $row    = (int)filter_var($getRow->id, FILTER_SANITIZE_NUMBER_INT);
        }else{
            $row    = 0;
        }
        $id     = "TR".sprintf("%04s",$row + 1);
        $data   = [
                    'title'         => 'Transaksi',
                    'data_barang'   => Barang::orderBy('nama','asc')->get(),
                    'id_transaksi'  => $id
        ];

        return view('kasir.transaksi.create',$data);
    }

    public function getDetailBarang(Request $request){
        $id_barang = $request->id_barang;

        $data = [
            'detail_barang' => Barang::where('id',$id_barang)->get()
        ];

        return view('kasir.transaksi.ajax_barang',$data);
    }

    public function addToCart(Request $request){
        $cart       = session()->get('cart',[]);
        $id_barang  = $request->id_barang;
        $qty        = $request->qty;
        $row        = (int)filter_var($id_barang, FILTER_SANITIZE_NUMBER_INT);
        $barang     = Barang::find($id_barang);
        $nama_barang= $barang->nama;
        $stok       = $barang->stok;
        $diskon     = $barang->diskon;
        $harga      = $barang->harga;

        if($qty > $stok){
            return redirect()->back()->with('error','Qty Lebih Dari Stok');
        }else{
            $cart[$row] = [
                'id_barang'     => $id_barang,
                'nama_barang'   => $nama_barang,
                'qty'           => $qty,
                'harga'         => $harga,
                'stok'          => $stok,
                'diskon'        => $diskon
            ];

            session()->put('cart',$cart);
            return redirect()->back()->with('success','Data Berhasil Ditambah');
        }
        
    }

    public function updateCart(Request $request){
        $id     = (int)filter_var($request->id_barang, FILTER_SANITIZE_NUMBER_INT);
        $qty    = $request->qty;
        $stok   = $request->stok;

        if($qty > $stok){
            return redirect()->back()->with('error','Qty Lebih Dari Stok');
        }

        $cart = session()->get('cart');

        if(isset($cart[$id])){
            $cart[$id]['qty'] = $qty;
            session()->put('cart',$cart);
        }

        return redirect()->back()->with('success','Data Berhasil Diupdate');
        
    }

    public function deleteCart($id){
        if($id){
            $cart = session()->get('cart');
            if(isset($cart[$id])){
                unset($cart[$id]);
                session()->put('cart',$cart);
            }

            return redirect()->back()->with('success','Data Berhasil Dihapus');
        }
    }

    public function store(Request $request){
        $cart = session()->get('cart');

        if(!session('cart')){
            return redirect()->back()->with('error','Barang Tidak Boleh Kosong');
        }

        $id_transaksi       = $request->id_transaksi;
        $tgl_transaksi      = date('Y-m-d');
        $pembayaran         = $request->pembayaran;
        $kembalian          = $request->kembalian;
        $subtotal_diskon    = 0;
        $subtotal_harga     = 0;

        foreach($cart as $row){
            $total_diskon   = ( ($row['diskon']/100) * $row['harga'] ) * $row['qty'];
            $subtotal_diskon+= $total_diskon;

            $total_harga    = $row['harga'] * $row['qty'];
            $subtotal_harga+= $total_harga;
        }

        $total_bayar        = $subtotal_harga - $subtotal_diskon;

        Transaksi::create([
            'id'                => $id_transaksi,
            'tanggal'           => $tgl_transaksi,
            'subtotal_diskon'   => $subtotal_diskon,
            'subtotal_harga'    => $subtotal_harga,
            'total_bayar'       => $total_bayar,
            'pembayaran'        => $pembayaran,
            'kembalian'         => $kembalian,
            'user_id'           => Auth::user()->id
        ]);

        foreach($cart as $item){
            $id_barang  = $item['id_barang'];
            $qty        = $item['qty'];

            $getRow     = DetailTransaksi::orderBy('id', 'desc')->first();
            
            if(isset($getRow)){
                $row    = (int)filter_var($getRow->id, FILTER_SANITIZE_NUMBER_INT);
            }else{
                $row    = 0;
            }

            $id_detail_transaksi    = "DT".sprintf("%04s",$row + 1);
            $id_transaksi           = $id_transaksi;
            $harga                  = $item['harga'];
            $diskon                 = ($item['diskon']/100) * $harga;
            $total_diskon           = $diskon * $item['qty'];
            $total_harga            = $harga * $item['qty'];

            DetailTransaksi::create([
                'id'            => $id_detail_transaksi,
                'id_transaksi'  => $id_transaksi,
                'id_barang'     => $id_barang,
                'qty'           => $qty,
                'diskon'        => $diskon,
                'harga'         => $harga,
                'total_diskon'  => $total_diskon,
                'total_harga'   => $total_harga
            ]);

            $barang                 = Barang::find($id_barang);
            $barang->stok           -= $qty;

            $barang->save();
        }
        session()->forget('cart');
        return redirect('/transaksi')->with('success','Data Berhasil Disimpan');
    }

    public function destroy($id){
        $getRow     = HapusTransaksi::orderBy('id', 'desc')->first();

        if(isset($getRow)){
            $row    = (int)filter_var($getRow->id, FILTER_SANITIZE_NUMBER_INT);
        }else{
            $row    = 0;
        }
        
        $id_hapus_transaksi     = "HT".sprintf("%04s",$row + 1);
        $transaksi              = Transaksi::where('id',$id)->first();
        
        HapusTransaksi::create([
            'id'                => $id_hapus_transaksi,
            'id_transaksi'      => $transaksi->id,
            'tanggal'           => $transaksi->tanggal,
            'subtotal_diskon'   => $transaksi->subtotal_diskon,
            'subtotal_harga'    => $transaksi->subtotal_harga,
            'total_bayar'       => $transaksi->total_bayar,
            'pembayaran'        => $transaksi->pembayaran,
            'kembalian'         => $transaksi->kembalian,
            'user_id'           => Auth::user()->id
        ]);

        $detail_transaksi = DetailTransaksi::where('id_transaksi',$id)->get();

        if(isset($detail_transaksi)){
            foreach($detail_transaksi as $detail){
                $getRow     = HapusDetailTransaksi::orderBy('id', 'desc')->first();
               
                if(isset($getRow)){
                    $row    = (int)filter_var($getRow->id, FILTER_SANITIZE_NUMBER_INT);
                }else{
                    $row    = 0;
                }

                $id_hapus_detail_transaksi  = "DH".sprintf("%04s",$row + 1);

                HapusDetailTransaksi::create([
                    'id'                    => $id_hapus_detail_transaksi,
                    'id_hapus_transaksi'    => $id_hapus_transaksi,
                    'id_barang'             => $detail->id_barang,
                    'qty'                   => $detail->qty,
                    'diskon'                => $detail->diskon,
                    'harga'                 => $detail->harga,
                    'total_diskon'          => $detail->total_diskon,
                    'total_harga'           => $detail->total_harga
                ]);
            }

            $delete_detail_transaksi = DetailTransaksi::where('id_transaksi', $id)->delete();
        }

        $delete_transaksi = Transaksi::where('id', $id)->delete();

        return redirect('/transaksi')->with('success','Data Berhasil Dihapus');
    }

    public function detail($id){
        $data = [
            'title'                 => 'Detail Transaksi',
            'id'                    => $id,
            'data_transaksi'        => Transaksi::where('id',$id)->get(),
            'data_detail_transaksi' => Transaksi::join('detail_transaksi','transaksi.id','=','detail_transaksi.id_transaksi')
                                                ->join('barang','barang.id','=','detail_transaksi.id_barang')
                                                ->select('transaksi.id','transaksi.tanggal','detail_transaksi.qty','barang.nama','detail_transaksi.harga',
                                                        'detail_transaksi.diskon','detail_transaksi.total_diskon','detail_transaksi.total_harga',
                                                        'transaksi.subtotal_diskon','transaksi.subtotal_harga','transaksi.total_bayar','transaksi.pembayaran',
                                                        'transaksi.kembalian')
                                                ->where('transaksi.id',$id)
                                                ->get()
        ];
        
        return view('kasir.transaksi.detail',$data);
    }

    public function cetak($id){
        $data = [
            'title'                 => 'Cetak Transaksi',
            'data_transaksi'        => Transaksi::where('id',$id)->get(),
            'data_detail_transaksi' => Transaksi::join('detail_transaksi','transaksi.id','=','detail_transaksi.id_transaksi')
                                                ->join('barang','barang.id','=','detail_transaksi.id_barang')
                                                ->select('transaksi.id','transaksi.tanggal','detail_transaksi.qty','barang.nama','detail_transaksi.harga',
                                                        'detail_transaksi.diskon','detail_transaksi.total_diskon','detail_transaksi.total_harga',
                                                        'transaksi.subtotal_diskon','transaksi.subtotal_harga','transaksi.total_bayar','transaksi.pembayaran',
                                                        'transaksi.kembalian')
                                                ->where('transaksi.id',$id)
                                                ->get()
        ];
        
        return view('kasir.transaksi.cetak',$data);
    }
}
