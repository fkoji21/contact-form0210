<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;

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

        // 名前検索（部分一致・完全一致）
        if ($request->filled('name')) {
            if ($request->has('exact_match')) {
                $query->where('first_name', $request->name)
                      ->orWhere('last_name', $request->name);
            } else {
                $query->where('first_name', 'like', '%' . $request->name . '%')
                      ->orWhere('last_name', 'like', '%' . $request->name . '%');
            }
        }

        // メールアドレス検索
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // 性別検索（1:男性, 2:女性, 3:その他）
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類（カテゴリー）検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付検索（from ～ to）
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // ページネーション（7件ごと）
        $contacts = $query->paginate(7);

        // カテゴリーを取得
        $categories = Category::all();

        return view('admin.contacts', compact('contacts', 'categories'));
    }

    // お問い合わせ詳細
    public function show($id)
    {
        $contact = Contact::with('category')->find($id);

        if (!$contact) {
            return response()->json(['error' => 'データが見つかりません'], 404);
        }

        return response()->json($contact);
    }

    // お問い合わせ削除
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contacts')->with('success', 'お問い合わせを削除しました');
    }

    // CSVエクスポート
    public function export(Request $request)
    {
        return Excel::download(new ContactsExport($request), 'contacts.csv');
    }

}
