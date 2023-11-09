<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendContactForm(Request $request){
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'subject' => 'required|min:10',
            'message' => 'required|min:10',
        ]);

        Mail::to('bojo1810@gmail.com')->send(new ContactMail(
            $request->name,
            $request->email,
            $request->subject,
            $request->message,
        ));

        Notification::create([
            'title' => 'New Email from ' . $request->name,
            'content' => 'A user with name: ' . $request->name . ' has send inquiry.<br>Email: ' . $request->email . '.<br>Subject: ' . $request->subject . '.<br>Message: ' . $request->message,
            'seen' => false
        ]);

        return redirect()->back()->with('success','Your message has been sent!');
    }
}
