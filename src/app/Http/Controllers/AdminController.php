<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword)
             {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('gender') && $request->gender !== '0') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    public function export()
    {
        $contacts = Contact::with('category')->get();
        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '日時'];

        $csvData = $contacts->map(function ($contact) 
        {
            return [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender_text,
                $contact->email,
                $contact->category->content ?? '',
                $contact->created_at->format('Y-m-d H:i'),
            ];
        });
        $response = response()->streamDownload(function () use ($csvHeader, $csvData) 
        {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 'contacts.csv');
        return $response;
    }
    public function show($id)
    {
    $contact = Contact::with('category')->findOrFail($id);
    $contact->append('gender_text');
    return response()->json($contact);
    }
    public function destroy($id)
    {
    Contact::findOrFail($id)->delete();
    return redirect('/admin');
    }
}