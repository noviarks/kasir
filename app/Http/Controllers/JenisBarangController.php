<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    public function index(){
        $data = [
            'title'             => 'Jenis Barang',
            'data_jenis_barang' => JenisBarang::orderBy('id','desc')->get(),
        ];

        return view('admin.master.jenisbarang.index',$data);
    }

    public function store(Request $request){
        $getRow     = JenisBarang::orderBy('id', 'desc')->first();

        if(isset($getRow)){
            $row    = (int)filter_var($getRow->id, FILTER_SANITIZE_NUMBER_INT);
        }else{
            $row    = 0;
        }
        
        $id         = "JB".sprintf("%03s",$row + 1);
        $nama       = $request->nama;

        JenisBarang::create([
            'id'    => $id,
            'nama'  => $nama
        ]);

        return redirect('/jenis-barang')->with('success','Data Berhasil Disimpan');
    }

    public function update(Request $request,$id){
        $nama       = $request->nama;

        JenisBarang::where('id',$id)
            ->update([
                'nama'  => $nama
        ]);
        
        return redirect('/jenis-barang')->with('success','Data Berhasil Diupdate');
    }

    public function destroy($id){
        $delete_jenis_barang = JenisBarang::where('id', $id)->delete();
        
        return redirect('/jenis-barang')->with('success','Data Berhasil Dihapus');
    }
}
