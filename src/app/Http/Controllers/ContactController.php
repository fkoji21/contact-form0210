<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせフォームの表示
    public function index()
    {
        return view('contact.index');
    }

    // 確認画面の表示（バリデーション済みのデータを取得）
    public function confirm(ContactRequest $request)
    {
        $data = $request->validated();
        return view('contact.confirm', compact('data'));
    }

    // フォーム送信処理（データの保存）
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('contact.thanks'); // 🔹 サンクスページにリダイレクト
    }

    // サンクスページの表示
    public function thanks()
    {
        return view('contact.thanks');
    }
}
