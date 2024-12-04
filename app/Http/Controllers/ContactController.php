<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;
//use App\Notifications\ContactReplyNotification;
class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }
    public function reply(Request $request)
    {
        // Kiểm tra thông tin phản hồi
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'response' => 'required|string',
        ]);

        // Lấy thông tin liên hệ từ ID
        $contact = Contact::find($request->contact_id);

        // Lưu thông tin phản hồi vào cơ sở dữ liệu
        $contact->response = $request->response;
        $contact->response_date = now();
        $contact->save();

        Mail::to($contact->email)->send(new ContactReplyMail($request->response));

        // Trả về phản hồi
        return redirect()->back()->with('success', 'Phản hồi đã được gửi thành công!');
    }
}
