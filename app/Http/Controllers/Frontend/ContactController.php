<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function getContact() {
        return view('frontend.contact.index');
    }

    public function postContact(Request $request) {
        $name = trim($request->name);
        $email = trim($request->email);
        $title = trim($request->title);
        $content = trim($request->content);
        $data = [
            'name' => $name,
            'email' => $email,
            'title' => $title,
            'content' => $content
        ];
        Contact::create($data);
        return redirect()->back()->with('success', 'Gửi thành công!');
        dd($request->all());
    }
}
