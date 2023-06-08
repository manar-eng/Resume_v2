<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contact;

class ContectController extends Controller
{
    //
    public function Contact(){
        return view('frontend.contact');

    }

    public function StoreMassage(Request $request){
        contact::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'phone'=> $request->phone,
            'message'=> $request->message,
        ]);
        $notification = array(
            'message' => 'Massage Submited  Successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ContactMessage(){
        $contacts =contact::latest()->get();
        return view('admin.contact.allcontact',compact('contacts'));
    }

    public function DeleteMessage($id){
        contact::findorfail($id)->delete();
        $notification = array(
            'message' => 'Massage deleted  Successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
