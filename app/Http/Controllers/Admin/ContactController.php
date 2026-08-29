<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->get();
        return view('admin.messages.messages', compact('messages'));
    }

    public function show(Contact $contact)
    {
        if(!$contact->is_read){
            $contact->update(['is_read' => true]);
        }

        return view('admin.messages.showMessage', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
        ->with('success','Message deleted successfully!');
    }
}
