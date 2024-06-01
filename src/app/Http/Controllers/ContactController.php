<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'first_tell', 'second_tell', 'third_tell', 'address', 'building', 'category_id', 'detail']);
        $category = Category::find($request->category_id);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        if ($request->input('back') == 'back') {
            return redirect('/')->withInput();
        }

        // $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'first_tell', 'second_tell', 'third_tell', 'address', 'building', 'category_id', 'detail']);
        $contact = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tell' => $request->first_tell . $request->second_tell . $request->third_tell,
            'address' => $request->address,
            'building' => $request->building,
            'category_id' => $request->category_id,
            'detail' => $request->detail
        ];
        Contact::create($contact);
        return view('thanks');
    }

    public function admin()
    {
        // $contacts = Contact::with('category')->get();
        $contacts = Contact::with('category')->paginate(7);
        // $contacts = Contact::Paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')->First_nameSearch($request->keyword)->orWhere->Last_nameSearch($request->keyword)->orWhere->EmailSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->date)->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

}
