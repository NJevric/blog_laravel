<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;
class ContactController extends OsnovniController
{
    //
    public function index()
    {
        
        return view('contact', $this->data);
    }

    public function mailSend(ContactRequest $request){
        $address = 'nikola@gmail.com';
        $name = $request->name;
        $subject = $request->subject;
        $textContact = $request->textContact;
        $email = $request->email;
        $emailcontent = 'From: ' .$name. "\n" . 'Subject: ' . $subject . "\n" . 'Email :' .$email. "\n" . "Content: \n".$textContact;
        try{
            mail($address,$subject,$textContact);
            $request->session()->flash('emailSent','Email sent successfully');
            return redirect()->route('contact');
        }
        catch(Exceptio $e){
            $request->session()->flash('emailFailed','There was a problem with sending an email');
            return redirect()->route('contact');
        }
      
        
           
       
    }
    

}
