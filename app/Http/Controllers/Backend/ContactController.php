<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::getInfo();
        return view('admin.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $contact = Contact::getInfo();
        $contact->update($request->all());

        return redirect()->back()->with('success', 'Kontak berhasil diupdate');
    }
}
