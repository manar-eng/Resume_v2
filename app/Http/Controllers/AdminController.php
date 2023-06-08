<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile(){
        $id = Auth::user()->id;
        $admindata = User::find($id);
        return view('admin.admin_profile_view',compact('admindata'));

    }

    public function editprofile(){
        $id = Auth::user()->id;
        $editdata = User::find($id);
        return view('admin.admin_profile_edit',compact('editdata'));

    }

    public function sorteprofile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;

        if ($request->file('profile_image'))
        {
            $file  =$request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'admin profile updated successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function changepassword(){

        return view('admin.admin_change_password');
    }

    public function updatepassword(Request $request){
       
        $validation = $request->validate([
            'oldpassword' =>'required',
            'newpassword' =>'required',
            'confirm_password' =>'required|same:newpassword',
        ]);

        $hashedpassword =  Auth::user()->password;
       if(Hash::check($request->oldpassword,$hashedpassword)){
        $users = User::find(Auth::id());
        $users->password = bcrypt($request->newpassword);
        $users->save();

        session()->flash('message','update password succssflly');
        return redirect()->back();
       }
       else
       session()->flash('message','the old password is not match');
       return redirect()->back();
    }

    public function Home(){
        return view('frontend/index');
    }


}
