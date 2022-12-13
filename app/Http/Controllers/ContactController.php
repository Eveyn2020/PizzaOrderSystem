<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct to contact page
    public function contactPage(){
        return view('user.main.contactPage');
    }

    //create contact
    public function contactCrate(Request $request){
      
        $this->contactValidationCheck($request);
        $contactInfo=$this->contactData($request);
       
        Contact::create($contactInfo);
        return redirect()->route('contact#contactPage')->with(['createSuccess'=>'Your message has been send...']);
    }

    //lsit of users
    public function contactList (){
        $data=Contact::orderBy('created_at','desc')->paginate(5);
        return view('admin.contact.list',compact('data'));
    }

    //validation for contact
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'userMessage'=>'required'
        ])->validate();
    }
    private function contactData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->userMessage
           
        ];
    }
}
