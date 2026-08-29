<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('main-website.contact');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
