<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;

class BarangController extends Controller
{
    public function index(){
        $data = [
            'title'             => 'Barang',
            'data_barang'       => Barang::orderBy('id','desc')->get(),
            'data_jenis_barang' => JenisBarang::orderBy('nama','asc')->get()
        ];

        return view('admin.master.barang.index',$data);
    }

    public function store(Request $request){
        $getRow     = Barang::orderBy('id', 'desc')->first();
        
        if(isset($getRow)){
            $row    = (int)filter_var($getRow->id, FILTER_SANITIZE_NUMBER_INT);
        }else{
            $row    = 0;
        }

        $id                 = "BA".sprintf("%03s",$row + 1);
        $id_jenis_barang    = $request->id_jenis_barang;
        $nama               = $request->nama;
        $harga              = $request->harga;
        $stok               = $request->stok;
        $diskon             = $request->diskon;

        Barang::create([
            'id'                => $id,
            'id_jenis_barang'   => $id_jenis_barang,
            'nama'              => $nama,
            'harga'             => $harga,
            'stok'              => $stok,
            'diskon'            => $diskon
        ]);

        return redirect('/barang')->with('success','Data Berhasil Disimpan');
    }

    public function update(Request $request,$id){
        $id_jenis_barang    = $request->id_jenis_barang;
        $nama               = $request->nama;
        $harga              = $request->harga;
        $stok               = $request->stok;
        $diskon             = $request->diskon;

        Barang::where('id',$id)
            ->update([
                'id_jenis_barang'   => $id_jenis_barang,
                'nama'              => $nama,
                'harga'             => $harga,
                'stok'              => $stok,
                'diskon'            => $diskon
        ]);
        
        return redirect('/barang')->with('success','Data Berhasil Diupdate');
    }

    public function destroy($id){
        $delete_barang = Barang::where('id', $id)->delete();
        
        return redirect('/barang')->with('success','Data Berhasil Dihapus');
    }
}
