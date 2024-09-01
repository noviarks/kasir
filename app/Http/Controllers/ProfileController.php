<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $data = [
            'title'         => 'Profile',
            'data_profile'  => User::where('id',$user->id)->get()
        ];

        return view('profile',$data);
    }

    public function update(Request $request,$id){

        $name   = $request->name;
        $email  = $request->email;

        if(isset($request->password)){
            $password   = Hash::make($request->password);
        }else{
            $password = null;
        }
        
        $user = User::where('id',$id)
            ->update([
                'name'      => $name,
                'email'     => $email,
        ] + ($password == null ? [] : ['password'   => $password]));

        return redirect('/profile')->with('success','Data Berhasil Diupdate');
    }
}
