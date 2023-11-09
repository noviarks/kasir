<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = [
            'title'     => 'User',
            'data_user' => User::orderBy('id','desc')->get()
        ];

        return view('admin.master.user.index',$data);
    }

    public function store(Request $request){
        $name       = $request->name;
        $email      = $request->email;
        $password   = Hash::make($request->password);
        $role       = $request->role;
        
        User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => $password,
            'role'      => $role
        ]);

        return redirect('/user')->with('success','Data Berhasil Disimpan');
    }

    public function update(Request $request,$id){

        $name   = $request->name;
        $email  = $request->email;
        $role   = $request->role;

        if(isset($request->password)){
            $password   = Hash::make($request->password);
        }else{
            $password = null;
        }
        
        $user = User::where('id',$id)
            ->update([
                'name'      => $name,
                'email'     => $email,
                'role'      => $role
        ] + ($password == null ? [] : ['password'   => $password]));

        return redirect('/user')->with('success','Data Berhasil Diupdate');
    }

    public function destroy($id){
        if(auth()->user()->id == $id){
            $delete_user = User::where('id', $id)->delete();
            return redirect('/logout');
        }else{
            $delete_user = User::where('id', $id)->delete();
        }
        
        return redirect('/user')->with('success','Data Berhasil Dihapus');
    }
}
