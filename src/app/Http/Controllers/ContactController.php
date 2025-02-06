<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせフォームの表示
    public function index()
    {
        return view('contact.index');
    }

    // 確認画面の表示
    public function confirm(Request $request)
    {
        // フォームのデータを取得
        $data = $request->all();
        return view('contact.confirm', compact('data'));
    }

    // フォーム送信処理
    public function store(Request $request)
    {
        // データ保存処理（後で実装）
        return redirect()->route('contact.thanks');
    }

    // サンクスページの表示
    public function thanks()
    {
        return view('contact.thanks');
    }
}
