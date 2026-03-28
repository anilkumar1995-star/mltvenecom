<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * Send a contact message.
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required',
            'phone' => 'nullable|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()], 422);
        }

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => 'unread',
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Your message has been sent successfully!',
        ]);
    }
}
