<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class ContactsController extends Controller
{
    public function showContacts()
    {
        $contacts = Contact::all(); 
        return view('contact', compact('contacts')); 
    }
}
