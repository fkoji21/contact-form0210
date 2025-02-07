<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    // お問い合わせ一覧
    public function contacts(Request $request)
    {
        $query = Contact::query();

        // キーワード検索
        if ($request->has('search')) {
            $query->where('first_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%")
                  ->orWhere('detail', 'LIKE', "%{$request->search}%");
        }

        // カテゴリーでフィルタリング
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $contacts = $query->paginate(10);

        return view('admin.contacts', compact('contacts'));
    }

    // お問い合わせ詳細
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    // お問い合わせ削除
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contacts')->with('success', 'お問い合わせを削除しました');
    }

}
