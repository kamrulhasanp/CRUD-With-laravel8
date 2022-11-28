<?php

namespace App\Http\Controllers;
use App\Models\Contacts;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Models;


class ContactController extends Controller
{
    public function AdminContact(){
        $contacts = Contacts::all();
        return view('admin.contact.index', compact('contacts'));

    }

    public function AddContact(){
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request){
        Contacts::insert([
            'email' =>$request->email,
            'phone' =>$request->phone,
            'address' =>$request->address,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');
    }

    public function Contact(){
        $contacts = DB::table('contacts')->first();
        return view('pages.contact', compact('contacts'));
    }


    public function ContactForm(Request $request){
        ContactForm::insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'message' =>$request->message,
            'subject' =>$request->subject,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->route('contact')->with('success', 'your message send Successfully');


    }

    public function AdminMessage(){
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

    public function Delete($id){
        $delete = ContactForm::find($id)->Delete();
        return Redirect()->back()->with('success', 'Message Deleted Successfully');

    }

}
