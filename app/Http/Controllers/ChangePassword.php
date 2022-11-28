<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Auth;

class ChangePassword extends Controller
{
    public function ChangePass(){
        return view('admin.body.change_password');
    }

    public function UpdatePass(Request $request){
        $validate = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword )){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'successfully Password Changed');

        }else{
            return Redirect()->back()->with('error', 'Current Password was worng');
        }
        
    }

    public function profileUpdate(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UserUpdate(Request  $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return Redirect()->back()->with('success', 'successfully User profile updated');
        }else{
            return Redirect()->back()->with('error', 'Somthing was wrong');
        }

    }
}
