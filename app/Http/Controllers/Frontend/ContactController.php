<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend/page/contact');
    }

    public function contactinsert(Request $request)
    {
        Contact::insert($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        Mail::to('moniruzzaman.dev.info@gmail.com')->send(new ContactMessage($name, $email, $subject, $message));
        return back()->with('status', 'Message Sent Successfully');
    }
}
