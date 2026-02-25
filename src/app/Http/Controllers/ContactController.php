<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contacts =Contact::all();
        $categories=Category::all();
        return view('index',compact('contacts', 'categories'));
    }
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel_area', 'tel_local', 'tel_number', 'address', 'building','category_id', 'detail']);
        $contact['tel'] = $request->tel_area . '-' . $request->tel_local . '-' . $request->tel_number;
        $category = Category::find($contact['category_id']);
        return view('confirm', compact('contact', 'category'));
    }
    public function store(StoreContactRequest $request)
    {
        Contact::create($request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building','category_id', 'detail']));
        return view('thanks');
    }
    public function back(Request $request)
    {
    return redirect('/')->withInput($request->all());
    }
    
}